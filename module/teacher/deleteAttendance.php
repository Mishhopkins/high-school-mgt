<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$statusMsg = "";
$alertStyle = "";

if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];

    // Delete attendance record for the specified student ID
    $query = mysqli_query($link, "DELETE FROM attendance WHERE student_id='$delid'");

    if ($query) {
        // Set success message and alert style
        $statusMsg = "Attendance record deleted successfully!";
        $alertStyle = "alert alert-success";
    } else {
        // Set error message and alert style
        $statusMsg = "Error deleting attendance record.";
        $alertStyle = "alert alert-danger";
    }

    // Redirect to the viewAttendance page with status message
    header("Location: viewAttendance.php?statusMsg=" . urlencode($statusMsg) . "&alertStyle=" . urlencode($alertStyle));
    exit();
} else {
    // Redirect to the viewAttendance page if 'delid' is not set
    header("Location: viewAttendance.php");
    exit();
}
?>
