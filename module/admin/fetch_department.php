<?php
// Include the database connection
include_once('../../service/dbconnection.php');

if (isset($_POST['teacherId'])) {
    $teacherId = mysqli_real_escape_string($link, $_POST['teacherId']);

    // Query the database to get the department name based on teacherId
    $query = "SELECT teachers.id, teachers.name, departments.department_name
              FROM teachers
              LEFT JOIN departments ON teachers.department = departments.department_id
              WHERE teachers.id = '$teacherId'";
    
    $result = mysqli_query($link, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['department_name'];
    } else {
        echo "Department not found";
    }
} else {
    echo "Invalid request";
}
?>
