function handleClick(button) {
    // Retirer la classe active de tous les boutons du menu
    const buttons = document.querySelectorAll('.menu-button');
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    // Ajouter la classe active au bouton cliqué
    button.classList.add('active');
}

function openAbsenceModal() {
    var absenceModal = document.getElementById("absenceModal");
    absenceModal.style.display = "block";
}

document.addEventListener('DOMContentLoaded', (event) => {
    // Modal pour Calendrier des absences
    var absenceModal = document.getElementById("absenceModal");
    var openAbsenceModalBtn = document.getElementById("openAbsenceModalBtn");
    var closeAbsenceSpan = absenceModal.getElementsByClassName("close")[0];

    openAbsenceModalBtn.onclick = function() {
        absenceModal.style.display = "block";
    }

    closeAbsenceSpan.onclick = function() {
        absenceModal.style.display = "none";
    }

    // Modal pour Vérifier
    var verifyModal = document.getElementById("verifyModal");
    var openVerifyModalBtn = document.getElementById("openVerifyModalBtn");
    var closeVerifySpan = verifyModal.getElementsByClassName("close")[0];

    openVerifyModalBtn.onclick = function() {
        verifyModal.style.display = "block";
    }

    closeVerifySpan.onclick = function() {
        verifyModal.style.display = "none";
    }

    // Modal pour camera
    var attendanceModal = document.getElementById("attendanceModal");
    var openAttendanceModalBtn = document.getElementById("openAttendanceModalBtn");
    var closeAttendanceSpan = attendanceModal.getElementsByClassName("close")[0];

    openAttendanceModalBtn.onclick = function() {
        attendanceModal.style.display = "block";
    }

    closeAttendanceSpan.onclick = function() {
        attendanceModal.style.display = "none";
    }


    // Modal pour Faire l'appel
    var appelModal = document.getElementById("appelModal");
    var openAppelModalBtn = document.getElementById("openAppelModalBtn");
    var closeAppelSpan = attendanceModal.getElementsByClassName("close")[0];

    openAppelModalBtn.onclick = function() {
        appelModal.style.display = "block";
    }

    closeAppelSpan.onclick = function() {
        appelModal.style.display = "none";
    }

    // Fermer les modals en cliquant en dehors
    window.onclick = function(event) {
        if (event.target == absenceModal) {
            absenceModal.style.display = "none";
        }
        if (event.target == verifyModal) {
            verifyModal.style.display = "none";
        }
        if (event.target == attendanceModal) {
            attendanceModal.style.display = "none";
        }
        if (event.target == appelModal) {
            appelModal.style.display = "none";
        }
    }

      // Fermer les modals en cliquant en dehors (sauf pour Faire l'appel)
      window.onclick = function(event) {
        if (event.target == absenceModal) {
            absenceModal.style.display = "none";
        }
        if (event.target == verifyModal) {
            verifyModal.style.display = "none";
        }
    }

});
