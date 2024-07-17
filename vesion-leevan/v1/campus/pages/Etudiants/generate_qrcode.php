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

    // Générer le nom de fichier complet
    $filename = $outputDir . $safeFilename . '.png';

    // Générer le QR code et sauvegarder l'image
    QRcode::png($jsonData, $filename, QR_ECLEVEL_H, 10);

    // URL de téléchargement de l'image
    $fileUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $filename;

    // Numéro de téléphone WhatsApp (format international sans les "+")
    $phoneNumber = '698312554';  // Remplacez par le numéro de téléphone souhaité

    // URL de partage WhatsApp avec le numéro de téléphone
    $whatsappUrl = 'https://api.whatsapp.com/send?phone=' . $phoneNumber . '&text=' . urlencode("Voici le QR Code: ") . $fileUrl;

    echo 'QR code généré et sauvegardé sous forme d\'image. <br>';
    echo '<img src="' . $filename . '" alt="QR Code"><br>';
    echo '<a href="' . $fileUrl . '" download>Télécharger l\'image</a><br>';
    echo '<a href="' . $whatsappUrl . '">Partager sur WhatsApp</a>';
}
?>
