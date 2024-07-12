<?php
/* Inclure le fichier config */
require_once "../../config/config.php";
 
/* Definir les variables */
$date = $materiel = $quantite  = $enseignant = $etat = $commentaire = $responsable = "";
$date_err = $Materiel_err =  $Quantite_err = $enseignant_err =  $etat_err = $commentaire_err = $responsable_err  = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    /* Validation dr la date */
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Veuillez entrez votre addresse email.";     
    } else{
        $date = $input_date;
    } 

    /* Validation de l'heure */
    $input_materiel = trim($_POST["materiel"]);
    if(empty($input_Heur)){
        $Materiel_err = "Veuillez entrez votre numero de telephone.";     
    } else{
        $materiel = $input_materiel;
    }
    
   /* Validate de la classe */
    $input_quantite = trim($_POST["quantite"]);
    if(empty($input_quantite)){
        $Quantite_err = "Veuillez entrez une matière enseignée.";     
    } else {
        $quantite = $input_quantite;
    }
    
    /* Validate Emplacement */
    $input_enseignant = trim($_POST["enseignant"]);
    if(empty($input_enseignant)){
        $input_enseignant_err = "Veuillez entrez une ecole.";     
    } else{
        $enseignant = $input_enseignant;
    }

     
    /* Validate Enseignant */
    $input_etat = trim($_POST["etat"]);
    if(empty($input_etat)){
        $etat_err = "Veuillez entrez une categorie.";     
    } else{
        $etat= $input_etat;
    }

    /* Validate Quantite */
    $input_Quantitel = trim($_POST["Quantite"]);
    if(empty($input_Quantitel)){
        $Quantite_err = "Veuillez entrez une categorie.";     
    } else{
        $Quantite= $input_Quantitel;
    }

    /* Validate Etat_sorti */
    $input_commentaire = trim($_POST["commentaire"]);
    if(empty($input_commentaire)){
        $commentaire_err = "Veuillez entrez une categorie.";     
    } else{
        $commentaire= $input_commentaire;
    }

    /* Validate Etat_sorti */
    $input_responsable = trim($_POST["responsable"]);
    if(empty($input_responsable)){
        $responsable_err = "Veuillez entrez une categorie.";     
    } else{
        $responsable= $input_responsable;
    }

    
    
    
    /* Préparer l'instruction d'insertion du materiel*/
    $sql = "INSERT INTO retour (date, materiel, quantite, enseignant, etat, commentaire , responsable) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $sql)){
       /* Lier les variables à la requête préparée */
        mysqli_stmt_bind_param($stmt, "ssissis", $param_date, $param_materiel, $param_quantite, $param_enseignant, $param_etat, $param_commentaire, $param_responsable);

         /* Définir les paramètres */
        $param_date = $date;
        $param_materiel = $materiel;
        $param_quantite = $quantite;
        $param_enseignant = $enseignant;
        $param_etat = $etat;
        $param_commentaire = $commentaire;
        $param_responsable = $responsable;
         

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
    <title>retour</title>
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
                            <h2 class="pull-left">Liste des retours</h2>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus"></i> Ajouter</button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaladd" onclick="window.print()">Imprimer</button>
                        </div>
                        <?php 
                        /* Inclure le fichier config */
                        require_once "../../config/config.php";
                        
                        /* Exécuter la requête de sélection pour obtenir les matériels */                    
                        $sql = "SELECT * FROM retour";
                        
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-hover table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>date</th>";
                                            echo "<th>matricule</th>";
                                            echo "<th>quantite</th>";
                                            echo "<th>enseignant</th>";
                                            echo "<th>etat</th>";
                                            echo "<th>commentaire</th>";
                                            echo "<th>responsable</th>";
                                            
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>" . $row['materiel'] . "</td>";
                                            echo "<td>" . $row['quantite'] . "</td>";
                                            echo "<td>" . $row['enseignant'] . "</td>";
                                            echo "<td>" . $row['etat'] . "</td>";
                                            echo "<td>" . $row['commentaire'] . "</td>";
                                            echo "<td>" . $row['responsable'] . "</td>";
                                             

                                            echo "<td>";
                                                echo '<a class="btn btn-pink text-secondary" href="read.php?id='. $row['id'] .'">Voir</a>';
                                                
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un retour</h1>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         
                        <label for="date">Date :</label>
                        <input type="Date" id="date" name="date" required <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?> value="<?php echo $date; ?>">
                        <span class="invalid-feedback"><?php echo $date_err;?></span>

                        <label for="materiel">Materiel :</label>
                        <select id="materiel" name="materiel" required <?php echo (!empty($materiel_err)) ? 'is-invalid' : ''; ?> value="<?php echo $materiel; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un Materiel</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="regle">regle</option>
                            <option value="ardoise">ardoise</option>
                            <option value="aiqué">aiqué</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $materiel_err;?></span>

                        <label for="quantite">Quantite :</label>
                        <input type="number" id="quantite" name="quantite" required <?php echo (!empty($quantite_err)) ? 'is-invalid' : ''; ?> value="<?php echo $quantite; ?>">
                        <span class="invalid-feedback"><?php echo $quantite_err;?></span>

                        <label for="enseignant">Enseignant :</label>
                        <select id="enseignant" name="enseignant" required <?php echo (!empty($enseignant_err)) ? 'is-invalid' : ''; ?> value="<?php echo $enseignant; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un Enseignant</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="paul">paul</option>
                            <option value="steve">steve</option>
                            <option value="papou">papou</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $enseignant_err;?></span>
                        

                        <label for="etat">Etat :</label>
                        <select id="etat" name="etat" required <?php echo (!empty($etat_err)) ? 'is-invalid' : ''; ?> value="<?php echo $etat; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un Etat</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="abimé">abimé</option>
                            <option value="peut abimé">peu abimé</option>
                            <option value="non abime">non abime</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $etat_err;?></span>

                        <label for="commentaire">Commentaire :</label>
                        <input type="textarea" id="commentaire" name="commentaire" required <?php echo (!empty($commentaire_err)) ? 'is-invalid' : ''; ?> value="<?php echo $commentaire; ?>">
                        <span class="invalid-feedback"><?php echo $commentaire_err;?></span>


                         
                        <label for="responsable">Reponsable :</label>
                        <select id="responsable" name="responsable" required <?php echo (!empty($responsable_err)) ? 'is-invalid' : ''; ?> value="<?php echo $responsable; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un statut</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="disponible">Disponible</option>
                            <option value="en_prêt">En Prêt</option>
                            <option value="en_réparation">En Réparation</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $etat_retour_err;?></span>

                         <!-- <button type="button" onclick="submitForm()">Se connecter</button> -->
                        <input type="submit" class="btn btn-primary" value="Enregistrer" onclick="submitForm()" />

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
