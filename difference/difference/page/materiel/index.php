<?php
/* Inclure le fichier config */
require_once "../../config/config.php";
 
/* Definir les variables */
$Nom_Materiel = $Description = $Quantite_Disponible = $Statut = $Emplacement = $ID_Categorie  = "";
$name_err = $Description_err = $Quantite_Disponible_err = $Statut_err =  $Emplacement_err = $ID_Categorie_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    /* Validation du nom du materiel */
    $input_name = trim($_POST["Nom_Materiel"]);
    if(empty($input_name)){
        $name_err = "Veuillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veuillez entrez un nom valide.";
    } else{
        $Nom_Materiel = $input_name;
    }
    
    /* Validation de la Description du materiel */
    $input_Description = trim($_POST["Description"]);
    if(empty($input_Description)){
        $Description_err = "Veuillez entrez votre addresse email.";     
    } else{
        $Description = $input_Description;
    } 

    /* Validation du Quantite_Disponible */
    $input_Quantite_Disponible = trim($_POST["Quantite_Disponible"]);
    if(empty($input_Quantite_Disponible)){
        $Quantite_Disponible_err = "Veuillez entrez votre numero de telephone.";     
    } else{
        $Quantite_Disponible = $input_Quantite_Disponible;
    }
    
   /* Validate Statut */
    $input_Statut = trim($_POST["Statut"]);
    if(empty($input_Statut)){
        $Statut_err = "Veuillez entrez une matière enseignée.";     
    } else {
        $Statut = $input_Statut;
    }
    
    /* Validate Emplacement */
    $input_Emplacement = trim($_POST["Emplacement"]);
    if(empty($input_Emplacement)){
        $Emplacement_err = "Veuillez entrez une ecole.";     
    } else{
        $Emplacement = $input_Emplacement;
    }

     

    /* Validate ID_Categorie */
    $input_ID_Categorie = trim($_POST["ID_Categorie"]);
    if(empty($input_ID_Categorie)){
        $ID_Categorie_err = "Veuillez entrez une categorie.";     
    } else{
        $ID_Categorie= $input_ID_Categorie;
    }
    
    
    /* Préparer l'instruction d'insertion du materiel*/
    $sql = "INSERT INTO Materiel_Didactique (Nom_Materiel, Description, Quantite_Disponible, Statut, Emplacement, ID_Categorie) VALUES (?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
       /* Lier les variables à la requête préparée */
        mysqli_stmt_bind_param($stmt, "ssissi", $param_Nom_Materiel, $param_Description, $param_Quantite_Disponible, $param_Statut, $param_Emplacement, $param_ID_Categorie);

         /* Définir les paramètres */
        $param_Nom_Materiel = $Nom_Materiel;
        $param_Description = $Description;
        $param_Quantite_Disponible = $Quantite_Disponible;
        $param_Statut = $Statut;
        $param_Emplacement = $Emplacement;
        $param_ID_Categorie = $ID_Categorie;

        /* Exécuter la requête */
        if(mysqli_stmt_execute($stmt)){
            /* Opération effectuée, redirection */
             header("location: index.php");
            exit();
        } else{
            echo "Oops! une erreur est survenue.";
        }
    }
         
        /* Fermer la requête */
        mysqli_stmt_close($stmt);
    }
     
    

    // Poursuivre le code ici pour afficher le reste de la page et le formulaire

    
     
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiel</title>
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
                        <div class="mt-4 mb-3 d-flex justify-content-between">
                            <h2 class="pull-left">Liste des Materiels</h2>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus"></i> Ajouter</button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaladd" onclick="window.print()">Imprimer</button>
                        </div>
                        <?php 
                        /* Inclure le fichier config */
                        require_once "../../config/config.php";
                        
                        /* Exécuter la requête de sélection pour obtenir les matériels */                    $sql = "SELECT * FROM materiel_didactique";
                        
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-hover table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Nom_Materiel</th>";
                                            echo "<th>Description</th>";
                                            echo "<th>Quantite_Disponible</th>";
                                            echo "<th>Statut</th>";
                                            echo "<th>Emplacement</th>";
                                            echo "<th>ID_Categorie</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['Nom_Materiel'] . "</td>";
                                            echo "<td>" . $row['Description'] . "</td>";
                                            echo "<td>" . $row['Quantite_Disponible'] . "</td>";
                                            echo "<td>" . $row['Statut'] . "</td>";
                                            echo "<td>" . $row['Emplacement'] . "</td>";
                                            echo "<td>" . $row['ID_Categorie'] . "</td>";

                                            echo "<td>";
                                                echo '<a class="btn btn-pink text-secondary" href="read.php?id='. $row['id'] .'">Voir</a>';
                                                echo '<a class="btn btn-pink text-secondary" href="update.php?id='. $row['id'] .'">Modifié</i></a>';
                                                echo '<a class="btn btn-pink text-secondary" href="delete.php?id='. $row['id'] .'" >Supprimer</a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                /* Libérer le jeu de résultats */
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
                            }
                        } else{
                            echo "Oops! Une erreur est survenue";
                        }
    
                        ?>
                    </div>
            </div>
        </div>

    
        <script src="script.js"></script>

        <div class="modal fade" id="modaladd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un Materiel</h1>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         
                        <label for="Nom_Materiel">Nom Du Materiel :</label>
                        <input type="text" id="Nom_Materiel" name="Nom_Materiel" required <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Nom_Materiel; ?>">
                        <span class="invalid-feedback"><?php echo $name_err;?></span>

                        <label for="Description">Description :</label>
                        <input type="text" id="Description" name="Description" required <?php echo (!empty($Description_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Description; ?>">
                        <span class="invalid-feedback"><?php echo $Description_err;?></span>

                        <label for="Quantite_Disponible">Quantite Disponible :</label>
                        <input type="number" id="Quantite_Disponible" name="Quantite_Disponible" required <?php echo (!empty($Quantite_Disponible_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Quantite_Disponible; ?>">
                        <span class="invalid-feedback"><?php echo $Quantite_Disponible_err;?></span>

                        <label for="Statut">Statut :</label>
                        <select id="Statut" name="Statut" required <?php echo (!empty($Statut_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Statut; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un statut</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="disponible">Disponible</option>
                            <option value="en_prêt">En Prêt</option>
                            <option value="en_réparation">En Réparation</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $Statut_err;?></span>

                        <label for="Emplacement">Emplacement :</label>
                        <input type="text" id="Emplacement" name="Emplacement" required <?php echo (!empty($Emplacement_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Emplacement; ?>">
                        <span class="invalid-feedback"><?php echo $Emplacement_err;?></span>

                        

                        <label for="ID_Categorie">Choisissez une catégorie : </label>
                        <select name="ID_Categorie" id="ID_Categorie" required <?php echo (!empty($ID_Categorie_err)) ? 'is-invalid' : ''; ?> value="<?php echo $ID_Categorie; ?>">
                            <option value="disponible">Disponible</option>
                            <?php
                            $sql = "SELECT * FROM categorie_materiel";
                            $result = mysqli_query($link, $sql);

                            if (!$result) {
                                die("Erreur lors de la récupération des données : " . mysqli_error($link));
                            }

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"{$row['Nom_Categorie']}\">{$row['Nom_Categorie']}</option>";
                            }
                            ?>
                        </select>
                        <span class="invalid-feedback"><?php echo $ID_Categorie_err;?></span>

                         
                        <br>
                        <!-- <button type="button" onclick="submitForm()">Se connecter</button> -->
                        <input type="submit" class="btn btn-success" value="Enregistrer" onclick="submitForm()" />
                        <a href="materiel.php" class="btn btn-secondary ml-2">Annuler</a>
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
