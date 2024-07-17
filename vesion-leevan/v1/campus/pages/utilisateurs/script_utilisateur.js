// Récupération des éléments
var modal = document.getElementById("userModal");
var btn = document.getElementById("openModalBtn");
var span = document.getElementsByClassName("closeBtn")[0];

// Ouvrir le modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Fermer le modal avec le bouton X
span.onclick = function() {
    modal.style.display = "none";
}

// Empêcher la fermeture du modal en cliquant en dehors du contenu du modal
modal.onclick = function(event) {
    if (event.target === modal) {
        event.stopPropagation();
    }
}

// Gérer le formulaire
document.getElementById("userForm").onsubmit = function(event) {
    event.preventDefault();
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    console.log("Nom d'utilisateur: " + username);
    console.log("Email: " + email);
    modal.style.display = "none";
}

