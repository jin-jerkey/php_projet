<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<?php
$dsn = 'mysql:host=localhost;dbname=campus_school';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $matricule = $_GET['id'];

        $sql = "DELETE FROM etudiant WHERE matricule = :matricule";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);

        if ($stmt->execute()) {
            // Redirection vers la page des étudiants
            header("Location: etudiant.php");
            exit();
        } else {
            echo "Erreur lors de la suppression de l'étudiant";
        }
    } else {
        echo "Matricule non fourni";
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
