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

        $sql = "SELECT * FROM cahier_appel WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $cahier = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cahier) {
            echo "cahier non trouvé";
            exit();
        }
    } else {
        echo "id non fourni";
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
    <title>Campus school</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_appel.css">
</head>
<body>
  
    <script src="../script.js"></script>
    <script type="module" src="script_cahier_de_presence.js"></script>

     <!-- Modal des absences -->
     <div id="absenceModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Les absences</h2>
            <p>Votre contenu ici...</p>
        </div>
    </div>

    <!-- Modal des participants -->
    <div id="verifyModal" class="modal"> 
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>particant au cour</h2>
            <br><br>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>matricule</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>filiere</th>
                            <th>niveau</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        try {
                            $pdo = new PDO($dsn, $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $filiere = $cahier['filiere'];
                            $niveau = $cahier['niveau'];
                            $sql = "SELECT * FROM etudiant WHERE filiere = :filiere AND niveau = :niveau";
                            
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':filiere', $filiere, PDO::PARAM_STR);
                            $stmt->bindParam(':niveau', $niveau, PDO::PARAM_STR);
                            
                            $stmt->execute();
                            $counter = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>" . $counter++ . "</td>
                                        <td>" . htmlspecialchars($row["matricule"]) . "</td>
                                        <td>" . htmlspecialchars($row["Nom"]) . "</td>
                                        <td>" . htmlspecialchars($row["Prenom"]) . "</td>
                                        <td>" . htmlspecialchars($row["filiere"]) . "</td>
                                        <td>" . htmlspecialchars($row["niveau"]) . "</td>
                                    </tr>";
                            }
                            echo "</table>";

                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal du scanner -->
    <div id="attendanceModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Scanner QR Code</h2>
            <div class="container">
                <video id="preview" width="600" height="400"></video>
                <button id="start-button">Démarrer le scan</button>
                <div id="result"></div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
            <script src="scanner.js"></script>
        </div>
    </div>

    <main>
    <div class="container">
        <audio id="success-sound" src="../../assets/sound/succes.mp3"></audio>
        <audio id="error-sound" src="../../assets/sound/error.mp3"></audio>

        <!-- place des bouton -->
        <div class="controls">
            <a href="cahier_de_presence.php"><button>retour</button></a>
            <button id="openAttendanceModalBtn">Faire l'appel</button>
            <button id="openVerifyModalBtn">Participants au cour</button>
            <button id="openAbsenceModalBtn">Participant absence</button>
        </div>
        <!-- detail part 1 -->
        <div class="filters">
            <div class="filter">
                <label  for="date-debut">Matricul de lq sceance :</label>
                 <h2><?php echo htmlspecialchars($cahier['matricul']); ?></h2>
            </div>
            <div class="filter">
                <label  for="date-debut">Professeure :</label>
                 <h2><?php echo htmlspecialchars($cahier['professeur']); ?></h2>
            </div>   
        </div>
        <!-- detail part 2 -->
        <div class="filters">
            <div class="filter">
                <label  for="date-debut">Date de la sceance :</label>
                 <h2><?php echo htmlspecialchars($cahier['date']); ?></h2>
            </div>
            <div class="filter">
                <label  for="date-debut">Heure de la sceance :</label>
                 <h2><?php echo htmlspecialchars($cahier['heure']); ?></h2>
            </div>
            <div class="filter">
                <label  for="date-debut">Periode :</label>
                 <h2><?php echo htmlspecialchars($cahier['periode']); ?></h2>
            </div>
        </div>
        <!-- detail part 3 -->
        <div class="filters">
            <div class="filter">
                <label  for="date-debut">Filiere :</label>
                 <h2><?php echo htmlspecialchars($cahier['filiere']); ?></h2>
            </div>
            <div class="filter">
                <label  for="date-debut">Niveau :</label>
                 <h2><?php echo htmlspecialchars($cahier['niveau']); ?></h2>
            </div>
            <div class="filter">
                <label  for="date-debut">Matiere :</label>
                 <h2><?php echo htmlspecialchars($cahier['matiere']); ?></h2>
            </div>
        </div>
        
        <!-- les import au scanner -->

        <input type="hidden" id="cahier_matricul" value="<?php echo htmlspecialchars($cahier['matricul']); ?>">
        <input type="hidden" id="cahier_professeur" value="<?php echo htmlspecialchars($cahier['professeur']); ?>">
        <input type="hidden" id="cahier_date" value="<?php echo htmlspecialchars($cahier['date']); ?>">
        <input type="hidden" id="cahier_heure" value="<?php echo htmlspecialchars($cahier['heure']); ?>">
        <input type="hidden" id="cahier_periode" value="<?php echo htmlspecialchars($cahier['periode']); ?>">
        <input type="hidden" id="cahier_filiere" value="<?php echo htmlspecialchars($cahier['filiere']); ?>">
        <input type="hidden" id="cahier_niveau" value="<?php echo htmlspecialchars($cahier['niveau']); ?>">
        <input type="hidden" id="cahier_matiere" value="<?php echo htmlspecialchars($cahier['matiere']); ?>">


        <!-- statistique -->
        <div class="stats">
            <div class="stat">
                <h2><span class="number">0</span></h2>
                <span class="label">En retard</span>
            </div>
            <div class="stat">
                <h2><span class="number">0</span></h2>
                <span class="label">Absence injustifiée</span>
            </div>
            <div class="stat">
                <h2><span class="number">0</span></h2>
                <span class="label">Absence justifiée</span>
            </div>
        </div>
        <!-- liste des presents -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Matricule</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Periode</th>
                        <th>Filiere</th>
                        <th>Niveau</th>
                        <th>Matiere</th>
                        <th>Professeur</th>
                        <th>M_Etudiant</th>
                        <th>Nom_etudiant</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        try {
                            $sql = "SELECT * FROM appel";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();

                            $counter = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                        <td>" . $counter++ . "</td>
                                        <td>" . htmlspecialchars($row["matricul"]) . "</td>
                                        <td>" . htmlspecialchars($row["date"]) . "</td>
                                        <td>" . htmlspecialchars($row["heure"]) . "</td>
                                        <td>" . htmlspecialchars($row["periode"]) . "</td>
                                        <td>" . htmlspecialchars($row["filiere"]) . "</td>
                                        <td>" . htmlspecialchars($row["niveau"]) . "</td>
                                        <td>" . htmlspecialchars($row["matiere"]) . "</td>
                                        <td>" . htmlspecialchars($row["professeur"]) . "</td>
                                        <td>" . htmlspecialchars($row["m_eleve"]) . "</td>
                                        <td>" . htmlspecialchars($row["nom_eleve"]) . "</td>
                                        <td>" . htmlspecialchars($row["etat"]) . "</td>
                                    </tr>";
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </main>
    <div class="notification">
      <div class="notification__body">
          <img src="../../assets/images/check-circle.svg" alt="Success" class="notification__icon">
          Menu cahier de presence selectionne! &#128640; 
      </div>
      <div class="notification__progress"></div>
  </div>
   

</body>
</html>
