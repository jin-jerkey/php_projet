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
        $id = $_GET['id'];

        $sql = "SELECT * FROM enseignant WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$enseignant) {
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Campus school</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_profil.css">
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
      function confirmDelete(id) {
          if (confirm("Êtes-vous sûr de vouloir supprimer cet enseignant ?")) {
              window.location.href = "supprimer.php?id=" + id;
          }
      }
  </script>
  

</head>
<body>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 style="color:#CBD1D8" ><?php echo htmlspecialchars($enseignant['nom']);?> <?php echo htmlspecialchars( $enseignant['prenom']); ?></h2>
    <form method="post" action="modifier_enseignant.php" enctype="multipart/form-data">
        <input type="hidden" name="matricul" value="<?php echo htmlspecialchars($enseignant['matricul']); ?>">
        <div class="input__wrapper">
            <img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Profile Picture" class="profile-pic" >
            <input type="file" id="image" name="image" value="<?php echo htmlspecialchars($enseignant['image']); ?>" accept="image/*" class="input__field">
        </div>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($enseignant['id']); ?>">

        <div class="input__wrapper">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($enseignant['nom']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($enseignant['prenom']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="date_nais">Date de naissance :</label>
            <input type="date" id="date_nais" name="date_nais" value="<?php echo htmlspecialchars($enseignant['date_nais']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="telephone">Téléphone :</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($enseignant['telephone']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="email">Email :</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($enseignant['email']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="bureau">Bureau :</label>
            <select id="bureau" name="bureau" class="input__field" autocomplete="off" style="height: auto;">
                      <option  class="input__field"> <?php echo htmlspecialchars($enseignant['bureau']); ?> </option>
                      <option value="1er" class="input__field">1er etage</option>
                      <option value="2e" class="input__field">2e etage</option>
                      <option value="3e" class="input__field">3e etage</option>
                      <option value="4e" class="input__field">4e etage</option>
                      <option value="5e" class="input__field">5e etage</option>
                      <!-- Autres options -->
                  </select>
        </div>
        <div class="input__wrapper">
            <label for="departement">Departement :</label>
                    <select id="departement" name="departement" class="input__field" autocomplete="off" style="height: auto;">
                      <option  class="input__field"> <?php echo htmlspecialchars($enseignant['departement']); ?> </option>
                      <option value="informatique" class="input__field">Informatique et complexite</option>
                      <option value="gestion et finance" class="input__field">Gestion et finance</option>
                      <option value="Logistique et transport" class="input__field">Logistique et transport</option>
                      <!-- Autres options -->
                  </select>
        </div>
        <div class="input__wrapper">
            <label for="discipline">Discipline :</label>
                  <select id="discipline" name="discipline" class="input__field" autocomplete="off" style="height: auto;">
                      <option  class="input__field"> <?php echo htmlspecialchars($enseignant['discipline']); ?> </option>
                      <option value="Algorithme et complexite" class="input__field">Algorithme et complexite</option>
                      <option value="Programmation en C" class="input__field">Programmation en C</option>
                      <option value="Gestion de carriere professionnelle" class="input__field">Gestion de carriere professionnelle</option>
                      <!-- Autres options -->
                  </select>
        </div>
        <button class="button" type="submit">Enregistrer les modifications</button>
    </form>
  </div>
</div>
  
     
     
    <main>
        <a href="enseignant.php" style="position: fixed; margin-left: -20px;">
                <svg width="40" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </a>

        <div class="container">

        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Profile Picture" class="profile-pic">
            <div class="profile-actions">
                    <button onclick="openModal()">Modifier</button>
                    <button onclick="confirmDelete('<?php echo htmlspecialchars($enseignant['id']); ?>')" style="background-color: brown;">Supprimer</button>
            </div>
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($enseignant['nom'] . ' ' . $enseignant['prenom']); ?></h1>
                <p><?php echo htmlspecialchars($enseignant['email']); ?></p>
                <p>(Matricule: <?php echo htmlspecialchars($enseignant['matricul']); ?>)</p>
                <p>Telephone : (+237) <?php echo htmlspecialchars($enseignant['telephone']); ?></p>
             
            </div>
        </div>
        <div class="profile-details">
        <p>Âge : <?php 
                $dateOfBirth = new DateTime($enseignant['date_nais']);
                $today = new DateTime();
                $age = $today->diff($dateOfBirth)->y;
                echo $age . ' ans';
                ?>
            </p>
        <p>Bureau :<?php echo htmlspecialchars($enseignant['bureau']); ?> étage</p>
            <p>Date de naissance : <?php echo htmlspecialchars($enseignant['date_nais']); ?></p>
            <p>Departement : <?php echo htmlspecialchars($enseignant['departement']); ?></p>
            <p>Discipline : <?php echo htmlspecialchars($enseignant['discipline']); ?></p>
        </div>
    
        <!-- Ajoutez plus de contenu ici pour tester le défilement -->
    </main>
    <div class="notification">
      <div class="notification__body">
          <img
              src="../../assets/images/check-circle.svg"
              alt="Success"
              class="notification__icon"
          >
          Menu Profil enseignant selectionne! &#128640; 
      </div>
      <div class="notification__progress"></div>
  </div>
</body>
</html>