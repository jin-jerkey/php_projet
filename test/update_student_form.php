<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour un étudiant</title>
</head>
<body>
    <h1>Mettre à jour un étudiant</h1>
    <form action="update_student.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" required>
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $_GET['nom']; ?>" required><br><br>

        <label for="classe">Classe:</label>
        <select id="classe" name="classe" required>
            <?php
            $dsn = 'mysql:host=localhost;dbname=ecole';
            $username = 'root';
            $password = '';

            try {
                $pdo = new PDO($dsn, $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->query("SELECT id, nom FROM classe");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($_GET['classe_id'] == $row['id']) ? 'selected' : '';
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nom'] . '</option>';
                }
            } catch (PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
            ?>
        </select><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        <!-- Afficher l'image actuelle -->
        <img src="<?php echo $_GET['image']; ?>" alt="Image actuelle" width="100"><br><br>

        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>
