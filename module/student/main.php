<?php
// session_start(); // Start the session at the very beginning

include_once('../../service/dbconnection.php');
$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name FROM students WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];

if (!isset($login_session)) {
    header("Location:../../");
}
?>
