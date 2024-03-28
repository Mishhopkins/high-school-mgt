<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];

// Fetch the filename associated with the teacher
$fetchFilenameQuery = mysqli_query($link, "SELECT file FROM teachers WHERE id='$delid'");
if ($fetchFilenameQuery) {
    $row = mysqli_fetch_assoc($fetchFilenameQuery);
    $filename = $row['file'];
}

// Delete the teacher from the teachers table
$query = mysqli_query($link, "DELETE FROM teachers WHERE id='$delid'");

// Check if the deletion was successful
if ($query) {
    // Now, delete the corresponding user from the users table
    $userDeletionQuery = mysqli_query($link, "DELETE FROM users WHERE userid='$delid'");

    if ($userDeletionQuery) {
        // Deletion was successful
        // Delete the associated image
        if (isset($filename) && !empty($filename)) {
            unlink("../images/" . $filename);
        }

        // Redirect to viewTeacher.php
        echo "<script type = \"text/javascript\">
            window.location = (\"viewTeacher.php\")
            </script>";
    } else {
        // Handle the case where user deletion fails
        echo "Failed to delete the user.";
    }
} else {
    // Handle the case where student deletion fails
    echo "Failed to delete the teacher.";
}
?>
