<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="login.php" method="post">
                <img src="../../assets/logo/logo.jpg" alt="Logo" class="logo">
                <input type="email" name="email" placeholder="Email" class="input-field" required>
                <input type="password" name="motDePasse" placeholder="Mot de passe" class="input-field" required>
                <button type="submit" class="submit-btn" onclick="submitForm()">Connexion</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>