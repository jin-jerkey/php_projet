<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" href="./ex_style/css/bootstrap.min.css">

        <style>
            .sidebar {
                width: 10%;
                background-color: #ccc;
                height: 100vh;
                float: left;
                font-size: 14px;
                z-index: 1;
                background-color: #383c41;
                padding-top: 56px; /* Same height as navbar */
                overflow-x: hidden;
                transition: transform 0.5s, border-radius 0.5s;
                 
            }

            @media (max-width: 768px) {
                .sidebar {
                font-size: 12px;
                display: none;
                }
            }

            
            .sidebar ul {
                list-style: none;
                padding: 0;
                margin: 0;
                width: 100%;
            }

            @media (max-width: 768px) {
                .sidebar ul {
                width: 80%;
                }
            }
            
            .sidebar li {
                margin-bottom: 10px;
                padding: 10px 15px;
                background-color: #383c41;
                border-radius: 5px;
                width: auto;
                text-decoration: none;
                border-radius: 5px;
                text-align: center;
            }

            @media (max-width: 768px) {
                .sidebar li {
                /* Ajuster la marge en fonction de la réduction du sidebar */
                padding: 5px;
                }
            }
            
            .sidebar li a {
                color: #f3ecec;
                text-decoration: none;
                font-size: 20px;
                display: block;
                text-align: center;
                transition: transform 0.5s, border-radius 0.5s;
            }

            .sidebar li:hover {
                background-color: #94c093f5;
                transform: rotateY(10deg);
                border-radius: 20px; /* Augmentation des coins arrondis lors du survol */
                box-shadow: 0 0 10px;
            }
            
             

        </style>
    </head>

        <!-- Footer -->
        <aside class="sidebar">
            <ul>
            <li><a href="../accueil/index.php"><i class="fas fa-home"></i>Accueil</a></li>
            <li><a href="../assignation/index.php">Assignation</a></li>
            <li><a href="../retour/index.php">Retour</a></li>
            <li><a href="../materiel/index.php">Materiel</a></li>
            <li><a href="../categorie/index.php">Categorie</a></li>
            <li><a href="../responsable/index.php">Reponsable</a></li>
            <li><a href="../enseignant/index.php">Enseignant</a></li>
           
            </ul>
             
        </aside>

</html>