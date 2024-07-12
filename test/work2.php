<?php
// Inclure la bibliothèque PHP QR Code
include '../../config/phpqrcode/qrlib.php';

// Fonction pour nettoyer le texte afin de l'utiliser comme nom de fichier
function sanitize_filename($filename) {
    // Supprimer les caractères non alphanumériques
    $filename = preg_replace('/[^a-zA-Z0-9-_]/', '_', $filename);
    // Limiter la longueur du nom de fichier à 255 caractères
    return substr($filename, 0, 255);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateofbirth = $_POST['dateofbirth'];
    $telephone = $_POST['telephone'];
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];

    // Traitement de l'image de profil
    $outputDir = 'profil_images/';
    $profilImage = '';

    if ($_FILES['profil']['error'] === UPLOAD_ERR_OK) {
        // Nom de fichier sécurisé
        $filename = sanitize_filename($_FILES['profil']['name']);
        // Chemin complet où enregistrer l'image
        $filepath = $outputDir . $filename;

        // Déplacer l'image téléchargée vers le dossier des images de profil
        if (move_uploaded_file($_FILES['profil']['tmp_name'], $filepath)) {
            $profilImage = $filepath;
        } else {
            echo "Erreur lors de l'upload de l'image de profil.";
            exit;
        }
    } else {
        echo "Erreur lors de l'upload de l'image de profil : " . $_FILES['profil']['error'];
        exit;
    }

    // Générer le QR code et sauvegarder l'image
    QRcode::png($matricule, $outputDir . 'qrcodes/' . $matricule . '.png', QR_ECLEVEL_H, 10);
    // URL de téléchargement de l'image
    $fileUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $filename;

    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=campus_school';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête SQL d'insertion
        $sql = "INSERT INTO etudiant (matricule, Nom, Prenom, dateofbirth, telephone, filiere, niveau, id_qr, profil_image)
                VALUES (:matricule, :nom, :prenom, :dateofbirth, :telephone, :filiere, :niveau, :id_qr, :profil_image)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':dateofbirth', $dateofbirth);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':id_qr', $fileUrl);
        $stmt->bindParam(':profil_image', $profilImage);

        // Exécuter la requête SQL
        if ($stmt->execute()) {
            // Redirection vers la page de lecture des étudiants après insertion
            header("Location: etudiant.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de l'étudiant";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
