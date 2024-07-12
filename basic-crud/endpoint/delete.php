<?php
session_start();
include('../conn/connection.php');

if (isset($_GET['person'])) {
    $person = $_GET['person'];

    try {

        $query = "DELETE FROM `tbl_person` WHERE tbl_person_id ='$person'";

        $statement = $conn->prepare($query);
        $query_execute = $statement->execute();

        if ($query_execute) {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location:http://localhost/basic-crud/index.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Not Deleted";
            header('Location:http://localhost/basic-crud/index.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
