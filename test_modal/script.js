// Obtenir le modal
var modal = document.getElementById("myModal");

// Obtenir le bouton qui ouvre le modal
var btn = document.getElementById("openModalBtn");

// Obtenir l'élément <span> qui ferme le modal
var span = document.getElementsByClassName("close")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrir le modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// Lorsque l'utilisateur clique sur <span> (x), fermer le modal
span.onclick = function() {
    modal.style.display = "none";
}

// Lorsque l'utilisateur clique n'importe où en dehors du modal, fermer le modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Fonction pour ouvrir le modal toutes les 10 secondes pendant l'intervalle spécifié
function openModalPeriodically(startTime, endTime) {
    var intervalId = setInterval(function() {
        var now = new Date();
        var currentTime = now.getHours() * 60 + now.getMinutes();
        if (currentTime >= startTime && currentTime <= endTime) {
            modal.style.display = "block";
        } else {
            clearInterval(intervalId);
        }
    }, 10000); // 10000 millisecondes = 10 secondes
}

// Fonction pour démarrer l'intervalle
function startInterval() {
    var startTimeInput = document.getElementById("startTime").value;
    var endTimeInput = document.getElementById("endTime").value;

    if (startTimeInput && endTimeInput) {
        var startTimeParts = startTimeInput.split(":");
        var endTimeParts = endTimeInput.split(":");

        var startTime = parseInt(startTimeParts[0]) * 60 + parseInt(startTimeParts[1]);
        var endTime = parseInt(endTimeParts[0]) * 60 + parseInt(endTimeParts[1]);

        openModalPeriodically(startTime, endTime);
    } else {
        alert("Veuillez entrer les heures de début et de fin.");
    }
}
