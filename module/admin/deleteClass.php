<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];
$query = mysqli_query($link, "DELETE FROM classes WHERE class_name='$delid'");

if ($query) {
    echo "<script type=\"text/javascript\">
        window.location = \"viewClasses.php\";
        </script>";
} else {
    echo "<script type=\"text/javascript\">
        window.location = \"addClass.php\";
        </script>";
}
?>
