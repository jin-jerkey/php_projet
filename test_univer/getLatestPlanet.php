<?php
include 'config.php';

$etoileId = $_GET['etoileId'];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM planet WHERE etoile_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$etoileId]);
    $planet = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($planet);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$pdo = null;
?>
