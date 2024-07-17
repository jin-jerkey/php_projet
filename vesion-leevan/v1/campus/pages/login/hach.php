<?php
$dsn = 'mysql:host=localhost;dbname=campus_school';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sélectionner tous les utilisateurs
    $sql = "SELECT id_user, mot_de_passe FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $id = $user['id_user'];
        $plain_password = $user['mot_de_passe'];  // Assuming these are plain text passwords
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe avec la version hachée
        $update_sql = "UPDATE users SET mot_de_passe = :mot_de_passe WHERE id_user = :id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->bindParam(':mot_de_passe', $hashed_password);
        $update_stmt->bindParam(':id', $id);
        $update_stmt->execute();
    }

    echo "Tous les mots de passe ont été hachés avec succès.";
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
