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
        $id = $_POST['id']; // Assurez-vous que l'ID est récupéré depuis le formulaire
        $matricul = $_POST['matricul'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateofbirth = $_POST['date_nais'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $bureau = $_POST['bureau'];
        $departement = $_POST['departement'];
        $discipline = $_POST['discipline'];

        // Gestion de l'image de profil
        $profilPath = $enseignant['image']; // Chemin d'image par défaut
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $profil = $_FILES['image']['name'];  // Nom de fichier
            $profil_tmp = $_FILES['image']['tmp_name'];  // Emplacement temporaire

            // Déplacer l'image téléchargée vers un dossier approprié
            $profilPath = 'uploads/' . $profil;
            move_uploaded_file($profil_tmp, $profilPath);
        }

        // Préparer la requête SQL de mise à jour
        $sql = "UPDATE enseignant SET matricul = :matricul, nom = :nom, prenom = :prenom, date_nais = :date_nais, telephone = :telephone, email = :email, bureau = :bureau, departement = :departement, discipline = :discipline, image = :image WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricul', $matricul);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_nais', $dateofbirth);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':bureau', $bureau);
        $stmt->bindParam(':departement', $departement);
        $stmt->bindParam(':discipline', $discipline);
        $stmt->bindParam(':image', $profilPath);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter la requête SQL
        if ($stmt->execute()) {
            // Redirection vers la page de profil après modification
            header("Location: profile.php?id=" . htmlspecialchars($id));
            exit();
        } else {
            echo "Erreur lors de la modification des informations de l'enseignant";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
