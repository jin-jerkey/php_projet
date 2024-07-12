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
    <link rel="stylesheet" href="style_enseignant.css">
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
                <div class="user-name">Lee Van</div>
                <div class="email">lee.van@ime-school.com</div>
            </section>
            <a href="#logout" class="logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M9 12h12l-3 -3"></path>
                    <path d="M18 15l3 -3"></path>
                </svg>
            </a>
        </div>
        <div class="sidebar-links">
            <ul class="menu">
            <li>
              <a href="../Etudiants/etudiant.php" title="Sector" class="tooltip" class="menu-button active" onclick="handleClick(this)">
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
            <a href="../Enseignants/enseignant.php" title="Absence" class="tooltip" class="menu-button" onclick="handleClick(this)">
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
            <a href="../Cahier_de_presence/cahier_de_presence.php" title="Users" class="tooltip" class="menu-button" onclick="handleClick(this)">
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
            <a href="../Bilan_de_presence/bilan_de_presence.php" title="teacher" class="tooltip" class="menu-button" onclick="handleClick(this)">
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
            <a href="../Emplois_de_temps/Emplois_de_temps.php" title="sector with manage presence" class="tooltip" class="menu-button" onclick="handleClick(this)">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M8 4h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2" />
                <path d="M8 4v16" />
                <path d="M12 8h4" />
                <path d="M12 12h4" />
                <path d="M12 16h4" />
                <path d="M4 6h1" />
                <path d="M4 10h1" />
                <path d="M4 14h1" />
                <path d="M4 18h1" />
              </svg>
              <span class="link hide">Emplois de temps</span>
            </a>
          </li>
            </ul>
        </div>
    </aside>
    <script src="../script_enseignant.js"></script>
    <main>
        <div class="container">
            <!--add-stdent-btn-->
          <button id="openModalBtn" class="add-attendance" >+ Ajouter Des étudiants</button>
          <!--Modal d'inscription d'etudiant-->
          <div id="myModal" class="modal">
            <div class="modal-content">
              
            <form class="my-form" method="post" action="create.php">
              <span class="close">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <line x1="18" y1="6" x2="6" y2="18" />
                      <line x1="6" y1="6" x2="18" y2="18" />
                  </svg>
              </span>
              <div class="login-welcome-row">
                  <a href="#" title="Logo">
                      <img style="border-radius: 50%;" src="../../assets/images/imelogos.png" alt="Logo" class="logo">
                  </a>
                  <h2>&#x1F393;ENSEIGNANT&#127891;</h2>
              </div>
              <div class="input__wrapper">
                  <span id="identifiant">
                      <input type="text" id="matricul" name="matricul" class="input__field" placeholder="Matricule" required autocomplete="off">
                  </span>
                  <button type="button" class="my-form__button" onclick="genererEtAfficherIdentifiant()">Générer matricule</button>
                  <script>
                      function genererEtAfficherIdentifiant() {
                          var prefixe = "UN";
                          var surfixe = "IME";
                          var identifiant = prefixe + genererIdentifiant() + surfixe;
                          document.getElementById("matricul").value = identifiant;
                      }
                      
                      function genererIdentifiant() {
                          return Math.random().toString(36).substr(2, 4); // Génère une chaîne aléatoire de 4 caractères
                      }
                  </script>
              </div>
              <div class="input__wrapper">
                  <input type="text" id="nom" name="nom" class="input__field" placeholder="Nom" required autocomplete="off">
                  <label for="nom" class="input__label">Nom :</label>
                  <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 21v-4a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v4" />
                      <circle cx="12" cy="7" r="4" />
                  </svg>
              </div>
              <div class="input__wrapper">
                  <input type="text" id="prenom" name="prenom" class="input__field" placeholder="Prénom" required autocomplete="off">
                  <label for="prenom" class="input__label">Prénom :</label>
                  <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 21v-4a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v4" />
                      <circle cx="12" cy="7" r="4" />
                  </svg>              
              </div>
              <div class="input__wrapper">
                  <input type="text" id="telephone" name="telephone" class="input__field" placeholder="Téléphone" required autocomplete="off">
                  <label for="telephone" class="input__label">Téléphone :</label>
                  <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M4 4h5l-1 5a11 11 0 0 0 7 7l5 -1v5a2 2 0 0 1 -2 2a16 16 0 0 1 -16 -16a2 2 0 0 1 2 -2"></path>
                  </svg>              
              </div>
              <div class="input__wrapper">
                  <input type="email" id="email" name="email" class="input__field" placeholder="email" required autocomplete="off" value="@gmail.com">
                  <label for="HA" class="input__label">Email:</label>
                  <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 7v-3m-4 5h8m-8 4h8m-4 -3v5" />
                      <line x1="3" y1="3" x2="21" y2="21" />
                  </svg>                         
              </div>
              <div class="input__wrapper">
                  <input type="date" id="date_nais" name="date_nais" class="input__field" required autocomplete="off">
                  <label for="dateofbirth" class="input__label">Date d'anniversaire :</label> 
              </div>
              <div class="input__wrapper">
                  <select id="bureau" name="bureau" class="input__field" required autocomplete="off" style="height: auto;">
                      <option value="" class="input__field">-- Sélectionner --</option>
                      <option value="GL" class="input__field">Génie Logiciel</option>
                      <!-- Autres options -->
                  </select>
                  <label for="bureau" class="input__label">Bureau :</label>
              </div>
              <div class="input__wrapper">
                  <select id="departement" name="departement" class="input__field" required autocomplete="off" style="height: auto;">
                      <option value="" class="input__field">-- Sélectionner --</option>
                      <option value="1" class="input__field">1</option>
                      <option value="2" class="input__field">2 [ BTS / HND ]</option>
                      <option value="3" class="input__field">3 [ LICENCE / BACHELOR ]</option>
                      <option value="4" class="input__field">4 [ MASTER I ]</option>
                      <option value="5" class="input__field">5 [ MASTER II ]</option>
                      <!-- Autres options -->
                  </select>   
                  <label for="niveau" class="input__label">Departement :</label> 
              </div>
              <div class="input__wrapper">
                  <select id="discipline" name="discipline" class="input__field" required autocomplete="off" style="height: auto;">
                      <option value="" class="input__field">-- Sélectionner --</option>
                      <option value="GL" class="input__field">Génie Logiciel</option>
                      <!-- Autres options -->
                  </select>
                  <label for="discipline" class="input__label">Discipline :</label>
              </div>
              <div class="input__wrapper">
                  <input type="file" id="image" name="image" accept="image/*" class="input__field">
                  <label for="image" class="input__label">Importer une image de profil :</label>
              </div>
              <button type="submit" class="my-form__button">Créer</button>
          </form>


            </div>
          </div>
        <script src="script_enseignant.js"></script>
        <script src="../script.js"></script>
         
        
          <div id="allStudentsContent">
              <!-- Contenu pour tous les étudiants -->
              <table class="students-table">
                <thead>
                    <tr style="font-family: sans-serif sans-serif; font-weight: bold; text-transform: uppercase;">
                        <th><U>N°</U></th>
                        <th>Profil</th>
                        <th>Matricul</th>
                        <th>Nom</th>
                        <th>Bureau</th>
                        <th>Discipline</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                 

                </tbody>
            </table>
          </div>
          
 
        
        
      
    </div>
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