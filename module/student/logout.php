<?php
include_once('../../service/dbconnection.php');
//session_start();
session_destroy();
mysqli_close($link);

header("Location: ../../");  
?>
