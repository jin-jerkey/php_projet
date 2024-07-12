<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dsn = 'mysql:host=localhost;dbname=campus_school';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $matricul = $_POST['matricul'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_nais = $_POST['date_nais'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $bureau = $_POST['bureau'];
        $departement = $_POST['departement'];
        $discipline = $_POST['discipline'];
        $image = $_POST['image'];

        // Préparer la requête SQL de mise à jour
        $sql = "UPDATE enseignant SET matricul = :matricul, nom = :nom, prenom = :prenom, date_nais = :date_nais, telephone = :telephone, email = :email, bureau = :bureau, departement = :departement, discipline = :discipline, image = :image WHERE id  = :id ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricul', $matricul);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_nais', $date_nais);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':bureau', $bureau);
        $stmt->bindParam(':departement', $departement);
        $stmt->bindParam(':discipline', $discipline);
        $stmt->bindParam(':image', $image);

        // Exécuter la requête SQL
        if ($stmt->execute()) {
            // Redirection vers la page de profil après modification
            header("Location: profil.php?id=" . htmlspecialchars($matricule));
            exit();
        } else {
            echo "Erreur lors de la modification des informations de l'étudiant";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
