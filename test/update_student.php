<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'mysql:host=localhost;dbname=ecole';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $classe_id = $_POST['classe'];

        // Gestion du fichier image
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE etudiant SET nom = :nom, classe_id = :classe_id, image = :image WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':classe_id', $classe_id);
                    $stmt->bindParam(':image', $target_file);
                    $stmt->bindParam(':id', $id);

                    if ($stmt->execute()) {
                        echo "Étudiant mis à jour avec succès";
                    } else {
                        echo "Erreur lors de la mise à jour de l'étudiant";
                    }
                } else {
                    echo "Erreur lors du téléchargement de l'image.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        } else {
            $sql = "UPDATE etudiant SET nom = :nom, classe_id = :classe_id WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':classe_id', $classe_id);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                 // Redirection vers la page read_students.php
                 header("Location: read_students.php");
                 exit();
            } else {
                echo "Erreur lors de la mise à jour de l'étudiant";
            }
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
