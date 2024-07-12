<?php
/* Verifiez si le paramettre id existe */
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "../../config/config.php";
    
    /* Preparer la requete */
    $sql = "SELECT * FROM assignation WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* recuperer l'enregistrement */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                /* recuperer les champs */
                $nom = $row["date"];
                $nom = $row["heure"];
                $nom = $row["classe"];
                $nom = $row["enseignant"];
                $nom = $row["materiel"];
                $nom = $row["quantite"];
                $nom = $row["etat_sorti"];
                $nom = $row["responsable"];
                $nom = $row["statut"];
                $nom = $row["etat_retour"];
                
                
            } else{
                /* Si pas de id correct retourne la page d'erreur */
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    /* Si pas de id correct retourne la page d'erreur */
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voir l'enregistrement</title>
    <link rel="stylesheet" href="../ex_style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .wrapper{
            width: 1000px;
            margin: 0 auto;
        }

        p {
            color: #fff;
            background-color: rgb(204, 121, 135);
            height: 70px;
            width: auto;
            text-align: center;
            font-size: 30px
        }

        .row {
            border-radius: solid 15px 0;
        }
    </style>
</head>
<body>
<div class="wrapper">
        <div class="container-fluid">
             
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Voir l'enregistremnt</h1>
                    <h1 class="mt-5 mb-3">Matricule : <?php echo $row["matricule"]; ?></h1>
                    <div class="form-group">
                        <label>date</label>
                        <p><b><?php echo $row["date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>heure</label>
                        <p><b><?php echo $row["heure"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>classe</label>
                        <p><b><?php echo $row["classe"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>enseignant</label>
                        <p><b><?php echo $row["enseignant"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>materiel</label>
                        <p><b><?php echo $row["materiel"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>quantite</label>
                        <p><b><?php echo $row["quantite"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>etat_sorti</label>
                        <p><b><?php echo $row["etat_sorti"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>responsable</label>
                        <p><b><?php echo $row["responsable"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>statut</label>
                        <p><b><?php echo $row["statut"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>etat_retour</label>
                        <p><b><?php echo $row["etat_retour"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-success">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>