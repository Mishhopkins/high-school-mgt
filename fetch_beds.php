<?php
// Include database connection
include_once('service/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['room_id'])) {
    $room_id = mysqli_real_escape_string($link, $_POST['room_id']);

    // Perform the database query to fetch beds based on the roomId
    $query = mysqli_query($link, "SELECT * FROM beds WHERE room_id = '$room_id'");
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        $occupiedCount = 0;
        while ($row = mysqli_fetch_array($query)) {
            $bedId = $row['id'];
            $bedNo = $row['bed_no'];
            $availability = $row['availability'];

            echo '<option value="' . $bedId . '"';
            if ($availability == 0) {
                echo ' disabled';
            }
            echo '>' . $bedNo . '</option>';

            if ($availability == 0) {
                $occupiedCount++;
            }
        }

        // Update the availability status of the room
        $roomAvailability = 1;
        if ($occupiedCount == $count) {
            $roomAvailability = 0;
        }

        mysqli_query($link, "UPDATE hostelrooms SET availability = '$roomAvailability' WHERE id = '$room_id'");
    } else {
        echo '<option value="">No Beds Found</option>';
    }
} else {
    echo '<option value="">Invalid Request</option>';
}
?>
