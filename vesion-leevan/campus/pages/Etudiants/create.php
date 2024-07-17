<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
?>
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
    // Récupérer les valeurs des champs
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];

    // Structurer les informations dans un JSON
    $data = [
        'matricule' => $matricule,
        'nom' => $nom,
        'filiere' => $filiere,
        'niveau' => $niveau
    ];
    $jsonData = json_encode($data);

    // Nettoyer le texte pour l'utiliser comme nom de fichier
    $safeFilename = sanitize_filename($matricule);

    // Définir le dossier pour sauvegarder les QR codes
    $outputDir = 'qrcodes/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0755, true);
    }

    // Générer le nom de fichier complet pour le QR code
    $filename = $outputDir . $safeFilename . '.png';

    // Générer le QR code et sauvegarder l'image
    QRcode::png($jsonData, $filename, QR_ECLEVEL_H, 10);

    // URL de téléchargement de l'image (chemin vers le QR code)
    $fileUrl = '' . $filename;

    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=campus_school';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les données du formulaire
        $prenom = $_POST['prenom'];
        $dateofbirth = $_POST['dateofbirth'];
        $telephone = $_POST['telephone'];
        
        // Gestion de l'image de profil
        $profil = $_FILES['profil']['name'];  // Nom de fichier
        $profil_tmp = $_FILES['profil']['tmp_name'];  // Emplacement temporaire
        
        // Déplacer l'image téléchargée vers un dossier approprié
        $profilPath = 'uploads/' . $profil;
        move_uploaded_file($profil_tmp, $profilPath);

        // Préparer la requête SQL d'insertion
        $sql = "INSERT INTO etudiant (matricule, Nom, Prenom, dateofbirth, telephone, filiere, niveau, id_qr, profil)
                VALUES (:matricule, :nom, :prenom, :dateofbirth, :telephone, :filiere, :niveau, :id_qr, :profil)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':dateofbirth', $dateofbirth);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':id_qr', $fileUrl);
        $stmt->bindParam(':profil', $profilPath);  // Sauvegarder le chemin complet de l'image

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
