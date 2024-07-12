<?php
include('../conn/connection.php');

$updatePersonID = $_POST['tbl_person_id'];
$updateFirstName = $_POST['first_name'];
$updateMiddleName = $_POST['middle_name'];
$updateLastName = $_POST['last_name'];


$stmt = $conn->prepare("UPDATE `tbl_person` SET `first_name` = '$updateFirstName', `middle_name` = '$updateMiddleName',  `last_name` = '$updateLastName' WHERE `tbl_person`.`tbl_person_id` = '$updatePersonID';");
$stmt->execute();


header("location:http://localhost/basic-crud/index.php");
