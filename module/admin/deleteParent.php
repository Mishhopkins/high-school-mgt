<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];

// Delete the teacher from the teachers table
$query = mysqli_query($link, "DELETE FROM parents WHERE id='$delid'");

// Check if the deletion was successful
if ($query) {
    // Now, delete the corresponding user from the users table
    $userDeletionQuery = mysqli_query($link, "DELETE FROM users WHERE userid='$delid'");

    if ($userDeletionQuery) {
        // Deletion was successful
		
		// Redirect to viewParent.php
        echo "<script type = \"text/javascript\">
            window.location = (\"viewParent.php\")
            </script>";
    } else {
        // Handle the case where user deletion fails
        echo "Failed to delete the user.";
    }
} else {
    // Handle the case where student deletion fails
    echo "Failed to delete the Parent.";
}
?>
