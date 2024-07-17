<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<?php
// save_qr_data.php

// Vérifier que la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer le corps de la requête JSON
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Vérifier que les données JSON sont valides
    if ($data === null) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
        exit;
    }

    // Récupérer les informations du QR code
    $matricule = $data['matricule'] ?? '';
    $nom = $data['nom'] ?? '';
    $filiere = $data['filiere'] ?? '';
    $niveau = $data['niveau'] ?? '';

    // Valeurs par défaut pour d'autres champs
    $date = date('Y-m-d');
    $heure = date('H:i:s');
    $periode = 1; // Exemple de période par défaut
    $matiere = 'Mathématiques'; // Exemple de matière par défaut
    $professeur = 'John Doe'; // Exemple de professeur par défaut
    $etat = 1; // État présent par défaut

    // Vérifier que toutes les données nécessaires sont présentes
    $missing_fields = [];
    if (empty($matricule)) {
        $missing_fields[] = 'matricule';
    }
    if (empty($nom)) {
        $missing_fields[] = 'nom';
    }
    if (empty($filiere)) {
        $missing_fields[] = 'filiere';
    }
    if (empty($niveau)) {
        $missing_fields[] = 'niveau';
    }

    if (!empty($missing_fields)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required data: ' . implode(', ', $missing_fields)]);
        exit;
    }

    // Insérer les données dans la base de données
    $dsn = 'mysql:host=localhost;dbname=campus_school';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si l'étudiant existe
        $sql_check = "SELECT COUNT(*) FROM etudiant WHERE matricule = :matricule AND filiere = :filiere AND niveau = :niveau";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->bindParam(':matricule', $matricule);
        $stmt_check->bindParam(':filiere', $filiere);
        $stmt_check->bindParam(':niveau', $niveau);
        $stmt_check->execute();
        $student_exists = $stmt_check->fetchColumn();

        if ($student_exists) {
            // L'étudiant existe, insérer dans appel
            $sql_insert = "INSERT INTO appel (matricul, date, heure, periode, filiere, niveau, matiere, professeur, m_eleve, nom_eleve, etat)
                            VALUES (:matricule, :date, :heure, :periode, :filiere, :niveau, :matiere, :professeur, :m_eleve, :nom_eleve, :etat)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->bindParam(':matricule', $matricule);
            $stmt_insert->bindParam(':date', $date);
            $stmt_insert->bindParam(':heure', $heure);
            $stmt_insert->bindParam(':periode', $periode);
            $stmt_insert->bindParam(':filiere', $filiere);
            $stmt_insert->bindParam(':niveau', $niveau);
            $stmt_insert->bindParam(':matiere', $matiere);
            $stmt_insert->bindParam(':professeur', $professeur);
            $stmt_insert->bindParam(':m_eleve', $matricule); // Assuming m_eleve is same as matricule
            $stmt_insert->bindParam(':nom_eleve', $nom);
            $stmt_insert->bindParam(':etat', $etat);

            if ($stmt_insert->execute()) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data received and saved successfully'
                ];
                echo json_encode($response);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save data']);
            }
        } else {
            // L'étudiant n'existe pas
            echo json_encode(['status' => 'error', 'message' => 'Cet étudiant ne participe pas à cette séance']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>