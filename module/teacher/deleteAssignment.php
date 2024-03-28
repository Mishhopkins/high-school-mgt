
<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$statusMsg = "";
$alertStyle = "";

if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];

    // Delete attendance record for the specified student ID
    $query = mysqli_query($link, "DELETE FROM assignments WHERE id='$delid'");

    if ($query) {
        // Assignment deleted successfully
        $statusMsg = "Assignment deleted successfully!";
        $alertStyle = "alert alert-success";
    } else {
        // Error in deleting assignment
        $statusMsg = "Error deleting assignment. Please try again.";
        $alertStyle = "alert alert-danger";
    }
 // Redirect to the viewAssignments page with status message
 header("Location: viewAssignments.php?statusMsg=" . urlencode($statusMsg) . "&alertStyle=" . urlencode($alertStyle));
 exit();
} else {
 // If delid is not set, redirect to viewAssignments.php
 header("Location: viewAssignments.php");
 exit();
}
?>

