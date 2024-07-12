<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="stylesheet" href="./ex_style/css/bootstrap.min.css">

        <style>
            .navbare, .sidebar, .contenu-principal {
                display: flex;
            }
            
            .navbare {
                background-color: #000;
                color: #fff;
                 
            }

            .navbare h1 {
                margin: 0;
                padding: 10px;
                font-size: 20px;
            }

            .bouton-deconnexion {
                margin-left: auto;
                padding: 10px;
                background-color: #ccc;
                border: none;
                cursor: pointer;
            }
            
            .bouton-deconnexion:hover {
                background-color: #ddd;
            }
  

        </style>
    </head>

        <!-- Footer -->
    <header class="navbare">
        <h1>LA DIFFERENCE</h1>
        <button class="bouton-deconnexion"><a href="../../index.php">Deconnexion</a></button>
    </header>

</html>