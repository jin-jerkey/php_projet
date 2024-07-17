function handleClick(button) {
    // Retirer la classe active de tous les boutons du menu
    const buttons = document.querySelectorAll('.menu-button');
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Ajouter la classe active au bouton cliqué
    button.classList.add('active');
}

//modal d'inscription de l'etudiant
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("openModalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


//script pour afficher le contenu en fonction de l'etat de presence des etudiants
    $(document).ready(function() {
        $("#allStudentsBtn").click(function() {
            $("#allStudentsContent").show();
            $("#absentStudentsContent").hide();
            $("#presentStudentsContent").hide();
        });

        $("#absentStudentsBtn").click(function() {
            $("#allStudentsContent").hide();
            $("#absentStudentsContent").show();
            $("#presentStudentsContent").hide();
        });

        $("#presentStudentsBtn").click(function() {
            $("#allStudentsContent").hide();
            $("#absentStudentsContent").hide();
            $("#presentStudentsContent").show();
        });
    });


