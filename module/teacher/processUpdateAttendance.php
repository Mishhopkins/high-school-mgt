<?php
// Include the database connection
include_once('../../service/dbconnection.php');
include_once('main.php');

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit(); // Add an exit statement after redirection
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateAttendance'])) {
    // Retrieve form data
    $updateAttendId = $_POST['updateAttendId'];
    $newStatus = $_POST['status'];

    // Update attendance record in the database
    $updateQuery = mysqli_query($link, "UPDATE attendance SET status = '$newStatus' WHERE student_id = '$updateAttendId'");

    if ($updateQuery) {
        // Set success message and alert style
        $_SESSION['statusMsg'] = "Attendance record updated successfully!";
        $_SESSION['alertStyle'] = "alert alert-success";
    } else {
        // Set error message and alert style
        $_SESSION['statusMsg'] = "Error updating attendance record.";
        $_SESSION['alertStyle'] = "alert alert-danger";
    }

    // Redirect to the view attendance page
    header("Location: viewAttendance.php");
    exit();
}
?>