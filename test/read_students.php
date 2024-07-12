<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Liste des étudiants</h1>
    
    <!-- Formulaire de recherche -->
    <form method="GET" action="">
        <label for="search">Rechercher par classe:</label>
        <input type="text" id="search" name="search" placeholder="Nom de la classe">
        <input type="submit" value="Rechercher">
    </form>

    <h1><a href="index.php">create</a></h1>

    <?php
    $dsn = 'mysql:host=localhost;dbname=ecole';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Préparation de la requête SQL avec filtre de recherche
        $sql = "SELECT etudiant.id, etudiant.nom, classe.nom AS classe_nom, etudiant.classe_id, etudiant.image 
                FROM etudiant 
                JOIN classe ON etudiant.classe_id = classe.id";
        
        if (!empty($search)) {
            $sql .= " WHERE classe.nom LIKE :search";
        }

        $stmt = $pdo->prepare($sql);
        
        if (!empty($search)) {
            $stmt->bindValue(':search', '%' . $search . '%');
        }

        $stmt->execute();

        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Classe</th>
                    <th>Image</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nom"] . "</td>
                    <td>" . $row["classe_nom"] . "</td>
                    <td><img src='" . $row["image"] . "' alt='Image' width='100'></td>
                    <td><a href='update_student_form.php?id=" . $row['id'] . "&nom=" . $row['nom'] . "&classe_id=" . $row['classe_id'] . "&image=" . $row['image'] . "'>Update</a></td>
                    <td>
                        <form action='delete_student.php' method='post' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this student?\");'>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";

        // Requête pour obtenir le nombre d'élèves par classe
        $sql_count = "SELECT classe.nom AS classe_nom, COUNT(etudiant.id) AS nombre_etudiants
                      FROM etudiant
                      JOIN classe ON etudiant.classe_id = classe.id
                      GROUP BY classe.nom";
        $stmt_count = $pdo->query($sql_count);
        $classes = [];
        $nombre_etudiants = [];

        while ($row = $stmt_count->fetch(PDO::FETCH_ASSOC)) {
            $classes[] = $row['classe_nom'];
            $nombre_etudiants[] = $row['nombre_etudiants'];
        }

    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
    ?>

    <!-- Diagramme -->
    <h2>Nombre d'élèves par classe (Diagramme Circulaire)</h2>
    <canvas id="myChart" width="100px" height="100px"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie', // Type de diagramme circulaire
            data: {
                labels: <?php echo json_encode($classes); ?>,
                datasets: [{
                    label: 'Nombre d\'élèves',
                    data: <?php echo json_encode($nombre_etudiants); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
