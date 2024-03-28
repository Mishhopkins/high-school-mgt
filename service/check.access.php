<?php
include_once('dbconnection.php');

$myid = $_POST['myid'];
$mypassword = $_POST['mypassword'];

// Use your database connection variable $link
$myid = mysqli_real_escape_string($link, $myid);
$mypassword = mysqli_real_escape_string($link, $mypassword);

$_SESSION['login_id'] = $myid;
$sql = "SELECT usertype FROM users WHERE userid='$myid' and password='$mypassword'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
$type = mysqli_fetch_array($result);
$control = $type['usertype'];

if ($count != 1 || !isset($control)) {
    header("Location: ../login.php?login=false");
} else if ($count == 1 && $control == "admin") {
    header("Location: ../module/admin");
} else if ($count == 1 && $control == "teacher") {
    header("Location: ../module/teacher");
} else if ($count == 1 && $control == "student") {
    header("Location: ../module/student");
} else if ($count == 1 && $control == "staff") {
    header("Location: ../module/staff");
} else if ($count == 1 && $control == "parent") {
    header("Location: ../module/parent");
} else {
    header("Location: ../login.php?login=false");
}
?>
