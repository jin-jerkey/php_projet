<?php
include('../conn/connection.php');

$personFirstName = $_POST['first_name'];
$personMiddleName = $_POST['middle_name'];
$personLastName = $_POST['last_name'];


// Check if the customer already exists based on customer name and phone number
$stmt = $conn->prepare("SELECT * FROM `tbl_person` WHERE first_name = :first_name AND middle_name = :middle_name AND last_name = :last_name");
$stmt->execute([
    'first_name' => $personFirstName,
    'middle_name' => $personMiddleName,
    'last_name' => $personLastName,
]);

$existingres = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($existingres)) {
    // Insert the new customer into the table
    $stmt = $conn->prepare("INSERT INTO `tbl_person` (`tbl_person_id`, `first_name`, `middle_name`, `last_name`) 
                           VALUES (NULL, :first_name, :middle_name, :last_name)");
    $stmt->execute([
        'first_name' => $personFirstName,
        'middle_name' => $personMiddleName,
        'last_name' => $personLastName,
    ]);
}

header("Location: http://localhost/basic-crud/index.php");
exit();
