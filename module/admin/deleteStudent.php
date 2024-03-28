<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];

// Fetch the filename associated with the student
$fetchFilenameQuery = mysqli_query($link, "SELECT file FROM students WHERE id='$delid'");
if ($fetchFilenameQuery) {
    $row = mysqli_fetch_assoc($fetchFilenameQuery);
    $filename = $row['file'];
}

// Delete the student from the students table
$query = mysqli_query($link, "DELETE FROM students WHERE id='$delid'");

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

        // Redirect to viewStudent.php
        echo "<script type = \"text/javascript\">
            window.location = (\"viewStudent.php\")
            </script>";
    } else {
        // Handle the case where user deletion fails
        echo "Failed to delete the user.";
    }
} else {
    // Handle the case where student deletion fails
    echo "Failed to delete the student.";
}
?>
