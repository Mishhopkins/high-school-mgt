<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];
$query = mysqli_query($link, "DELETE FROM subjects WHERE subjectName='$delid'");

if ($query) {
    echo "<script type=\"text/javascript\">
        window.location = \"viewSubject.php\";
        </script>";
} else {
    echo "<script type=\"text/javascript\">
        window.location = \"addSubject.php\";
        </script>";
}
?>
