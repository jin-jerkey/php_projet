<?php
include 'config.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nomEtoile = 'Etoile' . rand(1, 1000);
    $tailleEtoile = rand(1000, 10000);
    $nombrePlanets = rand(1, 10);

    $sql = "INSERT INTO etoile (nom, taille, nombre_planet) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomEtoile, $tailleEtoile, $nombrePlanets]);

    $etoileId = $pdo->lastInsertId();
    echo $etoileId; // Retourner l'ID de la nouvelle étoile
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$pdo = null;
?>
