<?php
// Initialize session
//session_start();
//error_reporting(0);

include_once('service/dbconnection.php');
include('head.php');

// Step 1: Personal Details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step1_submit'])) {
    // Sanitize and validate user input
    $stuName = mysqli_real_escape_string($link, $_POST['stuName']);
    $stuId = mysqli_real_escape_string($link, $_POST['stuId']);
    $stuPassword = mysqli_real_escape_string($link, $_POST['stuPassword']);
    $stuPhone = mysqli_real_escape_string($link, $_POST['stuPhone']);
    $stuEmail = mysqli_real_escape_string($link, $_POST['stuEmail']);
    $stugender = mysqli_real_escape_string($link, $_POST['stugender']);
    $stuDOB = mysqli_real_escape_string($link, $_POST['stuDOB']);
    $stuAdmissionDate = mysqli_real_escape_string($link, $_POST['stuAdmissionDate']);
    $stuAddress = mysqli_real_escape_string($link, $_POST['stuAddress']);

    // Check if the file upload field is set and not empty
    if (isset($_FILES["photo"]) && !empty($_FILES["photo"]["name"])) {
        $finame = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($finame, PATHINFO_EXTENSION));
        $filename = "student" . $stuId . "pic." . $imageFileType;
        $folder = "./module/images/" . $filename;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($tempname, $folder)) {
            // Insert data into students table
              // Insert data into students table
            $sql = "INSERT INTO students (file, id, name, password, phone, email, sex, dob, addmissiondate, address) VALUES ('$filename', '$stuId', '$stuName', '$stuPassword', '$stuPhone', '$stuEmail', '$stugender', '$stuDOB', '$stuAdmissionDate', '$stuAddress')";

            // Store student number in session
            $_SESSION['id'] = $stuId;

            $success = mysqli_query($link, $sql);

            if ($success) {
                // Insert data into users table
                $sql = "INSERT INTO users (userid, password, usertype) VALUES ('$stuId', '$stuPassword', 'student')";
                $success = mysqli_query($link, $sql);

                if ($success) {
                    $alertStyle = "alert alert-success";
                    $statusMsg = "Student Added Successfully!";
                } else {
                    $alertStyle = "alert alert-danger";
                    $statusMsg = "An error occurred while adding the student to the users table.";
                }
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred while adding the student to the students table.";
            }
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Failed to upload the student's picture.";
        }
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Please select a picture for the student.";

}


    // Redirect to step 2: parent Details
    header('Location: admi.php?step=2');
    exit;
}

// Check if the form has been submitted for Step 2
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step2_submit'])) {
    // Sanitize and validate user input for Step 2
    $parentid = mysqli_real_escape_string($link, $_POST['parentid']);
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $stuId = isset($_SESSION['id']) ? mysqli_real_escape_string($link, $_SESSION['id']) : '';
    $fathername = mysqli_real_escape_string($link, $_POST['fathername']);
    $mothername = mysqli_real_escape_string($link, $_POST['mothername']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $fatherphone = mysqli_real_escape_string($link, $_POST['fatherphone']);
    $motherphone = mysqli_real_escape_string($link, $_POST['motherphone']);
    $address = mysqli_real_escape_string($link, $_POST['address']);

     $stuId = $_SESSION['id'];

    // Insert data into parents table
    $sql = "INSERT INTO parents (id, fathername, mothername, password, fatherphone, motherphone, address) VALUES ('$parentid','$fathername', '$mothername', '$password', '$fatherphone', '$motherphone', '$address')";
    $success = mysqli_query($link, $sql);

    // Check if the parent was inserted successfully
    if ($success) {
        // Get the parent id of the newly inserted parent
        $parentId = mysqli_insert_id($link);

        // Insert data into student_parent table
        $sql = "INSERT INTO student_parent (student_id, parent_id) VALUES ('$stuId', '$parentid')";
        $success = mysqli_query($link, $sql);

        // Insert data into users table for parent
        $sql = "INSERT INTO users (userid, password, usertype) VALUES ('$parentid', '$password', 'parent')";
        $success = mysqli_query($link, $sql);

        if ($success) {
            $alertStyle = "alert alert-success";
            $statusMsg = "Parent Added Successfully!";
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "An error occurred while adding the parent to the users table.";
        }
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "An error occurred while adding the parent to the parents table.";
    }

    // Check if previous button was clicked
    if (isset($_POST['step2_previous'])) {
        // Redirect to step 1: Personal Details
        header('Location: admi.php?step=1');
    } else {
        // Redirect to step 3: Class Details
        header('Location: admi.php?step=3');
    }
    exit;
}

// Step 3: Class Details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step3_submit'])) {

    // Store class details in session variables
    $classid = $_POST['class_id']; // Get the selected class
    $sessionid = $_POST['sessionId']; // Get the selected session

    $stuId = $_SESSION['id'];

    // Insert class details into the database
    $query = mysqli_query($link, "UPDATE students SET classid = '$classid', sessionid = '$sessionid' WHERE id = '$stuId'");

    // Store classid and sessionid in session
    $_SESSION['classid'] = $classid;
    $_SESSION['sessionid'] = $sessionid;

    $default_subjects_query = "SELECT * FROM subjects WHERE is_default = 1";
    $result = mysqli_query($link, $default_subjects_query);

    // Insert default subjects into the student_subjects table
    while ($row = mysqli_fetch_assoc($result)) {
    $subject_id = $row["id"];

    // Insert default subjects into the student_subjects table
    $insert_default_subject_query = "INSERT INTO student_subjects (studentId, subjectId) VALUES ('$stuId', '$subject_id')";
    mysqli_query($link, $insert_default_subject_query);
}



    // Save chosen optional subjects into the student_subjects table
    $optional_subjects = isset($_POST['optional_subjects']) ? $_POST['optional_subjects'] : array();

    foreach ($optional_subjects as $subject_id) {
    // Insert optional subjects into the student_subjects table
    $insert_optional_subject_query = "INSERT INTO student_subjects (studentId, subjectId) VALUES ('$stuId', '$subject_id')";
    mysqli_query($link, $insert_optional_subject_query);
}


    // Check if previous button was clicked
    if (isset($_POST['step3_previous'])) {
        // Redirect to step 2: Parent Details
        header('Location: admi.php?step=2');
    } else {
        // Redirect to step 4: Accommodation Details
        header('Location: admi.php?step=4');
    }
    exit;
}

// Step 4: Accommodation Details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step4_submit'])) {
    $hostel_id = mysqli_real_escape_string($link, $_POST['hostel_id']); // Get the selected hostel
    $roomId = mysqli_real_escape_string($link, $_POST['room_no']); // Get the selected room
    $bedId = mysqli_real_escape_string($link, $_POST['bedId']); // Get the selected bed

    // Update bed availability status to occupied (0)
    $updateBedQuery = "UPDATE beds SET availability = '0', student_id = '".$_SESSION['id']."' WHERE id = '$bedId'";
    mysqli_query($link, $updateBedQuery);

    // Insert accommodation details into the students table
    $stuId = $_SESSION['id'];
    $insertAccommodationQuery = "UPDATE students SET bedid = '$bedId', hostelid = '$hostel_id'  WHERE id = '$stuId'";
    mysqli_query($link, $insertAccommodationQuery);

    // Check if previous button was clicked
    if (isset($_POST['step4_previous'])) {
        // Redirect to step 3: Class Details
        header('Location: admi.php?step=3');
    } else {
        // Redirect to step 5: Financial Details
        header('Location: admi.php?step=5');
    }
    exit;
}

// Step 5: Financial Details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['step5_submit'])) {
    $sessionId = mysqli_real_escape_string($link, $_POST['sessionId']); // Get the selected session
    $fees = mysqli_real_escape_string($link, $_POST['fees']); // Get the entered fees

    // Get the fee amount for the selected session from the fees table
    $getFeeQuery = "SELECT amount FROM fees WHERE session_id = ?";
    $stmt = $link->prepare($getFeeQuery);
    $stmt->bind_param("i", $sessionId);
    $stmt->execute();
    $stmt->bind_result($amount);
    $stmt->fetch();
    $stmt->close();

    // Calculate the balance
    $balance = $amount - $fees;

    // Insert payment details into the payments table
    if (isset($_SESSION['id'])) {
        $stuId = $_SESSION['id'];
        $status = ($balance == 0) ? 'cleared' : 'not cleared';
        $insertPaymentQuery = "INSERT INTO payments (session_id, amount, paid_amount, balance, student_id, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($insertPaymentQuery);
        $stmt->bind_param("idddss", $sessionId, $amount, $fees, $balance, $stuId, $status);
        $success = $stmt->execute();
        $paymentId = $stmt->insert_id; // Get the inserted payment ID
        $stmt->close();

        if ($success) {
            // Update the fee_id in the students table
            $updateFeeIdQuery = "UPDATE students SET feeid = ? WHERE id = ?";
            $stmt2 = $link->prepare($updateFeeIdQuery);
            $stmt2->bind_param("is", $paymentId, $stuId);
            $stmt2->execute();
            $stmt2->close();

            // Clear session variables
            session_unset();
            session_destroy();

            // Redirect to a confirmation page
            
            header('Location: confirmation.php');
            exit;
        } 
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admission form</title>
    <meta content="" name="descriptison">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!--  CSS Files -->
      <link rel="shortcut icon" href="assets/img/icon/student-grade.png" />
      <link href="assets/mine/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- <link href="assets/mine/icofont/icofont.min.css" rel="stylesheet"> -->
      <link href="assets/mine/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/mine/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/mine/animate.css/animate.min.css" rel="stylesheet">
      <link href="assets/mine/aos/aos.css" rel="stylesheet">

      
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

</head>
  

<body>
<!-- HTML form for admission -->
<body class="bg-#91bde7" onload="generateUPI()">
    <div class="container">
        <!-- Progress bar -->
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: <?php echo isset($_GET['step']) ? ($_GET['step'] * 33.33) : 33.33; ?>%" aria-valuenow="<?php echo isset($_GET['step']) ? ($_GET['step'] * 33.33) : 33.33; ?>" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        
        <!-- HTML form for admission -->
        <form method="POST" action="admi.php<?php if(isset($_GET['step'])) echo '?step=' . $_GET['step']; ?>" enctype="multipart/form-data">
                <?php if (!isset($_GET['step']) || $_GET['step'] == 1): ?>
                    <!-- Step 1: Personal Details -->
                    <div class="step-container">
                        <h2>Step 1: Personal Details</h2>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuName" class="control-label mb-1">Full Name</label>
                                    <input id="stuName" name="stuName" type="text" class="form-control cc-exp" value="" Required placeholder="Enter Name">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuId" class="control-label mb-1"> Student UPI No</label>
                                    <input id="stuId" name="stuId" type="text" class="form-control cc-exp" Required placeholder="Enter UPI No.">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuPassword" class="control-label mb-1">Student Password</label>
                                    <input id="stuPassword" name="stuPassword" type="text" class="form-control cc-exp" value="" placeholder="Enter Password">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuPhone" class="control-label mb-1">Student Phone:</label>
                                    <input id="stuPhone" name="stuPhone" type="text" class="form-control cc-exp" value="" Required placeholder="Enter Phone Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuEmail" class="control-label mb-1">Student Email:</label>
                                    <input id="stuEmail" name="stuEmail" type="text" class="form-control cc-exp" value="" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label mb-1">Gender:</label> <br>
                                    <input type="radio" name="stugender" value="Male" onclick="stugender = this.value;"> Male
                                    <input type="radio" name="stugender" value="Female" onclick="this.value"> Female
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuDOB" class="control-label mb-1">Student DOB:</label>
                                    <input id="stuDOB" name="stuDOB" type="date" class="form-control cc-exp" value="" placeholder="Enter DOB">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="control-label mb-1">Student Admission Date:</label> <br>
                                    <input id="stuAdmissionDate" name="stuAdmissionDate" value="<?php echo date('Y-m-d');?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stuAddress" class="control-label mb-1">Student Address:</label>
                                    <input id="stuAddress" name="stuAddress" type="text" class="form-control cc-exp" value="" placeholder="Enter Address">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="photo" class="control-label mb-1">Student Photo:</label>
                                    <input id="photo" name="photo" type="file" class="form-control cc-exp" value="" placeholder="Choose Photo">
                                </div>
                            </div>
                        </div>

                        <div class="button-group">
                            <input type="submit" name="step1_submit" value="Next" class="btn btn-primary">
                        </div>
                    </div>

                    <?php elseif ($_GET['step'] == 2): ?>
                <div class="step-container">
                        <h2>Step 2: Parent Details</h2>
                        
                        <!-- New inputs for parent details -->

                        <div class="col-6">
                             <div class="form-group">
                                <label for="cc-exp" class="control-label mb-1">Parent Id</label>  
                                <input id="parentid" name="parentid" type="text" class="form-control cc-exp" value="" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter ID">
                            </div>

                            <div class="form-group">
                                <!-- <label for="cc-exp" class="control-label mb-1">Parent Id</label>   -->
                                <input id="id" name="id" type="hidden" class="form-control cc-exp" value="<?php echo $stuId; ?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter ID">
                            </div>

                        </div>

                        <div class="col-6">
                                        
                        <div class="form-group">
                            <label for="fathername" class="control-label mb-1">Father's Name:</label>
                            <input id="fathername" name="fathername" type="text" class="form-control cc-exp" value="" required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Father's name">
                        </div>

                        <div class="form-group">
                            <label for="mothername" class="control-label mb-1">Mother's Name:</label>
                            <input id="mothername" name="mothername" type="text" class="form-control cc-exp" value="" required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Mother's name">
                        </div>
                      </div>

                      <div class="col-6">

                        <div class="form-group">
                            <label for="password" class="control-label mb-1">Password:</label>
                            <input id="password" name="password" type="text" class="form-control cc-exp" value="" required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                        </div>

                        <div class="form-group">
                            <label for="fatherphone" class="control-label mb-1">Father's Phone:</label>
                            <input id="fatherphone" name="fatherphone" type="text" class="form-control cc-exp" value="" required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Father's Contact">
                        </div>
                        </div>

                        <div class="col-6">

                        <div class="form-group">
                            <label for="motherphone" class="control-label mb-1">Mother's Phone:</label>
                            <input id="motherphone" name="motherphone" type="text" class="form-control cc-exp" value="" required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Mother's contact">
                        </div>

                        <div class="form-group">
                            <label for="address" class="control-label mb-1">Address:</label>
                            <input id="address" name="address" type="text" class="form-control cc-exp" value="" required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Parent's Address">
                        </div>
                    </div>
                 </div>

                    <div class="button-group">
                        <input type="button" name="step2_previous" value="Previous" class="btn btn-primary" onclick="goToPreviousStep(1)">
                        <input type="submit" name="step2_submit" value="Next" class="btn btn-primary">
                    </div>
                    </div>

                    <?php elseif ($_GET['step'] == 3): ?>
                <!-- Step 3: Class Details -->
                <div class="step-container">
                    <h2>Step 3: Class Details</h2>

                  <div class="form-group">
                      <label for="classes">Classes</label>
                      <?php 
                      $query=mysqli_query($link,"select * from classes ORDER BY class_name ASC");                        
                      $count = mysqli_num_rows($query);
                      if($count > 0){                       
                          echo ' <select required name="class_id" class="custom-select form-control">';
                          echo'<option value="">--Select Class--</option>';
                          while ($row = mysqli_fetch_array($query)) {
                              echo'<option value="'.$row['id'].'" >'.$row['class_name'].'</option>';
                              }
                              echo '</select>';
                          }
                          ?>   
                  </div>

                      <div class="form-group">
                          <label for="session">SESSION</label>
                          <?php 
                          $query=mysqli_query($link,"select * from session where status = 1 ");                        
                          $count = mysqli_num_rows($query);
                          if($count > 0){                       
                              echo ' <select required name="sessionId" class="custom-select form-control">';
                              echo'<option value="">--Select Session--</option>';
                              while ($row = mysqli_fetch_array($query)) {
                                  echo'<option value="'.$row['id'].'" >'.$row['sessionName'].'</option>';
                                  }
                                  echo '</select>';
                              }
                              ?>   
                      </div>

                      <label>Compulsory Subjects:</label><br>
                        <?php

                        $default_subjects_query = "SELECT * FROM subjects WHERE is_default = 1";
                        $result = mysqli_query($link, $default_subjects_query);

                        // Display default subjects as checkboxes
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<input type="checkbox" name="default_subjects[]" value="' . $row["id"] . '" class="default_subjects" checked disabled>' . $row["subjectName"] . '<br>';
                        }
                        ?>

                        <label>Choose One Subject:</label><br>
                        <?php
                        $optional_subjects_query = "SELECT * FROM subjects WHERE is_default = 0";
                        $result = mysqli_query($link, $optional_subjects_query);

                        // Display default subjects as checkboxes
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<input type="radio" name="optional_subjects[]" value="' . $row["id"] . '">' . $row["subjectName"] . '<br>';
                        }
                        ?>

                    <div class="button-group">
                        <input type="button" name="step3_previous" value="Previous" class="btn btn-primary" onclick="goToPreviousStep(2)">
                        <input type="submit" name="step3_submit" value="Next" class="btn btn-primary">
                    </div>
                </div>


                <?php elseif ($_GET['step'] == 4): ?>
    <!-- Step 4: Accommodation Details -->
    <form method="POST" action="admi.php">
        <div class="step-container">
            <h2>Step 4: Accommodation Details</h2>

            <div class="form-group">
                <label for="hostel_id" class="control-label mb-1">Hostel</label>
                <?php 
                $query = mysqli_query($link, "SELECT * FROM hostels ORDER BY hostels_name ASC");                        
                $count = mysqli_num_rows($query);
                if ($count > 0) {                       
                    echo '<select required name="hostel_id" class="custom-select form-control" onchange="loadhostelrooms(this.value)">';
                    echo '<option value="">--Select Hostel--</option>';
                    while ($row = mysqli_fetch_array($query)) {
                        echo '<option value="' . $row['id'] . '">' . $row['hostels_name'] . '</option>';
                    }
                    echo '</select>';
                }
                ?>   
            </div>

            <div class="form-group">
                <label for="room_no" class="control-label mb-1">Room No</label>
                <select required name="room_no" class="custom-select form-control" id="roomSelect">
                    <option value="">--Select Room--</option>
                </select>
            </div>

            <div class="form-group">
    <label for="bedId" class="control-label mb-1">Bed No</label>
    <select required name="bedId" class="custom-select form-control" id="bedSelect">
        <option value="">--Select Bed--</option>
    </select>
</div>

<div class="button-group">
    <input type="button" name="step4_previous" value="Previous" class="btn btn-primary" onclick="goToPreviousStep(3)">
    <input type="submit" name="step4_submit" value="Next" class="btn btn-primary">
</div>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadhostelrooms(hostel_id) {
        if (hostel_id !== "") {
            $.ajax({
                url: "fetch_rooms.php",
                method: "POST",
                data: { hostel_id: hostel_id },
                success: function(response) {
                    $('#roomSelect').html(response);
                    $('#bedSelect').html('<option value="">--Select Bed--</option>');
                }
            });
        } else {
            $('#roomSelect').html('<option value="">--Select Room--</option>');
            $('#bedSelect').html('<option value="">--Select Bed--</option>');
        }
    }

    function loadBeds(room_id) {
        if (room_id !== "") {
            $.ajax({
                url: "fetch_beds.php",
                method: "POST",
                data: { room_id: room_id },
                success: function(response) {
                    $('#bedSelect').html(response);
                }
            });
        } else {
            $('#bedSelect').html('<option value="">--Select Bed--</option>');
        }
    }

    $(document).ready(function() {
        $('#roomSelect').change(function() {
            var room_id = $(this).val();
            loadBeds(room_id);
        });
    });
</script>

<?php elseif ($_GET['step'] == 5): ?>
    <!-- Step 5: Financial Details -->
    <div class="step-container">
        <h2>Step 5: Financial Details</h2>
        <form method="POST" action="your_form_processing_script.php">
            <div class="form-group">
                <label for="sessionId">SESSION</label>
                <?php 
                $query = mysqli_query($link, "SELECT * FROM session WHERE status = 1");                        
                $count = mysqli_num_rows($query);
                if ($count > 0) {                       
                    echo '<select required name="sessionId" class="custom-select form-control">';
                    echo '<option value="">--Select Session--</option>';
                    while ($row = mysqli_fetch_array($query)) {
                        echo '<option value="'.$row['id'].'" >'.$row['sessionName'].'</option>';
                    }
                    echo '</select>';
                }
                ?>   
            </div>
            <div class="form-group">
                <label for="fees">Fees</label>
                <input type="text" name="fees" id="fees" required>
            </div>

            <div class="button-group">
                <input type="button" name="step5_previous" value="Previous" class="btn btn-primary" onclick="goToPreviousStep(4)">
                <input type="submit" name="step5_submit" value="Submit" class="btn btn-primary">
            </div>
            </div>
        </form>
    </div>
<?php endif; ?>

 
</div>
  

<script>
        function goToPreviousStep(previousStep) {
            window.location.href = 'admi.php?step=' + previousStep;
        }
        
    </script>

 <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Find all checkboxes with class "default_subjects"
            const defaultSubjectsCheckboxes = document.querySelectorAll('.default_subjects');

            // Disable the checkboxes for default subjects
            defaultSubjectsCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = true;
            });
        });
    </script>
</body>
</html>

<style>
/* Styling for the multistep form */
/* Global Styles */
body {
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  line-height: 1.6;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 80%;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  margin-top: 0;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: 600;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: 600;
  margin-bottom: 5px;
}

input[type="text"],
select {
  width: auto;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

input[type="submit"],
.btn {
  display: inline-block;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  background-color: #007bff;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s;
}

input[type="submit"]:hover,
.btn:hover {
  background-color: #0062cc;
}

.button-group {
  text-align: flex;
}

/* Progress Bar */
.progress {
  height: 20px;
  margin-bottom: 20px;
  background-color: #f1f1f1;
  border-radius: 10px;
  overflow: hidden;
}

.progress-bar {
  height: 100%;
  background-color: #007bff;
  transition: width 0.3s;
}

/* Step Container */
.step-container {
  
}

.step-container.active {
  display: block;
}

/* Additional Styling */
body.bg-light {
  background-color: #8eacc9;
}

.container {
  background:linear-gradient(70deg, white, white, yellow, blue, white);
  margin-top: 150px;
  border-radius: 10px;
  box-shadow: 10px 10px 10px black;
  float: center;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0062cc;
  border-color: #0062cc;
}

.progress-bar {
  background-color: #007bff;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .container {
    max-width: 100%;
    padding: 10px;
  }
}
</style>