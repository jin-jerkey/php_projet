<?php
    /* Inclure le fichier config */
    require_once "../../config/config.php";


    //Declaration des variables
    $nombreMateriel=0;
    $nombreEmprunts=0;
    $nombreRetours=0;
     


    //Requete pour recuperer le nombre de materiel deja enregistrer
    $sql="SELECT COUNT(*)AS count FROM Materiel_Didactique";
    $result=$link->query($sql);
    if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $nombreMateriel=$row["count"];
    }
    //Requete pour recuperer le nombre de materiel deja enregistrer
    $sql="SELECT COUNT(*)AS count FROM assignation";
    $result=$link->query($sql);
    if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $nombreEmprunts=$row["count"];
    }
    //Requete pour recuperer le nombre de materiel deja enregistrer
    $sql="SELECT COUNT(*)AS count FROM retour";
    $result=$link->query($sql);
    if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $nombreRetours=$row["count"];
    }
     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../../ex_style/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .card {
            transition: transform 0.5s, border-radius 0.5s;
            border-radius: 10px; /* Coins arrondis */
            width: 500px; /* Largeur fixe */
            height: 150px; /* Hauteur fixe */
            overflow: hidden; /* Pour éviter tout débordement du contenu */
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            padding-top: 30px;
        }

        .card:hover {
            transform: rotateY(10deg);
            border-radius: 20px; /* Augmentation des coins arrondis lors du survol */
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.5); /* Ajout de l'effet d'ombre verte */
        }

        .card-body {
            transform-style: preserve-3d;
        }

        .card-title {
            colors: #e99dd2f5;
        }

        .poum {
            width : 800px;
            height: 600px;
        }

        
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php require_once "../../components/navbar.php";?>

    <!-- sidebar-->
    <?php require_once "../../components/siberbar.php";?>


    <!-- Page content -->
    <div class="content">
    <div class="container-fluid mb-9">
        <h1> BIENVENU SUR SECTION GSTION DU Matériel DIDACTIQUE </h1>
        <div class="row mb-9">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title">Matériel disponible</h4>
                             </div>
                            <div class="col-md-4">
                                <h2><?php echo $nombreMateriel; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title">assignation en cours</h4>
                                
                            </div>
                            <div class="col-md-4">
                                <h2><?php echo $nombreEmprunts; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title">materiel retourné</h4>
                                
                            </div>
                            <div class="col-md-4">
                                <h2><?php echo $nombreRetours; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="poum">
        <h1>Statistiques des Assignations par Enseignant</h1>
        <canvas id="myChart"></canvas>
    </div>
        </div>

        
    </div>

     
    

    
    <script src="script.js"></script>
</div>


      <!-- footer -->
      <?php require_once "../../components/footer.php";?>
    
    
   

</body>

</html>
