<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de l'Univers</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Gestion de l'Univers</h1>
    <button id="startBtn">Démarrer la création d'univers</button>

    <h2>Liste des Étoiles</h2>
    <table id="etoilesTable" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Taille</th>
                <th>Nombre de Planètes</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les étoiles seront ajoutées ici -->
        </tbody>
    </table>

    <h2>Liste des Planètes</h2>
    <table id="planetsTable" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Taille</th>
                <th>Nombre d'Habitants</th>
                <th>ID de l'Étoile</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les planètes seront ajoutées ici -->
        </tbody>
    </table>

    <script src="script.js"></script>
</body>
</html>
