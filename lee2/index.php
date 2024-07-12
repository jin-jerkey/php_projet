<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générer QR Code</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Générateur de QR Code</h1>
        <form action="generate_qrcode.php" method="post">
            <label for="text">Entrez le texte :</label>
            <input type="text" id="text" name="text" required>
            <button type="submit">Générer QR Code</button>
        </form>
    </div>
    <a href="scan.php"><h1>scan</h1></a>
</body>
</html>
