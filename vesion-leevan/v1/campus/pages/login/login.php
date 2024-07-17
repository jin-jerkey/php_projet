<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = 'mysql:host=localhost;dbname=campus_school';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sanitize et valider l'email
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $mot_de_passe = $_POST['mot_de_passe'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "Adresse email invalide.";
            exit();
        }

        // Debugging: Afficher l'email et le mot de passe reçus
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Mot de passe: " . htmlspecialchars($mot_de_passe) . "<br>";

        // Vérification de l'email et du mot de passe
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debugging: Afficher les données de l'utilisateur récupérées
        if ($user) {
            echo "Utilisateur trouvé : <pre>" . print_r($user, true) . "</pre><br>";
        } else {
            echo "Aucun utilisateur trouvé avec cet email.<br>";
        }

        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Démarrer la session et stocker des informations supplémentaires
            session_start();
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['nom']; // Assurez-vous que la colonne 'nom' existe dans votre table 'users'
            header("Location: ../Etudiants/etudiant.php");
            exit();
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>
