<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$dsn = 'mysql:host=localhost;dbname=campus_school';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $matricule = $_GET['id'];

        $sql = "SELECT * FROM etudiant WHERE matricule = :matricule";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        $stmt->execute();

        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$etudiant) {
            echo "Étudiant non trouvé";
            exit();
        }
    } else {
        echo "Matricule non fourni";
        exit();
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus school</title>
    <link rel="stylesheet" href="style_profile.css">
</head>
<script>
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    // Fermer le modal si l'utilisateur clique en dehors
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function confirmDelete(matricule) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")) {
        window.location.href = "supprimer.php?id=" + matricule;
    }
}
</script>

<body>

    <!-- Le Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Modifier les informations de l'étudiant</h2>
    <form method="post" action="modifier_etudiant.php">
        <input type="hidden" name="matricule" value="<?php echo htmlspecialchars($etudiant['matricule']); ?>">
        <div class="input__wrapper">
            <label for="nom">Nom étudiant :</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($etudiant['Nom']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="prenom">Prénom étudiant :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($etudiant['Prenom']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="dateofbirth">Date de naissance :</label>
            <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo htmlspecialchars($etudiant['dateofbirth']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="telephone">Téléphone étudiant :</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($etudiant['telephone']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="filiere">Filière étudiant :</label>
            <input type="text" id="filiere" name="filiere" value="<?php echo htmlspecialchars($etudiant['filiere']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="niveau">Niveau étudiant :</label>
            <input type="text" id="niveau" name="niveau" value="<?php echo htmlspecialchars($etudiant['niveau']); ?>" required>
        </div>
        <button type="submit">Enregistrer les modifications</button>
    </form>
  </div>
</div>


<button onclick="goBack()" class="button">
<svg width="20" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>Retour
</button>

<script src="script_profile.js"></script>
    <div class="container">
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($etudiant['profil']); ?>" alt="Profile Picture" class="profile-pic">
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($etudiant['Nom'] . ' ' . $etudiant['Prenom']); ?></h1>
                <p>Date de naissance: <?php echo htmlspecialchars($etudiant['dateofbirth']); ?></p>
                <p>(identifiant: <?php echo htmlspecialchars($etudiant['matricule']); ?>)</p>
                <div class="profile-actions">
                    <button onclick="openModal()">Modifier</button>
                    <button>Afficher le suivi de l'élève</button>
                    <button>Télécharger la fiche élève</button>
                    <button onclick="confirmDelete('<?php echo htmlspecialchars($etudiant['matricule']); ?>')" style="background-color: brown;">Supprimer</button>
                </div>
            </div>
        </div>
        <div class="profile-details">
            <p>Filière: <?php echo htmlspecialchars($etudiant['filiere']); ?></p>
            <p>Niveau: <?php echo htmlspecialchars($etudiant['niveau']); ?></p>
            <p>Telephone: <?php echo htmlspecialchars($etudiant['telephone']); ?></p>
            <p>Âge: <?php 
                $dateOfBirth = new DateTime($etudiant['dateofbirth']);
                $today = new DateTime();
                $age = $today->diff($dateOfBirth)->y;
                echo $age . ' ans';
            ?></p>
        </div>
        <img src="<?php echo htmlspecialchars($etudiant['id_qr']); ?>" alt="Profile Picture" class="profile-pic">
        <div class="attendance">
            <div class="attendance-card">
                <h3>4</h3>
                <p>En retard avec mot d'excuse</p>
            </div>
            <div class="attendance-card">
                <h3>0</h3>
                <p>En retard</p>
            </div>
            <div class="attendance-card">
                <h3>0</h3>
                <p>Absence injustifiée</p>
            </div>
            <div class="attendance-card">
                <h3>2</h3>
                <p>Absence justifiée</p>
            </div>
        </div>
        <img src=" . htmlspecialchars($row['id_qr']) . ">
    </div>

    <div class="notification">
      <div class="notification__body">
          <img
              src="../../assets/images/check-circle.svg"
              alt="Success"
              class="notification__icon"
          >
          Profil Etudiant! &#128640; 
      </div>
      <div class="notification__progress"></div>
  </div>
</body>
</html>
