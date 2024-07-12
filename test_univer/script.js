document.getElementById("startBtn").addEventListener("click", function() {
    createUnivers();
});

function createUnivers() {
    setInterval(function() {
        fetch('createuniver.php')
            .then(response => response.text())
            .then(etoileId => {
                console.log('Nouvelle étoile créée avec ID:', etoileId);
                addEtoileToTable(etoileId);
                createPlanets(etoileId);
            })
            .catch(error => console.error('Erreur:', error));
    }, 60000); // 60000 millisecondes = 1 minute
}

function createPlanets(etoileId) {
    setInterval(function() {
        fetch('createplanet.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'etoileId=' + etoileId,
        })
        .then(response => response.text())
        .then(responseText => {
            console.log(responseText);
            addPlanetToTable(responseText);
        })
        .catch(error => console.error('Erreur:', error));
    }, 5000); // 5000 millisecondes = 5 secondes
}

function addEtoileToTable(etoileId) {
    fetch('getEtoile.php?id=' + etoileId)
        .then(response => response.json())
        .then(etoile => {
            const table = document.getElementById('etoilesTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.insertCell(0).innerText = etoile.id;
            newRow.insertCell(1).innerText = etoile.nom;
            newRow.insertCell(2).innerText = etoile.taille;
            newRow.insertCell(3).innerText = etoile.nombre_planet;
        })
        .catch(error => console.error('Erreur:', error));
}

function addPlanetToTable(etoileId) {
    fetch('getLatestPlanet.php?etoileId=' + etoileId)
        .then(response => response.json())
        .then(planet => {
            const table = document.getElementById('planetsTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.insertCell(0).innerText = planet.id;
            newRow.insertCell(1).innerText = planet.nom;
            newRow.insertCell(2).innerText = planet.taille;
            newRow.insertCell(3).innerText = planet.nombre_dhabitant;
            newRow.insertCell(4).innerText = planet.etoile_id;
        })
        .catch(error => console.error('Erreur:', error));
}
