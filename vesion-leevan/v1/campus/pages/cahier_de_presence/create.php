<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'mysql:host=localhost;dbname=campus_school';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $matricul = $_POST['matricul'];
        $date = $_POST['date'];
        $heure = $_POST['heure'];
        $periode = $_POST['periode'];
        $filiere = $_POST['filiere'];
        $niveau = $_POST['niveau'];
        $matiere = $_POST['matiere'];
        $professeur = $_POST['professeur'];

        $sql = "INSERT INTO cahier_appel (matricul, date, heure, periode, filiere, niveau, matiere, professeur) VALUES (:matricul, :date, :heure, :periode, :filiere, :niveau, :matiere, :professeur)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricul', $matricul);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':periode', $periode);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':matiere', $matiere);
        $stmt->bindParam(':professeur', $professeur);

        if ($stmt->execute()) {
            echo "Enregistrement réussi.";
            header("Location: cahier_de_presence.php");
        } else {
            echo "Erreur lors de l'enregistrement.";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
