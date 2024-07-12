// Modifiez ceci dans votre fichier script.js
function submitForm() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Validation côté client (ajoutez d'autres validations si nécessaire)
    if (!email || !password) {
        document.getElementById('errorMessage').innerText = 'Veuillez remplir tous les champs.';
        return;
    }

    // Afficher la page de chargement
    document.getElementById('loadingPage').style.display = 'block';

    // Envoyer les données au backend (à implémenter)
    // Vous pouvez utiliser AJAX pour cela

    // Simuler une réponse du serveur après 2 secondes (à remplacer par votre code AJAX)
    setTimeout(function() {
        // Masquer la page de chargement
        document.getElementById('loadingPage').style.display = 'none';

        // Exemple d'affichage d'un message pour le test
        alert('Connexion réussie pour ' + email);
    }, 2000);
}
