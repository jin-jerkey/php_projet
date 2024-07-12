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
    $m_eleve = $matricule; // À remplir avec la valeur appropriée si disponible
    $nom_eleve = $nom; // À remplir avec la valeur appropriée si disponible
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

        $sql = "INSERT INTO appel (matricul, date, heure, periode, filiere, niveau, matiere, professeur, m_eleve, nom_eleve, etat)
                VALUES (:matricule, :date, :heure, :periode, :filiere, :niveau, :matiere, :professeur, :m_eleve, :nom_eleve, :etat)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':periode', $periode);
        $stmt->bindParam(':filiere', $filiere);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':matiere', $matiere);
        $stmt->bindParam(':professeur', $professeur);
        $stmt->bindParam(':m_eleve', $m_eleve);
        $stmt->bindParam(':nom_eleve', $nom_eleve);
        $stmt->bindParam(':etat', $etat);

        if ($stmt->execute()) {
            $response = [
                'status' => 'success',
                'message' => 'Data received and saved successfully'
            ];
            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save data']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>