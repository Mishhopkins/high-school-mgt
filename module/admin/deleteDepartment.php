<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];

// Delete the department from the departments table
$query = mysqli_query($link, "DELETE FROM departments WHERE department_name='$delid'");

// Check if the deletion was successful

    if ($query) {
        echo "<script type=\"text/javascript\">
            window.location = \"viewDepartment.php\";
            </script>";
        } else {
            // Handle the case where student deletion fails
            echo "Failed to delete the Parent.";
    }
   






