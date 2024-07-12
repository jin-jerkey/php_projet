<?php
/* Inclure le fichier config */
require_once "../../config/config.php";
 
/* Definir les variables */
$Date = $Heur = $Classe = $Enseignant = $Materiel = $Quantite = $Etat_sorti = $responsable = $statut = $etat_retour  = "";
$Date_err = $Heur_err = $Classe_err = $Enseignant_err = $Materiel_err =  $Quantite_err =  $Etat_sorti_err = $responsable_err = $statut_err = $etat_retour_err = "";
 
$matricule = $Enseignant . "-" . $Date;
$matricule_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    /* Validation dr la date */
    $input_Date = trim($_POST["Date"]);
    if(empty($input_Date)){
        $Date_err = "Veuillez entrez votre addresse email.";     
    } else{
        $Date = $input_Date;
    } 

    /* Validation de l'heure */
    $input_Heur = trim($_POST["Heur"]);
    if(empty($input_Heur)){
        $Heur_err = "Veuillez entrez votre numero de telephone.";     
    } else{
        $Heur = $input_Heur;
    }
    
   /* Validate de la classe */
    $input_Classe = trim($_POST["Classe"]);
    if(empty($input_Classe)){
        $Classe_err = "Veuillez entrez une matière enseignée.";     
    } else {
        $Classe = $input_Classe;
    }
    
    /* Validate Emplacement */
    $input_Enseignant = trim($_POST["Enseignant"]);
    if(empty($input_Enseignant)){
        $Enseignant_err = "Veuillez entrez une ecole.";     
    } else{
        $Enseignant = $input_Enseignant;
    }

     
    /* Validate Enseignant */
    $input_Materiel = trim($_POST["Materiel"]);
    if(empty($input_Materiel)){
        $Materiel_err = "Veuillez entrez une categorie.";     
    } else{
        $Materiel= $input_Materiel;
    }

    /* Validate Quantite */
    $input_Quantitel = trim($_POST["Quantite"]);
    if(empty($input_Quantitel)){
        $Quantite_err = "Veuillez entrez une categorie.";     
    } else{
        $Quantite= $input_Quantitel;
    }

    /* Validate Etat_sorti */
    $input_Etat_sorti = trim($_POST["Etat_sorti"]);
    if(empty($input_Etat_sorti)){
        $Etat_sorti_err = "Veuillez entrez une categorie.";     
    } else{
        $Etat_sorti= $input_Etat_sorti;
    }

    /* Validate Etat_sorti */
    $input_responsable = trim($_POST["responsable"]);
    if(empty($input_responsable)){
        $responsable_err = "Veuillez entrez une categorie.";     
    } else{
        $responsable= $input_responsable;
    }

    /* Validate Etat_sorti */
    $input_statut = trim($_POST["statut"]);
    if(empty($input_statut)){
        $statut_err = "Veuillez entrez une categorie.";     
    } else{
        $statut= $input_statut;
    }

    /* Validate Etat_sorti */
    $input_etat_retour = trim($_POST["etat_retour"]);
    if(empty($input_etat_retour)){
        $etat_retour_err = "Veuillez entrez une categorie.";     
    } else{
        $etat_retour= $input_etat_retour;
    }

     
    
    
    /* Préparer l'instruction d'insertion du materiel*/
    $sql = "INSERT INTO assignation (date,matricule, heure, classe, enseignant, materiel, quantite , etat_sorti , responsable , statut , etat_retour) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

    if($stmt = mysqli_prepare($link, $sql)){
       /* Lier les variables à la requête préparée */
        mysqli_stmt_bind_param($stmt, "ssissississ",$param_matricule, $param_date, $param_heure, $param_classe, $param_enseignant, $param_materiel, $param_quantite, $param_etat_sorti, $param_responsable, $param_statut, $param_etat_retour);

         /* Définir les paramètres */
        $param_matricule = $matricule;
        $param_date = $Date;
        $param_heure = $Heur;
        $param_classe = $Classe;
        $param_enseignant = $Enseignant;
        $param_materiel = $Materiel;
        $param_quantite = $Quantite;
        $param_etat_sorti = $Etat_sorti;
        $param_responsable = $responsable;
        $param_statut = $statut;
        $param_etat_retour = $etat_retour;

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
                            <h2 class="pull-left">Liste des assignations</h2>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaladd"><i class="fa fa-plus"></i> Ajouter</button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaladd" onclick="window.print()">Imprimer</button>
                        </div>
                        <?php 
                        /* Inclure le fichier config */
                        require_once "../../config/config.php";
                        
                        /* Exécuter la requête de sélection pour obtenir les matériels */                    
                        $sql = "SELECT * FROM assignation";
                        
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-hover table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Date</th>";
                                            echo "<th>Heure</th>";
                                            echo "<th>Classe</th>";
                                            echo "<th>Enseignant</th>";
                                            echo "<th>Materiel</th>";
                                            echo "<th>Quantite</th>";
                                            echo "<th>Etat_sorti</th>";
                                            echo "<th>Responsable</th>";
                                            echo "<th>Statut</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['date'] . "</td>";
                                            echo "<td>" . $row['heure'] . "</td>";
                                            echo "<td>" . $row['classe'] . "</td>";
                                            echo "<td>" . $row['enseignant'] . "</td>";
                                            echo "<td>" . $row['materiel'] . "</td>";
                                            echo "<td>" . $row['quantite'] . "</td>";
                                            echo "<td>" . $row['etat_sorti'] . "</td>";
                                            echo "<td>" . $row['responsable'] . "</td>";
                                            echo "<td>" . $row['statut'] . "</td>";

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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un Materiel</h1>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         
                        <label for="Date">Date :</label>
                        <input type="Date" id="Date" name="Date" required <?php echo (!empty($Date_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Date; ?>">
                        <span class="invalid-feedback"><?php echo $Date_err;?></span>

                        <label for="Heure">Heure :</label>
                        <input type="time" id="Heur" name="Heur" required <?php echo (!empty($Heur_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Heur; ?>">
                        <span class="invalid-feedback"><?php echo $Heur_err;?></span>

                        <label for="Classe">Classe :</label>
                        <select id="Classe" name="Classe" required <?php echo (!empty($Classe_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Classe; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir une classe</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="prepa1">PREPA1</option>
                            <option value="gl1">GL1</option>
                            <option value="glt1">GLT1</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $Classe_err;?></span>

                        <label for="Enseignant">Enseignant :</label>
                        <select id="Enseignant" name="Enseignant" required <?php echo (!empty($Enseignant_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Enseignant; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un Enseignant</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="paul">paul</option>
                            <option value="steve">steve</option>
                            <option value="papou">papou</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $Enseignant_err;?></span>

                        <label for="Materiel">Materiel :</label>
                        <select id="Materiel" name="Materiel" required <?php echo (!empty($Materiel_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Materiel; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un Materiel</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="regle">regle</option>
                            <option value="ardoise">ardoise</option>
                            <option value="aiqué">aiqué</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $Materiel_err;?></span>

                        <label for="Quantite">Quantite :</label>
                        <input type="number" id="Quantite" name="Quantite" required <?php echo (!empty($Quantite_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Quantite; ?>">
                        <span class="invalid-feedback"><?php echo $Quantite_err;?></span>

                        <label for="Etat_sorti">Etat sorti :</label>
                        <select id="Etat_sorti" name="Etat_sorti" required <?php echo (!empty($Etat_sorti_err)) ? 'is-invalid' : ''; ?> value="<?php echo $Etat_sorti; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un Etat</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="abimé">abimé</option>
                            <option value="peut abimé">peu abimé</option>
                            <option value="non abime">non abime</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $Etat_sorti_err;?></span>

                        <label for="responsable">responsable :</label>
                        <select id="responsable" name="responsable" required <?php echo (!empty($responsable_err)) ? 'is-invalid' : ''; ?> value="<?php echo $responsable; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                             
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="wesline">Wesline</option>
                            <option value="steve">steve</option>
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $responsable_err;?></span>

                        <label for="Statut">Statut :</label>
                        <select id="Statut" name="statut" required <?php echo (!empty($statut_err)) ? 'is-invalid' : ''; ?> value="<?php echo $statut; ?>">
                            <!-- Option vide pour laisser le choix à l'utilisateur -->
                            <option value="" selected>Choisir un statut</option>
                            <!-- Remplacer les valeurs et les libellés par vos données réelles -->
                            <option value="remis">Remis</option>
                            <option value="encour">Encour</option>
                             
                            <!-- ... -->
                        </select>
                        <span class="invalid-feedback"><?php echo $statut_err;?></span>

                        <label for="etat_retour">etat retour :</label>
                        <select id="etat_retour" name="etat_retour" required <?php echo (!empty($etat_retour_err)) ? 'is-invalid' : ''; ?> value="<?php echo $etat_retour; ?>">
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
