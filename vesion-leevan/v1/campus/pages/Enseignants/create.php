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
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $date_nais = $_POST['date_nais'];
        $bureau = $_POST['bureau'];
        $departement = $_POST['departement'];
        $discipline = $_POST['discipline'];

        // Gestion du fichier image
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Vérifier si le fichier est une image réelle
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $sql = "INSERT INTO enseignant (matricul, nom, prenom, telephone, email, date_nais, bureau, departement, discipline, image, mot_de_passe) 
                            VALUES (:matricul, :nom, :prenom, :telephone, :email, :date_nais, :bureau, :departement, :discipline, :image, :mot_de_passe)";
                            $plain_password = $user['IME00school'];  // Assuming these are plain text passwords
                            $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':matricul', $matricul);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':telephone', $telephone);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':date_nais', $date_nais);
                    $stmt->bindParam(':bureau', $bureau);
                    $stmt->bindParam(':departement', $departement);
                    $stmt->bindParam(':discipline', $discipline);
                    $stmt->bindParam(':image', $target_file);
                    $stmt->bindParam(':mot_de_passe', $hashed_password);

                    if ($stmt->execute()) {
                        header("Location: enseignant.php");
                        exit();
                    } else {
                        echo "Erreur lors de l'ajout de l'enseignant";
                    }
                } else {
                    echo "Erreur lors du déplacement de l'image téléchargée. Assurez-vous que le dossier 'uploads' existe et est accessible en écriture.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES['image']['error'];
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
