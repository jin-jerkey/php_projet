document.getElementById('start-button').addEventListener('click', function() {
    const video = document.getElementById('preview');
    const canvasElement = document.createElement('canvas');
    const canvas = canvasElement.getContext('2d', { willReadFrequently: true });
    let stream;

    // Charger les sons
    const successSound = document.getElementById('success-sound');
    const errorSound = document.getElementById('error-sound');

    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
        .then(function(s) {
            stream = s;
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

                document.getElementById('result').textContent = code.data;
                sendDataToServer(code.data);
                // Jouer le son de succès
                successSound.play();
                setTimeout(() => {
                    requestAnimationFrame(tick);
                }, 1000); // 1 seconde de délai
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
        let qrData;
        try {
            qrData = JSON.parse(data);
        } catch (e) {
            alert('Erreur: QR code ne contient pas un JSON valide.');
            // Jouer le son d'erreur
            errorSound.play();
            return;
        }

        console.log('Données scannées:', qrData);

        // Récupérer les informations du cahier d'appel
        const cahierData = {
            matricul: document.getElementById('cahier_matricul').value,
            professeur: document.getElementById('cahier_professeur').value,
            date: document.getElementById('cahier_date').value,
            heure: document.getElementById('cahier_heure').value,
            periode: document.getElementById('cahier_periode').value,
            filiere: document.getElementById('cahier_filiere').value,
            niveau: document.getElementById('cahier_niveau').value,
            matiere: document.getElementById('cahier_matiere').value
        };

        console.log('Données scannées:', cahierData);

        // Combiner les données du QR code et du cahier d'appel
        const allData = {
            qrData: qrData,
            cahierData: cahierData
        };

        

        fetch('save_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(allData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            alert('Les données ont bien été envoyées: ' + JSON.stringify(allData));
            if (data.status === 'success') {
                showNotification('Données reçues avec succès!', 'success');
            } else {
                alert('Erreur: ' + data.message);
                // Jouer le son d'erreur
                errorSound.play();
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Erreur lors de l\'envoi des données: ' + error.message);
            // Jouer le son d'erreur
            errorSound.play();
        });
    }

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.classList.add('notification');
        notification.classList.add(type);

        const notificationBody = document.createElement('div');
        notificationBody.classList.add('notification__body');
        notificationBody.innerHTML = `
            <img src="../../assets/images/check-circle.svg" alt="Success" class="notification__icon">
            ${message}
        `;

        notification.appendChild(notificationBody);
        document.body.appendChild(notification);

        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000); // 3 secondes de délai
    }

    function openAppelModalBtn(data) {
        document.getElementById('matricul').value = data;
        $('#appelModal').modal('show');
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
    }

    document.querySelector('#attendanceModal .close').addEventListener('click', function() {
        stopCamera();
    });
});

function openAbsenceModal() {
    var absenceModal = document.getElementById("absenceModal");
    absenceModal.style.display = "block";
}
