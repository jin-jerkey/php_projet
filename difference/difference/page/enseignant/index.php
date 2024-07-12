<?php
/* Inclure le fichier config */
require_once "../../config/config.php";
 
/* Definir les variables */
$nom = $email = $telephone = $adresse = $classes_Assignees ="";
$name_err = $email_err = $telephone_err = $adresse_err =  $classes_Assignees_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    /* Validate name */
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrez un nom valide.";
    } else{
        $nom = $input_name;
    }
    
    /* Validate email */
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Veillez entrez votre address email.";     
    } else{
        $email = $input_email;
    }

    /* Validate telephone */
    $input_telephone = trim($_POST["telephone"]);
    if(empty($input_telephone)){
        $telephone_err = "Veillez entrez votre numero de telephone.";     
    } else{
        $telephone = $input_telephone;
    }
    
   /* Validate de l'adresse */
    $input_adresse = trim($_POST["adresse"]);
    if(empty($input_adresse)){
        $adresse_err = "Veuillez votre adresse.";     
    } else {
        $adresse_err = $input_adresse;
    }
    
    /* Validate classes_Assignees */
    $input_classes_Assignees = trim($_POST["classes_Assignees"]);
    if(empty($input_classes_Assignees)){
        $classes_Assignees_err = "Veillez entrez une ecole.";     
    } else{
        $classes_Assignees = $input_classes_Assignees;
    }
    
    
    /* Preparer et inserer la declaration */
    $sql = "INSERT INTO enseignant (nom, email, telephone, adresse, classes_Assignees) VALUES (?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
        /* Bind les variables à la requette preparée */
        mysqli_stmt_bind_param($stmt, "sssss", $param_nom, $param_email, $param_telephone, $param_adresse, $param_classes_Assignees);

        /* modifier les parametres */
        $param_nom = $nom;
        $param_email = $email;
        $param_telephone = $telephone;
        $param_adresse= $adresse;
        $param_classes_Assignees = $classes_Assignees;

        /* executer la requette */
        if(mysqli_stmt_execute($stmt)){
            /* opération effectuée, retour */
            header("location: index.php");
            exit();
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
         
        /* Close statement */
        mysqli_stmt_close($stmt);
    }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignant</title>
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
                        <h2 class="pull-left">Liste des Enseignants</h2>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus"></i> Ajouter</button>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaladd" onclick="window.print()">Imprimer</button>

                    </div>
                    <?php 
                    /* Inclure le fichier config */
                    require_once "../../config/config.php";
                    
                    /* select query execution */
                    $sql = "SELECT * FROM enseignant";
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-hover table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>telephone</th>";
                                         
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['telephone'] . "</td>";
 
                                        echo "<td>";
                                            echo '<a class="btn btn-pink text-secondary" href="read.php?id='. $row['id'] .'" >Voir</a>';
                                            echo '<a class="btn btn-pink text-secondary" href="update.php?id='. $row['id'] .'" >Modifié</i></a>';
                                            echo '<a class="btn btn-pink text-secondary" href="delete.php?id='. $row['id'] .'" >Supprimé</a>';
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un nouveau Enseignant</h1>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>    
            </div>
                <div class="modal-body">
                    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         
                        <label for="nom">NOM :</label>
                        <input type="text" id="nam" name="nom" required <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                        <span class="invalid-feedback"><?php echo $name_err;?></span>

                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err;?></span>

                        <label for="telephone">Telephone :</label>
                        <input type="tel" id="telephone" name="telephone" required <?php echo (!empty($telephone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telephone; ?>">
                        <span class="invalid-feedback"><?php echo $telephone_err;?></span>

                        <label for="matieres_Enseignees">Adresse :</label>
                        <input type="text" id="adresse" name="text" required <?php echo (!empty($adresse_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adresse; ?>">
                        <span class="invalid-feedback"><?php echo $adresse_err;?></span>
                    
                        <label for="classes_Assignees">classe :</label>
                        <input type="text" id="classes_Assignees" name="classes_Assignees" required <?php echo (!empty($classes_Assignees_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $classes_Assignees; ?>">
                        <span class="invalid-feedback"><?php echo $classes_Assignees_err;?></span>
                        <br>
                        <!-- <button type="button" onclick="submitForm()">Se connecter</button> -->
                        <input type="submit" class="btn btn-primary" value="Enregistrer" onclick="submitForm()" />
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                        <p class="error-message" id="errorMessage"></p>
                    </form>
                </div>
                
            </div>
            </div>
        </div>


      <!-- footer -->
      <?php require_once "../../components/footer.php";?>
    
    
   

</body>

</html>
