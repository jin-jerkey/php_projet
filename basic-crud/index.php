<?php
include 'conn/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- TI Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.min.css">
</head>

<body>
    <br>
    <h2 align="center">PHP CRUD using PDO Connection to MySQL</h2>
    <div class="container">
        <div class="row">
            <?php

            include 'conn/connection.php';

            $stmt = $conn->prepare("SELECT * FROM `tbl_person`");
            $stmt->execute();

            $result = $stmt->fetchAll(); // add for select sql
            foreach ($result as $row) { // add for select sql

            }

            ?>
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPerson">
                    Add Person
                </button>

                <br><br>

                <!-- Add Person Modal -->
                <div class="modal fade" id="addPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Person Modal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="personID" action="endpoint/add.php" method="POST">
                                    <input type="text" class="form-control" id="table" name="table" value="tbl_customer" hidden>
                                    <div class="mb-3" hidden>
                                        <label for="personID" class="form-label">Person ID</label>
                                        <input type="text" class="form-control" id="personID" name="tbl_person_id">
                                    </div>
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" name="middle_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update Person Modal -->
                <div class="modal fade" id="updatePersonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Person</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="personID" action="endpoint/update.php" method="POST">
                                    <input type="text" class="form-control" id="table" name="table" value="tbl_person" hidden>
                                    <div class="mb-3" hidden>
                                        <label for="personID" class="form-label">Person ID</label>
                                        <input type="text" class="form-control" id="updatePersonID" name="tbl_person_id">
                                    </div>
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="updateFirstName" name="first_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="middleName" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="updateMiddleName" name="middle_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="updateLastName" name="last_name">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form">
                    <div class="table-responsive">
                        <table class="table table-hover" id="personTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($result as $row) {

                                    $personID  = $row['tbl_person_id'];
                                    $personFirstName = $row['first_name'];
                                    $personMiddleName = $row['middle_name'];
                                    $personLastName = $row['last_name'];

                                ?>

                                    <tr class="">
                                        <td id="personID-<?= $personID ?>"><?php echo  $personID ?> </td>
                                        <td id="personFirstName-<?= $personID ?>"><?php echo  $personFirstName ?></td>
                                        <td id="personMiddleName-<?= $personID ?>"><?php echo  $personMiddleName ?></td>
                                        <td id="personLastName-<?= $personID ?>"><?php echo  $personLastName ?></td>
                                        <td>
                                            <div>
                                                <button type="button" title="Edit" class="btn btn-success btn-inverse-info btn-md p-2" onclick="update_person('<?php echo $personID ?>')"><i class="ti-pencil-alt"></i></button>
                                                <button type="button" title="Remove" class="btn btn-danger btn-inverse-danger btn-md p-2" onclick="delete_person('<?php echo $personID ?>')"><i class="ti-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        function update_person(id) {
            $("#updatePersonModal").modal("show");

            let updatePersonID = $("#personID-" + id).text();
            let updatePersonFirstName = $("#personFirstName-" + id).text();
            let updatePersonMiddleName = $("#personMiddleName-" + id).text();
            let updatePersonLastName = $("#personLastName-" + id).text();



            $("#updatePersonID").val(updatePersonID);
            $("#updateFirstName").val(updatePersonFirstName);
            $("#updateMiddleName").val(updatePersonMiddleName);
            $("#updateLastName").val(updatePersonLastName);


        }

        // delete resident data
        function delete_person(id) {

            if (confirm("Do you confirm to delete this person?")) {
                window.location = "endpoint/delete.php?person=" + id
            }
        }
    </script>




    <!-- Bootstrap JS CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>