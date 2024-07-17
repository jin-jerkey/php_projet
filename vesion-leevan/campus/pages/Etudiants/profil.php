<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
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
    <h2 style="color:#CBD1D8" ><?php echo htmlspecialchars($etudiant['Nom']);?> <?php echo htmlspecialchars( $etudiant['Prenom']); ?></h2>
    <form class="my-form" method="post" action="modifier_etudiant.php" enctype="multipart/form-data">
    <input type="hidden" name="matricule" value="<?php echo htmlspecialchars($etudiant['matricule']); ?>">
    <div class="input__wrapper">
                <img src="<?php echo htmlspecialchars($etudiant['profil']); ?>" alt="Profile Picture" class="profile-pic">
                  <input type="file" id="profil" name="profil" value="<?php echo htmlspecialchars($etudiant['profil']); ?>" accept="image/*" class="input__field">
              </div>
              <div class="input__wrapper">
                  <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 21v-4a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v4" />
                      <circle cx="12" cy="7" r="4" />
                  </svg>
                  <label for="nom" class="input__label">Nom étudiant :</label>
                  <input type="text" id="nom" name="nom" class="input__field" value="<?php echo htmlspecialchars($etudiant['Nom']); ?>" placeholder="Nom étudiant" required autocomplete="off">
              </div>
              <div class="input__wrapper">
                    <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 21v-4a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v4" />
                      <circle cx="12" cy="7" r="4" />
                    </svg> 
                  <label for="prenom" class="input__label">Prénom étudiant :</label>
                  <input type="text" id="prenom" name="prenom" class="input__field" value="<?php echo htmlspecialchars($etudiant['Prenom']); ?>" placeholder="Prénom étudiant" required autocomplete="off">                              
              </div>
              <div class="input__wrapper">
                  <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M4 4h5l-1 5a11 11 0 0 0 7 7l5 -1v5a2 2 0 0 1 -2 2a16 16 0 0 1 -16 -16a2 2 0 0 1 2 -2"></path>
                  </svg>  
                  <label for="telephone" class="input__label">Téléphone étudiant :</label>    
                  <input type="text" id="telephone" name="telephone" class="input__field" value="<?php echo htmlspecialchars($etudiant['telephone']); ?>" placeholder="Téléphone étudiant" required autocomplete="off">  
              </div>
              <div class="input__wrapper">
                  <label for="dateofbirth" class="input__label">Date d'anniversaire :</label> 
                  <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo htmlspecialchars($etudiant['dateofbirth']); ?>" class="input__field" required autocomplete="off">
              </div>
              <div class="input__wrapper">
                    <label for="filiere" class="input__label">Filière étudiant :</label>
                    <select id="filiere" name="filiere" class="input__field"  autocomplete="off" style="height: auto;">
                        <option  class="input__field"> <?php echo htmlspecialchars($etudiant['filiere']); ?> </option>
                        <option value="GL" class="input__field">Génie Logiciel</option>
                      <!-- Autres options -->
                  </select>
              </div>
              <div class="input__wrapper">
                    <label for="niveau" class="input__label">Niveau étudiant :</label> 
                  <select id="niveau" name="niveau" class="input__field" autocomplete="off" style="height: auto;">
                      <option  class="input__field"> <?php echo htmlspecialchars($etudiant['niveau']); ?> </option>
                      <option value="1" class="input__field">1</option>
                      <option value="2" class="input__field">2 [ BTS / HND ]</option>
                      <option value="3" class="input__field">3 [ LICENCE / BACHELOR ]</option>
                      <option value="4" class="input__field">4 [ MASTER I ]</option>
                      <option value="5" class="input__field">5 [ MASTER II ]</option>
                      <!-- Autres options -->
                  </select> 
              </div>
              
              <button type="submit" class="button">Enregistrer les modifications</button>
          </form>
  </div>
</div>

<a href="etudiant.php">
    <button class="button">
        <svg width="20" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Retour
    </button>
</a>
<script src="script_profile.js"></script>
    <div class="container">
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($etudiant['profil']); ?>" alt="Profile Picture" class="profile-pic">
            
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($etudiant['Nom'] . ' ' . $etudiant['Prenom']); ?></h1>
                <p>Date de naissance: <?php echo htmlspecialchars($etudiant['dateofbirth']); ?></p>
                <p>(identifiant: <?php echo htmlspecialchars($etudiant['matricule']); ?>)</p>
                <div class="profile-actions">
                    <button>Télécharger la fiche de l'étudiant</button>
                    <button onclick="openModal()">Modifier</button>
                    <button onclick="confirmDelete('<?php echo htmlspecialchars($etudiant['matricule']); ?>')" style="background-color: brown;">Supprimer</button>
                </div>
            </div>
        </div>
        <div class="profile-details">
            <p>Filière: <?php echo htmlspecialchars($etudiant['filiere']); ?></p>
            <p>Niveau: <?php echo htmlspecialchars($etudiant['niveau']); ?></p>
            <p>Telephone: (+237) <?php echo htmlspecialchars($etudiant['telephone']); ?></p>
            <p>Âge: <?php 
                $dateOfBirth = new DateTime($etudiant['dateofbirth']);
                $today = new DateTime();
                $age = $today->diff($dateOfBirth)->y;
                echo $age . ' ans';
            ?></p>
            <p>QR Code :</p>
            <img src="<?php echo htmlspecialchars($etudiant['id_qr']); ?>" alt="Profile Picture" width="20" height="20" style="margin-top:15px">
        </div>
        
        <div class="attendance">
            <div class="attendance-card">
                <h3>0</h3>
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
                <h3>0</h3>
                <p>Absence justifiée</p>
            </div>
        </div>
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
