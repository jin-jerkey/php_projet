document.getElementById('start-button').addEventListener('click', function() {
    const video = document.getElementById('preview');
    const canvasElement = document.createElement('canvas');
    // Ajout de willReadFrequently
    const canvas = canvasElement.getContext('2d', { willReadFrequently: true });
    let stream;

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

                // Afficher le contenu du QR code
                document.getElementById('result').textContent = code.data;

                // Envoyer les données scannées au serveur PHP
                sendDataToServer(code.data);
                // Ajouter un délai avant de scanner à nouveau
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
        // Convertir les données scannées en JSON
        let qrData;
        try {
            qrData = JSON.parse(data);
        } catch (e) {
            alert('Erreur: QR code ne contient pas un JSON valide.');
            return;
        }
    
        console.log('Données scannées:', qrData); // Afficher les données scannées dans la console
    
        fetch('save_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(qrData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur HTTP ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            alert('Les données ont bien été envoyées: ' + JSON.stringify(qrData));
            if (data.status === 'success') {
                showNotification('Données reçues avec succès!', 'success');
                // Redirection si nécessaire
                //window.location.href = 'appel.php?id=' + encodeURIComponent(qrData.id);
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Erreur lors de l\'envoi des données: ' + error.message);
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
    
        // Supprimer la notification après quelques secondes
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000); // 3 secondes de délai avant de supprimer la notification
    }

    function openAppelModalBtn(data) {
        // Remplir le champ matricule avec les données du QR code
        document.getElementById('matricul').value = data;

        // Ouvrir le modal
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
