<?php
// Inclure le fichier config
require_once "../../config/config.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $email = trim($_POST["email"]);
    $motDePasse = trim($_POST["motDePasse"]);

    // Préparer la requête SQL pour vérifier les informations de connexion
    $sql = "SELECT * FROM responsable WHERE email = ? AND password = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Lier les paramètres à la requête préparée
        mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_motDePasse);

        // Définir les paramètres
        $param_email = $email;
        $param_motDePasse = $motDePasse;

        // Exécuter la requête préparée
        if (mysqli_stmt_execute($stmt)) {
            // Stocker le résultat de la requête
            mysqli_stmt_store_result($stmt);

            // Vérifier si l'utilisateur existe, puis vérifier le mot de passe
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // L'utilisateur existe, rediriger vers la page d'accueil
                header("location: ../../page/accueil/index.php");
            } else {
                // L'utilisateur n'existe pas, afficher un message d'erreur
                echo "Identifiants incorrects. Veuillez réessayer.";
                echo "Email: " . $email . "<br>";
                echo "Mot de passe saisi: " . $motDePasse . "<br>";
                echo "Mot de passe haché enregistré: " . $hashed_password . "<br>";

            }
        } else {
            echo "Oops! Une erreur est survenue.";
        }

        // Fermer la requête préparée
        mysqli_stmt_close($stmt);
    }

    // Fermer la connexion à la base de données
    mysqli_close($link);
}
?>
