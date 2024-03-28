<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$delid = $_GET['delid'];
$query = mysqli_query($link, "DELETE FROM session WHERE sessionName='$delid'");

if ($query) {
    echo "<script type=\"text/javascript\">
        window.location = \"viewSession.php\";
        </script>";
} else {
    echo "<script type=\"text/javascript\">
        window.location = \"createSession.php\";
        </script>";
}
?>
