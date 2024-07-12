<?php
/* Inclure le fichier de configuration */
require_once "../../config/config.php";
 
/* Définir les variables */
$Nom_Categorie = "";
$name_err = "";

/* Vérifier la valeur de l'ID dans le POST pour la mise à jour */
if(isset($_POST["id"]) && !empty($_POST["id"])){
    /* Récupération du champ caché */
    $id = $_POST["id"];
    
    /* Valider le nom */
    $input_Nom_Categorie = trim($_POST["Nom_Categorie"]);
    if(empty($input_Nom_Categorie)){
        $name_err = "Veuillez entrer un nom.";
    } elseif(!filter_var($input_Nom_Categorie, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrer un nom valide.";
    } else{
        $Nom_Categorie = $input_Nom_Categorie;
    }
    
    /* Vérifier les erreurs avant la modification */
    if(empty($name_err)){
        
        $sql = "UPDATE categorie_materiel SET Nom_Categorie=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "si", $param_Nom_Categorie ,$param_id);
            
            /* Définir les paramètres */
            $param_Nom_Categorie = $Nom_Categorie;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                /* Enregistrement modifié, redirection */
                header("location: cathegori.php");
                exit();
            } else{
                echo "Oops! Une erreur est survenue.";
            }
        }
         
        /* Fermer la requête */
        mysqli_stmt_close($stmt);
    }
    
    /* Fermer la connexion */
    mysqli_close($link);
} else{
    /* S'il existe un paramètre ID */
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        /* Sélectionner l'enregistrement correspondant à l'ID */
        $sql = "SELECT * FROM categorie_materiel WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            /* Définir le paramètre */
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Récupérer l'enregistrement */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    /* Récupérer les champs */
                    $Nom_Categorie = $row["Nom_Categorie"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "Oops! Une erreur est survenue.";
            }
        }
        
        /* Fermer la requête */
        mysqli_stmt_close($stmt);
        
        /* Fermer la connexion */
        mysqli_close($link);
    }  else{
        /* Pas d'ID paramètre valide, redirection vers une erreur */
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
                    <h2 class="mt-5">Mise à jour de l'enregistrement</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nom Catégorie</label>
                            <input type="text" name="Nom_Categorie" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Nom_Categorie; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                         
                        <!-- Champ caché pour l'ID -->
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