<?php
// Vérifier si la demande est POST et que les données JSON sont envoyées
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données JSON
    $input = json_decode(file_get_contents('php://input'), true);

    // Vérifier si les données QR sont présentes
    if (isset($input['qrData'])) {
        $qrData = $input['qrData'];

        // Enregistrer les données dans un fichier (vous pouvez également utiliser une base de données)
        $filename = 'scanned_data.txt';
        file_put_contents($filename, $qrData . PHP_EOL, FILE_APPEND);

        // Répondre avec un message de succès
        echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
    } else {
        // Répondre avec un message d'erreur
        echo json_encode(['success' => false, 'message' => 'No QR data found.']);
    }
} else {
    // Répondre avec un message d'erreur
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>






<?php
// Récupérer les données envoyées par JavaScript
    $data = json_decode(file_get_contents('php://input'), true);
    $matricule = $data['qrData'];

    // Rechercher l'étudiant par son matricule
    $sql = "SELECT matricule, Nom FROM etudiant WHERE matricule = :matricule";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
    $stmt->execute();
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($etudiant) {
        // Récupérer les valeurs du cahier d'appel
        $sql = "SELECT * FROM cahier_appel WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $cahier = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cahier) {
            // Insérer les données dans la table appel
            $sql = "INSERT INTO appel (matricul, date, heure, periode, filiere, niveau, matiere, professeur, m_eleve, nom_eleve, etat) 
                    VALUES (:matricul, :date, :heure, :periode, :filiere, :niveau, :matiere, :professeur, :m_eleve, :nom_eleve, :etat)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':matricul', $cahier['matricul'], PDO::PARAM_STR);
            $stmt->bindParam(':date', $cahier['date'], PDO::PARAM_STR);
            $stmt->bindParam(':heure', $cahier['heure'], PDO::PARAM_STR);
            $stmt->bindParam(':periode', $cahier['periode'], PDO::PARAM_STR);
            $stmt->bindParam(':filiere', $cahier['filiere'], PDO::PARAM_STR);
            $stmt->bindParam(':niveau', $cahier['niveau'], PDO::PARAM_STR);
            $stmt->bindParam(':matiere', $cahier['matiere'], PDO::PARAM_STR);
            $stmt->bindParam(':professeur', $cahier['professeur'], PDO::PARAM_STR);
            $stmt->bindParam(':m_eleve', $etudiant['matricule'], PDO::PARAM_STR);
            $stmt->bindParam(':nom_eleve', $etudiant['Nom'], PDO::PARAM_STR);
            $stmt->bindParam(':etat', $etat = "present", PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
                header("Location: appel.php");
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'insertion des données']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Cahier d\'appel non trouvé']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Étudiant non trouvé']);
    }

?>