<?php
/* Inclure le fichier config */
require_once "../../config/config.php";
 
/* Définir les variables */
$Nom_Categorie = "";
$name_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    /* Valider le nom */
    $input_Nom_Categorie = trim($_POST["Nom_Categorie"]);
    if(empty($input_Nom_Categorie)){
        $name_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_Nom_Categorie, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veillez entrez un nom valide.";
    } else{
        $Nom_Categorie = $input_Nom_Categorie;
    }
    
    /* Préparer une instruction d'insertion */
    $sql = "INSERT INTO categorie_materiel (Nom_Categorie) VALUES (?)";

    if($stmt = mysqli_prepare($link, $sql)){
        /* Lier les variables à la requête préparée */
        mysqli_stmt_bind_param($stmt, "s", $param_Nom_Categorie);

        /* Définir les paramètres */
        $param_Nom_Categorie = $Nom_Categorie;

        /* Exécuter la requête préparée */
        if(mysqli_stmt_execute($stmt)){
            /* Opération effectuée avec succès, rediriger */
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Une erreur est survenue.";
        }

        /* Fermer la requête préparée */
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsable</title>
    <link rel="stylesheet" href="../../ex_style/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="../../ex_style/js/bootstrap.min.js"></script>

    <style>
         
        
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
        <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="pull-left">Liste des categories</h2>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus"></i> Ajouter
                        </button>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaladd" onclick="window.print()">Imprimer</button>

                    </div>
                    <?php 
                    /* Inclure le fichier config */
                    require_once "../../config/config.php";
                    
                    /* select query execution */
                    $sql = "SELECT * FROM categorie_materiel";
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-hover table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nom Categorie</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['Nom_Categorie'] . "</td>";
                                         

                                        echo "<td>";
                                            echo '<a class="btn btn-pink text-secondary" href="read.php?id='. $row['id'] .'" >voir</i></a>';
                                            echo '<a class="btn btn-pink text-secondary" href="update.php?id='. $row['id'] .'" >modifié</i></a>';
                                            echo '<a class="btn btn-pink text-secondary" href="delete.php?id='. $row['id'] .'" >supprimé</a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            /* Free result set */
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
                        }
                    } else{
                        echo "Oops! Une erreur est survenue";
                    }
 
                    /* Fermer connection */
                    mysqli_close($link);
                    ?>
                </div>
            </div>   
             
         
        </div>
        <script src="script.js"></script>
    </div>


     <!-- Modaladd -->
     <div class="modal fade" id="modaladd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter une nouvelle categorie</h1>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         
                        <label for="nom">Nom Categorie :</label>
                        <input type="text" id="Nom_Categorie" name="Nom_Categorie" required <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Nom_Categorie; ?>">
                        <span class="invalid-feedback"><?php echo $name_err;?></span>

                        
                        <button type="button" onclick="submitForm()">Se connecter</button>
                        <input type="submit" class="btn btn-primary" value="Enregistrer" onclick="submitForm()" />
                        <a href="cathegori.php" class="btn btn-secondary ml-2">Annuler</a>
                        <p class="error-message" id="errorMessage"></p>
                    </form>
                </div>
                
            </div>
            </div>
        </div>
    </div>


      <!-- footer -->
      <?php require_once "../../components/footer.php";?>
    
    
   

</body>

</html>
