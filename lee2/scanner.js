document.getElementById('start-button').addEventListener('click', function() {
    const video = document.getElementById('preview');
    const canvasElement = document.createElement('canvas');
    const canvas = canvasElement.getContext('2d');

    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
        .then(function(stream) {
            video.srcObject = stream;
            video.setAttribute('playsinline', true);
            video.play();
            requestAnimationFrame(tick);
        });

    function tick() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
            const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: 'dontInvert',
            });

            if (code) {
                drawLine(code.location.topLeftCorner, code.location.topRightCorner, '#FF3B58');
                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, '#FF3B58');
                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, '#FF3B58');
                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, '#FF3B58');

                // Afficher le contenu du QR code
                document.getElementById('result').textContent = code.data;

                // Envoyer les données scannées au serveur PHP
                sendDataToServer(code.data);
            } else {
                requestAnimationFrame(tick);
            }
        } else {
            requestAnimationFrame(tick);
        }
    }

    function drawLine(begin, end, color) {
        canvas.beginPath();
        canvas.moveTo(begin.x, begin.y);
        canvas.lineTo(end.x, end.y);
        canvas.lineWidth = 4;
        canvas.strokeStyle = color;
        canvas.stroke();
    }

    function sendDataToServer(data) {
        fetch('save_qr_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ qrData: data })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
});
