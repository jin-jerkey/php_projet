<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Protégée</title>
</head>
<body>
    <h1>Bienvenue sur la page protégée</h1>
    <p>Vous êtes connecté en tant que utilisateur avec l'ID: <?php echo $_SESSION['user_id']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
