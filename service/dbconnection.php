<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$db_name = "schoolsys";

// Create a new mysqli connection
$link = new mysqli($host, $username, $password, $db_name);

// Check if the connection was successful
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
?>
