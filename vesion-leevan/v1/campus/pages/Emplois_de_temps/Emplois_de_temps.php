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
    <link rel="stylesheet" href="style_Emplois_de_temps.css">
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
    <script src="../script.js"></script>
    <script src="script_Emplois_de_temps.js"></script>

    <main>
      <article class="table-widget">
      <div class="caption">
        <button  style="margin-right: 5px;" class="add-attendance" > + Ajouter emplois de temps</button>
        <div class="filter">
          <label for="classe">Filiere</label>
          <select id="classe" required autocomplete="off">
              <option  value="">-- Sélectionner --</option>
              <option  value="GL">Genie Logiciel</option>
          </select>
      </div>
      <div class="filter">
          <label for="groupe">Niveau</label>
          <select id="groupe" required autocomplete="off">
            <option value="" class="input__field">-- Selectionner --</option>
            <option value="1" class="input__field">1</option>
            <option value="2" class="input__field">2 [ BTS / HND ]</option>
            <option value="3" class="input__field">3 [ LICENSE / BACHELOR ]</option>
            <option value="4" class="input__field">4 [ MASTER I ]</option>
            <option value="5" class="input__field">5 [ MASTER II ]</option>
          </select>
      </div>
        <button class="export-btn" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export" width="24"
            height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
            <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" />
          </svg>
          Export
        </button>
      </div>
      <br>
      <table>
        <thead>
          <tr>
            <th>
             [ JOURS / HEURES ]
            </th>
            <th>08H - 10H</th>
            <th>10H - 11H </th>
            <th>11H - 13H</th>
            <th>13H - 14H</th>
            <th>14H - 17H</th>
            <th>18H - 22H</th>
          </tr>
        </thead>
        <tbody id="team-member-rows">
          <!-- premiere ligne-->
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Lundi</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: rgb(230, 255, 255); color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Mardi</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: rgb(230, 255, 255); color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Mercredi</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: rgb(230, 255, 255); color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Jeudi</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: rgb(230, 255, 255); color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Vendredi</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: rgb(230, 255, 255); color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Samedi</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: rgb(230, 255, 255); color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
          <tr>
            <td class="team-member-profile" style="background:var(--th-background); ">Dimanche</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td style="background-color: azure; color: black;">PAUSE</td>
            <td>-</td>
            <td>-</td>
          </tr>
        </tbody>
      </table>
    </article>
      <!-- Ajoutez plus de contenu ici pour tester le défilement -->
    </main>
    <div class="notification">
      <div class="notification__body">
          <img
              src="../../assets/images/check-circle.svg"
              alt="Success"
              class="notification__icon"
          >
          Menu emplois de temps selectionne! &#128640; 
      </div>
      <div class="notification__progress"></div>
  </div>
</body>
</html>