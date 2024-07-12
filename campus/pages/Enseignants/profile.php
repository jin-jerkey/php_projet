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
    <h2>Modifier les informations de l'étudiant</h2>
    <form method="post" action="modifier_enseignant.php" enctype="multipart/form-data">
        <input type="hidden" name="matricul" value="<?php echo htmlspecialchars($enseignant['matricul']); ?>">
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
            <input type="text" id="bureau" name="bureau" value="<?php echo htmlspecialchars($enseignant['bureau']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="departement">Departement :</label>
            <input type="text" id="departement" name="departement" value="<?php echo htmlspecialchars($enseignant['departement']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="discipline">Discipline :</label>
            <input type="text" id="discipline" name="discipline" value="<?php echo htmlspecialchars($enseignant['discipline']); ?>" required>
        </div>
        <div class="input__wrapper">
            <label for="image">image :</label>
            <input type="file" id="image" name="image" value="<?php echo htmlspecialchars($enseignant['image']); ?>" required>
            <img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Image actuelle" width="100"><br><br>
        </div>
        <button type="submit">Enregistrer les modifications</button>
    </form>
  </div>
</div>
  
     
     
    <main>
        <a href="enseignant.php"><button>retour</button></a>
        <button onclick="openModal()">Modifier</button>
        <button onclick="confirmDelete('<?php echo htmlspecialchars($enseignant['id']); ?>')" style="background-color: brown;">Supprimer</button>
        

        <div class="container">

        <div class="profile">
            <img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Profile Picture" class="profile-pic">
            <h2><?php echo htmlspecialchars($enseignant['nom']); ?> <?php echo htmlspecialchars($enseignant['prenom']); ?></h2>   
        </div>
        <div class="info-section">
            <u><h2>Informations generales</h2></u>
        </div>
        
        <div class="student-info">
           
            <div class="info-section">
                <p><strong>Matricule: </strong><?php echo htmlspecialchars($enseignant['matricul']); ?></p>
                <p><strong>Bureau: </strong><?php echo htmlspecialchars($enseignant['bureau']); ?></p>
                <p><strong>Departement: </strong><?php echo htmlspecialchars($enseignant['departement']); ?></p>
                <p><strong>Telephone: </strong><?php echo htmlspecialchars($enseignant['telephone']); ?></p>
                <p><strong>Email: </strong><?php echo htmlspecialchars($enseignant['email']); ?></p>
            </div>
            <div class="info-section">
                <p><strong>Discipline: </strong><?php echo htmlspecialchars($enseignant['discipline']); ?></p>
                <p><strong>Date of Birth: </strong><?php echo htmlspecialchars($enseignant['date_nais']); ?></p>
            </div>
            
        </div>
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
          Menu Bilan de presence selectionne! &#128640; 
      </div>
      <div class="notification__progress"></div>
  </div>
</body>
</html>