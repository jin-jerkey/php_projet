<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
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
    <link rel="stylesheet" href="style_cahier_de_presence.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <aside>
        <div class="sidebar-top">

            <a href="#" class="logo__wrapper">
                <img src="../../assets/images/imelogos.png" alt="Logo" class="logo-small">
                <span class="hide">
                IME - SCHOOL
                </span>
            </a>
        </div>
        <div class="search__wrapper">
            <svg width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                d="M9 9L13 13M5.66667 10.3333C3.08934 10.3333 1 8.244 1 5.66667C1 3.08934 3.08934 1 5.66667 1C8.244 1 10.3333 3.08934 10.3333 5.66667C10.3333 8.244 8.244 10.3333 5.66667 10.3333Z"
                stroke="#697089" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input type="search" placeholder="Search for anything...">
        </div>
        <div class="user-info">
            <div class="sidebar__profile">
                <div class="avatar__wrapper">
                    <img class="avatar" src="../../assets/images/leevan.jpg" alt="Joe Doe Picture">
                <div class="online__status"></div>
            </div>
            <section class="avatar__name hide">
                <div class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></div>
                <div class="email"><?php echo htmlspecialchars($_SESSION['user_email']); ?></div>
            </section>
            <a href="../login/logout.php"  class="logout">
                <svg type="button" onclick="confirmLogout()" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M9 12h12l-3 -3"></path>
                    <path d="M18 15l3 -3"></path>
                </svg>
            </a>
            <script>
                function confirmLogout() {
                    if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
                        window.location.href = "../login/logout.php";  // Redirection vers logout.php si confirmation
                    }
                }
            </script>

        </div>
        <div class="sidebar-links">
            <ul class="menu">
            <li>
              <a href="../Etudiants/etudiant.php" title="Apprenants" class="tooltip" class="menu-button active" onclick="handleClick(this)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <circle cx="9" cy="7" r="4" />
                  <path d="M17 11a3 3 0 1 0 -4 -4" />
                  <path d="M12 16v-1a3 3 0 0 0 -3 -3h-3a3 3 0 0 0 -3 3v1" />
                  <path d="M21 17v-1a3 3 0 0 0 -2.824 -2.995l-.176 -.005h-3a3 3 0 0 0 -3 3v1" />
                </svg>
                  <span class="link hide">Etudiants</span>
                  <span class="tooltip__content">sector with manage students</span>
              </a>
          </li>
      
          
          <li>
            <a href="../Enseignants/enseignant.php" title="Professeurs" class="tooltip" class="menu-button" onclick="handleClick(this)">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-teacher" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="7" r="4" />
                <path d="M4 19v-2a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v2" />
                <path d="M12 11v4" />
                <path d="M10 15h4" />
              </svg>
                <span class="link hide">Enseignants</span>
                <span class="tooltip__content">sector with manage professors</span>
            </a>
          </li>
          <li>
            <a href="../Cahier_de_presence/cahier_de_presence.php" title="Presence" class="tooltip" class="menu-button" onclick="handleClick(this)">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M8 7a4 4 0 1 1 8 0m0 4v1a4 4 0 0 1 -4 4h-1" />
                <path d="M16 12h6" />
                <path d="M21 21l-18 -18" />
                <path d="M5 5v2m2 2h4m2 0h1" />
              </svg>
              <span class="link hide">Cahier de presence</span>
            </a>
          </li>
          <li>
            <a href="../Bilan_de_presence/bilan_de_presence.php" title="Bilan" class="tooltip" class="menu-button" onclick="handleClick(this)">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <ellipse cx="12" cy="6" rx="8" ry="3" />
                <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
              </svg>
              <span class="link hide">Bilan de presence</span>
            </a>
          </li>
          <li>
            <a href="../utilisateurs/utilisateur.php" title="Users" class="tooltip" class="menu-button" onclick="handleClick(this)">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="7" r="4" />
                <path d="M5.5 21h13a2 2 0 0 0 2 -2v-1a7 7 0 0 0 -7 -7h-3a7 7 0 0 0 -7 7v1a2 2 0 0 0 2 2" />
              </svg>
              <span class="link hide">Admin</span>
            </a>
          </li>
            </ul>
        </div>
    </aside>
    <script src="../script.js"></script>
    <script src="script_cahier_de_presence.js"></script>

    <main>
    <div class="container">
        
        <div class="controls">
          <button onclick="openModal()">faire l'appel</button>
        </div>

        <!-- Modal pour Faire l'appel -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>nouvelle sceance</h2>
                <br><br>
                <form id="cahierAppelForm" method="post" action="create.php">
                    <label for="matricul">Matricule:</label>
                    <input type="text" id="matricul" name="matricul" required><br><br>
                    
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required><br><br>
                    
                    <label for="heure">Heure:</label>
                    <input type="time" id="heure" name="heure" required><br><br>
                    
                    <label for="periode">Période:</label>
                    <input type="number" id="periode" name="periode" required><br><br>
                    
                    <label for="classe">Filiere</label>
                    <select id="classe"  name="filiere" required autocomplete="off">
                        <option  value="">-- Sélectionner --</option>
                        <option  value="GL">Genie Logiciel</option>
                    </select><br><br>
                    
                    <label for="groupe">Niveau</label>
                    <select id="groupe"  name="niveau" required autocomplete="off">
                      <option value="" class="input__field">-- Selectionner --</option>
                      <option value="1" class="input__field">1</option>
                      <option value="2" class="input__field">2 [ BTS / HND ]</option>
                      <option value="3" class="input__field">3 [ LICENSE / BACHELOR ]</option>
                      <option value="4" class="input__field">4 [ MASTER I ]</option>
                      <option value="5" class="input__field">5 [ MASTER II ]</option>
                    </select><br><br>
                    
                    <label for="matiere">Matière:</label>
                    <select id="classe"  name="matiere" required autocomplete="off">
                        <option  value="">-- Sélectionner --</option>
                        <option  value="math">Mathematique</option>
                    </select><br><br>
                    
                    <label for="professeur">Professeur:</label>
                    <select id="classe" name="professeur" required>
                    <option  value="">-- Sélectionner --</option>
                      <?php
                      $dsn = 'mysql:host=localhost;dbname=campus_school';
                      $username = 'root';
                      $password = '';

                      try {
                          $pdo = new PDO($dsn, $username, $password);
                          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                          $stmt = $pdo->query("SELECT * FROM enseignant");
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              echo '<option value="' . $row['nom'] . '">' . $row['nom'] . '</option>';
                          }
                      } catch (PDOException $e) {
                          echo 'Erreur : ' . $e->getMessage();
                      }
                      ?>
                    </select>
                      <br><br>
                    
                    <input type="submit" value="Enregistrer">
                </form>
            </div>
        </div>
        <script>
            function openModal() {
                document.getElementById("myModal").style.display = "block";
                genererEtAfficherIdentifiant(); // Appelle la fonction pour générer et afficher l'identifiant
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

            function genererEtAfficherIdentifiant() {
                var prefixe = "CA";
                var surfixe = "APP";
                var identifiant = prefixe + genererIdentifiant() + surfixe;
                document.getElementById("matricul").value = identifiant;
            }

            function genererIdentifiant() {
                return Math.random().toString(36).substr(2, 4); // Génère une chaîne aléatoire de 4 caractères
            }
        </script>


        <!-- la partie de recherche -->

        <form action="" method="post" >
          <div class="filters">
          
            <div class="filter">
                <label  for="date">Date</label>
                <input class="input__field" type="date" id="date" required autocomplete="off">
            </div>
             
            <div class="filter">
                <label for="classe">Filiere</label>
                <select id="classe" name="filiere" required autocomplete="off">
                    <option  value="">-- Sélectionner --</option>
                    <option  value="GL">Genie Logiciel</option>
                </select>
            </div>
            <div class="filter">
                <label for="groupe">Niveau</label>
                <select id="groupe" name="niveau" required autocomplete="off">
                  <option value="" class="input__field">-- Selectionner --</option>
                  <option value="1" class="input__field">1</option>
                  <option value="2" class="input__field">2 [ BTS / HND ]</option>
                  <option value="3" class="input__field">3 [ LICENSE / BACHELOR ]</option>
                  <option value="4" class="input__field">4 [ MASTER I ]</option>
                  <option value="5" class="input__field">5 [ MASTER II ]</option>
                </select>
            </div>
             
            <button style="background-color: rgb(122, 132, 243); color: azure; border: none;" type="submit">Voir</button>
          </div>
        </form>
        
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
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Matricule</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Periode</th>
                        <th>filiere</th>
                        <th>Niveau</th>
                        <th>Matiere</th>
                        <th>Professeur</th>
                        <th>Appel</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  $dsn = 'mysql:host=localhost;dbname=campus_school';
                  $username = 'root';
                  $password = '';

                  try {
                      $pdo = new PDO($dsn, $username, $password);
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                      // Récupérer les valeurs de filière et niveau depuis le formulaire
                      $date = isset($_POST['date']) ? $_POST['date'] : '';
                      $filiere = isset($_POST['filiere']) ? $_POST['filiere'] : '';
                      $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';

                      // Construire la requête SQL avec les conditions appropriées
                      $sql = "SELECT * FROM cahier_appel  WHERE 1";

                      if (!empty($filiere)) {
                          $sql .= " AND date = :date";
                      }
                      if (!empty($filiere)) {
                          $sql .= " AND filiere = :filiere";
                      }
                      if (!empty($niveau)) {
                          $sql .= " AND niveau = :niveau";
                      }

                      $stmt = $pdo->prepare($sql);

                      if (!empty($date)) {
                          $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                      }
                      if (!empty($filiere)) {
                          $stmt->bindParam(':filiere', $filiere, PDO::PARAM_STR);
                      }
                      if (!empty($niveau)) {
                          $stmt->bindParam(':niveau', $niveau, PDO::PARAM_INT);
                      }

                      $stmt->execute();
                      $counter = 1;

                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          echo "<tr>";
                          echo "<td>" . $counter++ . "</td>";
                          echo "<td>" . htmlspecialchars($row['matricul']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['heure']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['periode']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['filiere']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['niveau']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['matiere']) . "</td>";
                          echo "<td>" . htmlspecialchars($row['professeur']) . "</td>";
                          echo "<td><a href='appel.php?id=" . htmlspecialchars($row['id']) . "'><svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M12 4.5C7.5 4.5 3.737 7.252 2 12c1.737 4.748 5.5 7.5 10 7.5s8.263-2.752 10-7.5c-1.737-4.748-5.5-7.5-10-7.5zm0 13c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zm0-8.5c-1.93 0-3.5 1.57-3.5 3.5s1.57 3.5 3.5 3.5 3.5-1.57 3.5-3.5-1.57-3.5-3.5-3.5z' fill='currentColor'/></svg></a></td>";
                          echo "</tr>";
                      }

                  } catch (PDOException $e) {
                      echo "Erreur : " . $e->getMessage();
                  }
                  ?>
                    
                </tbody>
            </table>
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
          Menu cahier de presence selectionne! &#128640; 
      </div>
      <div class="notification__progress"></div>
  </div>
</body>
</html>