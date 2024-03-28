<?php
// Include database connection
include_once('service/dbconnection.php');

// Check if hostel_id is provided in the POST request
if (isset($_POST['hostel_id'])) {
    $hostel_id = mysqli_real_escape_string($link, $_POST['hostel_id']);

    // Fetch available rooms for the selected hostel
    $query = mysqli_query($link, "SELECT * FROM hostelrooms WHERE hostel_id = '$hostel_id'");
    $count = mysqli_num_rows($query);

    // Check if the query was successful
    if ($count > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $roomid = $row['id'];
            $room_no = $row['room_no'];
            $availability = $row['availability'];

            echo '<option value="' . $roomid . '"';
            if ($availability == 0) {
                echo ' disabled';
            }
            echo '>' . $room_no . '</option>';
        }
    } else {
        echo '<option value="">No Rooms Available</option>';
    }
} else {
    echo '<option value="">Invalid Request</option>';
}
?>