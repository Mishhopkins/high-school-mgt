<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];


// Delete the student from the students table
$query = mysqli_query($link, "DELETE FROM exam_schedule WHERE id='$delid'");

// Check if the deletion was successful
if ($query) {
   
        // Redirect to examSchedule.php
        echo "<script type = \"text/javascript\">
            window.location = (\"examSchedule.php\")
            </script>";
    } else {
        // Handle the case where user deletion fails
        echo "Failed to delete the exam Schedule.";
    }
?>
