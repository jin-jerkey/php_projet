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
		<div >
			<img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Profile Picture" class="profile-pic" >
			<input type="file" id="image" name="image" value="<?php echo htmlspecialchars($enseignant['image']); ?>" accept="image/*" >
		</div>
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($enseignant['id']); ?>">

		<div >
			<label for="nom">Nom :</label>
			<input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($enseignant['nom']); ?>" required>
		</div>
		<div >
			<label for="prenom">Prénom :</label>
			<input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($enseignant['prenom']); ?>" required>
		</div>
		<div >
			<label for="date_nais">Date de naissance :</label>
			<input type="date" id="date_nais" name="date_nais" value="<?php echo htmlspecialchars($enseignant['date_nais']); ?>" required>
		</div>
		<div >
			<label for="telephone">Téléphone :</label>
			<input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($enseignant['telephone']); ?>" required>
		</div>
		<div >
			<label for="email">Email :</label>
			<input type="text" id="email" name="email" value="<?php echo htmlspecialchars($enseignant['email']); ?>" required>
		</div>
		<div >
			<label for="bureau">Bureau :</label>
			<select id="bureau" name="bureau"  autocomplete="off" style="height: auto;">
					  <option > <?php echo htmlspecialchars($enseignant['bureau']); ?> </option>
					  <option value="1er" >1er etage</option>
					  <option value="2e" >2e etage</option>
					  <option value="3e" >3e etage</option>
					  <option value="4e" >4e etage</option>
					  <option value="5e" >5e etage</option>
					  <!-- Autres options -->
				  </select>
		</div>
		<div >
			<label for="departement">Departement :</label>
					<select id="departement" name="departement"  autocomplete="off" style="height: auto;">
					  <option  > <?php echo htmlspecialchars($enseignant['departement']); ?> </option>
					  <option value="informatique" >Informatique et complexite</option>
					  <option value="gestion et finance" >Gestion et finance</option>
					  <option value="Logistique et transport" >Logistique et transport</option>
					  <!-- Autres options -->
				  </select>
		</div>
		<div >
			<label for="discipline">Discipline :</label>
				  <select id="discipline" name="discipline"  autocomplete="off" style="height: auto;">
					  <option  > <?php echo htmlspecialchars($enseignant['discipline']); ?> </option>
					  <option value="Algorithme et complexite" >Algorithme et complexite</option>
					  <option value="Programmation en C" >Programmation en C</option>
					  <option value="Gestion de carriere professionnelle" >Gestion de carriere professionnelle</option>
					  <!-- Autres options -->
				  </select>
		</div>
		<button class="button" type="submit">Enregistrer les modifications</button>
	</form>
  </div>
</div>
  
	 
	 
	<main>
		<a href="enseignant.php" style="position: fixed; margin-left: 1rem; color: white; margin-top: 1rem;">
				<svg width="40" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M15 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
		</a>
		<div class="container">
		<div class="profile-header">
			<img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Profile Picture" class="profile-pic">
			<div class="profile-info">
				<h1><?php echo htmlspecialchars($enseignant['nom'] . ' ' . $enseignant['prenom']); ?></h1>
				<p>Date de naissance : <?php echo htmlspecialchars($enseignant['date_nais']); ?></p>
				<p>(Matricule: <?php echo htmlspecialchars($enseignant['matricul']); ?>)</p>
				<div class="profile-actions">
                <button id="openWindowButton" style="background-color: rgb(48, 87, 164);">Changer de mot de passe</button>
				<div id="newWindow" class="hidden">
					<img src="<?php echo htmlspecialchars($enseignant['image']); ?>" alt="Profile Picture" class="profile-pic">
	  				<h1 style="color: rgb(13, 28, 28);"><?php echo htmlspecialchars($enseignant['nom'] . ' ' . $enseignant['prenom']); ?></h1>
					<form  action="modifiermdp" method="post" style="margin-top: 1rem; margin-bottom: 1rem;">
					<div class="input__wrapper">
						<input id="password" name="mot_de_passe" type="password" class="input__field" placeholder="Your Password"
							title="Minimum 6 characters at least 1 Alphabet and 1 Number"
							pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required autocomplete="off">
						<label for="password" class="input__label">Mot de passe actuel</label>
						<svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
							<path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
							<path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
						</svg>
					</div>
					<div class="input__wrapper">
						<input id="password" name="mot_de_passenew" type="password" class="input__field" placeholder="Your Password"
							title="Minimum 6 characters at least 1 Alphabet and 1 Number"
							pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required autocomplete="off">
						<label for="password" class="input__label">Nouveau mot de passe</label>
						<svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
							<path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
							<path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
						</svg>
					</div>
					<div class="input__wrapper">
						<input id="password" name="mot_de_passenews" type="password" class="input__field" placeholder="Your Password"
							title="Minimum 6 characters at least 1 Alphabet and 1 Number"
							pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required autocomplete="off">
						<label for="password" class="input__label">Confirmer le mot de passe</label>
						<svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
							stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
							<path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
							<path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
						</svg>
					</div>
					<input type="submit" value="Valider" class="my-form__button">
					</form>
					<button id="closeWindowButton">Fermer</button>
				</div>
				<script src="script_profil.js"></script>
				<button onclick="openModal()">Modifier</button>
				<button onclick="confirmDelete('<?php echo htmlspecialchars($enseignant['id']); ?>')" style="background-color: brown;">Supprimer</button>
			</div>   
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
			<p>Telephone : (+237) <?php echo htmlspecialchars($enseignant['telephone']); ?></p>
			<p><?php echo htmlspecialchars($enseignant['email']); ?></p>
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