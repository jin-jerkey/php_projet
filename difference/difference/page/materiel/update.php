<?php
/* Inclure le fichier */
require_once "../../config/config.php";
 
/* Definir les variables */
$Nom_Materiel = $Description = $Quantite_Disponible = $Statut = $Emplacement = $ID_Categorie  = "";
$name_err = $Description_err = $Quantite_Disponible_err = $Statut_err =  $Emplacement_err = $ID_Categorie_err = "";
 
/* verifier la valeur id dans le post pour la mise à jour */
if(isset($_POST["id"]) && !empty($_POST["id"])){
    /* recuperation du champ caché */
    $id = $_POST["id"];
    
    /* Validate name */
    $input_name = trim($_POST["Nom_Materiel"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrez le nom du materiel.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrez un nom valide.";
    } else{
        $Nom_Materiel = $input_name;
    }


    $input_Description = trim($_POST["Description"]);
    if(empty($input_Description)){
        $Description_err = "Veuillez entrez la nouvelle descripttion de ce materiel.";     
    } else{
        $Description = $input_Description;
    }
    /*validation de la quantite disponible*/
    $input_Quantite_Disponible = trim($_POST["Quantite_Disponible"]);
    if(empty($input_Quantite_Disponible)){
        $Quantite_Disponible_err = "Veuillez entrez la nouvelle quantite disponible.";     
    } else{
        $Quantite_Disponible = $input_Quantite_Disponible;
    }
    
    /* Validate du statut*/
    $input_Statut = trim($_POST["Statut"]);
    if(empty($input_Statut)){
        $Statut_err = "Veuillez entrez un nouveau statut.";     
    } else {
        $Statut = $input_Statut;
    }
    
    /* Validate emplacement */
    $input_Emplacement = trim($_POST["Emplacement"]);
    if(empty($input_Emplacement)){
        $Emplacement_err = "Veuillez entrez un nouveau emplacement.";     
    } else{
        $Emplacement = $input_Emplacement;
    }
    
    
    
    /* verifier les erreurs avant modification */
    if(empty($name_err) && empty($password_err)){
        
        $sql = "UPDATE  Materiel_Didactique SET Nom_Materiel=?, Description=?, Quantite_Disponible=?,  Statut=?, Emplacement=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssssi", $param_Nom_Materiel, $param_Description, $param_Quantite_Disponible, $param_Statut, $param_Emplacement, $param_id);
            
           
            $param_Nom_Materiel = $Nom_Materiel;
            $param_Description = $Description;
            $param_Quantite_Disponible = $Quantite_Disponible;
            $param_Statut = $Statut;
            $param_Emplacement = $Emplacement;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                /* enregistremnt modifié, retourne */
                header("location: materiel.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    /* si il existe un parametre id */
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
       
        $sql = "SELECT * FROM Materiel_Didactique WHERE id = ?";


        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    /* recupere les champs */
                    $Nom_Materiel = $row["Nom_Materiel"];
                    $Description = $row["Description"];
                    $Quantite_Disponible = $row["Quantite_Disponible"];
                    $Statut = $row["Statut"];
                    $Emplacement = $row["Emplacement"];
                } else{
                    
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
        
        /* Close statement */
        mysqli_stmt_close($stmt);
        
        /* Close connection */
        mysqli_close($link);
    }  else{
        /* pas de id parametter valid, retourne erreur */
        header("location: error.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'enregistremnt</title>
     
    <link rel="stylesheet" href="../../ex_style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="../../ex_style/js/bootstrap.min.js"></script>

    <style>
        .wrapper{
            width: 1000px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de l'enregistremnt</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nom_Materiel</label>
                            <input type="text" name="Nom_Materiel" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Nom_Materiel; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="Description" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Description; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantite_Disponible</label>
                            <input type="text" name="Quantite_Disponible" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Quantite_Disponible; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Statut</label>
                            <input type="text" name="Statut" class="form-control <?php echo (!empty($Statut_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Statut; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Emplacement</label>
                            <input type="text" name="Emplacement" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Emplacement; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                         
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>