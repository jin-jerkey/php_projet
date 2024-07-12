<?php
include 'config.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nomPlanet = 'Planète' . rand(1, 1000);
    $taillePlanet = rand(500, 5000);
    $nombreHabitant = rand(0, 1000000);
    $etoileId = $_POST['etoileId']; // ID de l'étoile associée

    $sql = "INSERT INTO planet (nom, taille, nombre_dhabitant, etoile_id) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomPlanet, $taillePlanet, $nombreHabitant, $etoileId]);

    echo "Nouvelle planète ajoutée avec succès";
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$pdo = null;
?>
