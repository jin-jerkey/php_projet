<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
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
        $matricule = $_POST['matricule'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateofbirth = $_POST['dateofbirth'];
        $telephone = $_POST['telephone'];
        $filiere = $_POST['filiere'];
        $niveau = $_POST['niveau'];

        // Gestion de l'image de profil
        $profil = $_FILES['profil']['name'];  // Nom de fichier
        $profil_tmp = $_FILES['profil']['tmp_name'];  // Emplacement temporaire
        
        // Déplacer l'image téléchargée vers un dossier approprié
        $profilPath = 'uploads/' . $profil;
        move_uploaded_file($profil_tmp, $profilPath);

        // Préparer la requête SQL de mise à jour
        $sql = "UPDATE etudiant SET Nom = :nom, Prenom = :prenom, dateofbirth = :dateofbirth, telephone = :telephone, filiere = :filiere, niveau = :niveau, profil = :profil WHERE matricule = :matricule";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':dateofbirth', $dateofbirth);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':profil', $profilPath);

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
