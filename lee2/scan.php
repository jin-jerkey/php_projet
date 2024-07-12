<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR Code</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Scanner QR Code</h1>
        <video id="preview" width="400" height="300"></video>
        <button id="start-button">Démarrer le scan</button>
        <div id="result"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <script src="scanner.js"></script>
</body>
</html>
