<?php
/* Verifiez si le paramettre id existe */
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "../../config/config.php";
    
    /* Preparer la requete */
    $sql = "SELECT * FROM categorie_materiel WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* recuperer l'enregistrement */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                /* recuperer les champs */
                $nom = $row["Nom_Categorie"];
                
                
                
            } else{
                /* Si pas de id correct retourne la page d'erreur */
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! une erreur est survenue.";
        }
        mysqli_stmt_close($stmt); // <-- placer cette ligne ici
    }
    
    mysqli_close($link); // <-- déplacer cette ligne à l'extérieur du bloc "if($stmt = mysqli_prepare($link, $sql))"
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
                    <div class="form-group">
                        <label>Nom</label>
                        <p><b><?php echo $row["Nom_Categorie"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-success">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
