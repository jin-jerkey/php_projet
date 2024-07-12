const emailInput = document.querySelector(".input-field[type='email']");
const passwordInput = document.querySelector(".input-field[type='password']");
const submitBtn = document.querySelector(".submit-btn");

submitBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const email = emailInput.value;
    const password = passwordInput.value;

    // Valider les champs de saisie

    if (!email || !password) {
        alert("Veuillez remplir tous les champs");
        return;
    }

    // Envoyer les informations de connexion au serveur

    // ...

    // Afficher un message d'erreur si les informations de connexion sont incorrectes

    if (// informations de connexion incorrectes) {
        alert("Les informations de connexion sont incorrectes");
        return;
    }

    // Rediriger l'utilisateur vers la page d'accueil

    // ...
});