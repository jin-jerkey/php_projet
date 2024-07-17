<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/index.php");
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
    <link rel="stylesheet" href="style_bilan_de_presence.css">
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
    <main>
        <h1>Contenu Bilan de presence</h1>
        <p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p>
        <p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p>
        <p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p>
        <p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p>
        <p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p>
        <p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p><p>Voici où le contenu principal sera affiché. Ajoutez du contenu supplémentaire pour tester le défilement.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac facilisis lorem. Sed vehicula nunc sed odio tristique, non sagittis libero tincidunt.</p>
        <p>Fusce venenatis libero a tincidunt malesuada. Suspendisse potenti. Donec euismod, lorem in consequat tincidunt, nunc mauris egestas nisl, in tincidunt felis mi sit amet justo.</p>
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