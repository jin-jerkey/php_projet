function handleClick(button) {
    // Retirer la classe active de tous les boutons du menu
    const buttons = document.querySelectorAll('.menu-button');
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Ajouter la classe active au bouton cliqué
    button.classList.add('active');
}
