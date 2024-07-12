<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'mysql:host=localhost;dbname=ecole';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nom = $_POST['nom'];
        $classe_id = $_POST['classe'];

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
                    $sql = "INSERT INTO etudiant (nom, classe_id, image) VALUES (:nom, :classe_id, :image)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':classe_id', $classe_id);
                    $stmt->bindParam(':image', $target_file);

                    if ($stmt->execute()) {
                        // Redirection vers la page read_students.php
                        header("Location: read_students.php");
                        exit();
                    } else {
                        echo "Erreur lors de l'ajout de l'étudiant";
                    }
                } else {
                    echo "Erreur lors du téléchargement de l'image. Assurez-vous que le dossier 'uploads' existe et est accessible en écriture.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
