<?php
include 'config.php';

$id = $_GET['id'];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM etoile WHERE id = ?");
    $stmt->execute([$id]);
    $etoile = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($etoile);
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

$pdo = null;
?>
