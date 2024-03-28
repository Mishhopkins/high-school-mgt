<?php
// Start or resume the session
//session_start();

// Include the database connection
include_once('../../service/dbconnection.php');

$statusMsg = "";
$alertStyle = "";

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit(); // Add an exit statement after redirection
}

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name, id FROM teachers WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];
$teacherId = $row['id'];

// Define $selected_subject and $selected_class
$selected_subject = "";
$selected_class = "";

// Code to handle Save Assignment button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_assignment'])) {
    if (isset($_POST['teacher_subject'])) {
        list($selected_subject, $selected_class) = explode('-', $_POST['teacher_subject']);

        // Store the selected subject and class in a session variable
        $_SESSION['selected_subject'] = $selected_subject;
        $_SESSION['selected_class'] = $selected_class;

        // Retrieve other form data
        $assignment_description = mysqli_real_escape_string($link, $_POST['assignment_description']);

        // Check if the file upload field is set and not empty
        if (isset($_FILES["assignment_file"]) && !empty($_FILES["assignment_file"]["name"])) {
            $file_name = $_FILES["assignment_file"]["name"];
            $file_temp = $_FILES["assignment_file"]["tmp_name"];
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Generate a unique filename for the assignment file
            $unique_filename = uniqid('assignment_') . '.' . $file_type;

            // Specify the folder where the assignment files will be stored
            $uploads_dir = 'C:/xampp/htdocs/school/module/docs/';

            // Specify the complete path for the uploaded file
            $upload_path = $uploads_dir . $unique_filename;

            // Move the uploaded file to the destination folder
            if (move_uploaded_file($file_temp, $upload_path)) {
                // Insert data into assignments table
                $insert_query = mysqli_query($link, "INSERT INTO assignments (teacher_id, subject_id, class_id, description, file_name, file_path, created_at)
                                VALUES ('$check', '$selected_subject', '$selected_class', '$assignment_description', '$unique_filename', '$upload_path', NOW())");

                if ($insert_query) {
                    // Assignment saved successfully
                    $statusMsg = "Assignment saved successfully.";
                    $alertStyle = "alert-success";
                } else {
                    // Error in saving assignment
                    $statusMsg = "Error saving assignment. Please try again.";
                    $alertStyle = "alert-danger";
                }
            } else {
                // Error in moving the uploaded file
                $statusMsg = "Error in moving the uploaded file. Please try again.";
                $alertStyle = "alert-danger";
            }
        } else {
            // Handle the case where no file is uploaded
            $statusMsg = "Please select a file before saving the assignment.";
            $alertStyle = "alert-danger";
        }
    }
}
?>


<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'includes/title.php';?>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="../../assets/img/icon/student-grade.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/.....
    ...
    <link rel="stylesheet" href="../../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>

    <link rel="stylesheet" href="../../assets/css/style2.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
    <?php $page = "teacher";
    include 'includes/leftMenu.php'; ?>

    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include 'includes/header.php'; ?>
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li><a href="#">Assignments</a></li>
                                    <li class="active">Manage Assignments</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Manage Assignments</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">

                                        <form action="#" method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="teacher_subject">Select Subject and Class:</label>
                                                            <select name="teacher_subject" id="teacher_subject">
                                                            <?php
                                                            // Fetch subjects and classes assigned to the teacher from teacher_subjects
                                                            $teacher_id = $_SESSION['teacher_id']; // Assuming you have a teacher_id in your session
                                                            $query = mysqli_query($link, "SELECT teacher_subjects.subject_id, teacher_subjects.class_id, subjects.subjectName, classes.class_name
                                                            FROM teacher_subjects
                                                            JOIN subjects ON teacher_subjects.subject_id = subjects.id
                                                            JOIN classes ON teacher_subjects.class_id = classes.id
                                                            WHERE teacher_subjects.teacher_id = '$check'");
                                                                                                                    while ($row = mysqli_fetch_array($query)) {
                                                            echo '<option value="' . $row['subject_id'] . '-' . $row['class_id'] . '">' . $row['subjectName'] . ' - ' . $row['class_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="assignment_description">Assignment Description:</label>
                                                    <textarea name="assignment_description" id="assignment_description" class="form-control" rows="5" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add this section to the existing form -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="assignment_file">Upload Assignment File:</label>
                                                    <input type="file" name="assignment_file" id="assignment_file" class="form-control-file">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="text-right">
                                            <button type="submit" name="save_assignment" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> SAVE ASSIGNMENT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- .animated -->
                    </div><!-- .content -->

                    <div class="clearfix"></div>

                    <?php include 'includes/footer.php'; ?>

                </div><!-- /#right-panel -->

                <!-- Right Panel -->

                <!-- Scripts -->
                <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
                <script src="../../assets/js/main.js"></script>

                <script src="../../assets/js/lib/data-table/datatables.min.js"></script>
                <script src="../../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
                <script src="../../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
                <script src="../../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
                <script src="../../assets/js/lib/data-table/jszip.min.js"></script>
                <script src="../../assets/js/lib/data-table/vfs_fonts.js"></script>
                <script src="../../assets/js/lib/data-table/buttons.html5.min.js"></script>
                <script src="../../assets/js/lib/data-table/buttons.print.min.js"></script>
                <script src="../../assets/js/lib/data-table/buttons.colVis.min.js"></script>
                <script src="../../assets/js/init/datatables-init.js"></script>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#bootstrap-data-table-export').DataTable();
                    });

                    // Menu Trigger
                    $('#menuToggle').on('click', function (event) {
                        var windowWidth = $(window).width();
                        if (windowWidth < 1010) {
                            $('body').removeClass('open');
                            if (windowWidth < 760) {
                                $('#left-panel').slideToggle();
                            } else {
                                $('#left-panel').toggleClass('open-menu');
                            }
                        } else {
                            $('body').toggleClass('open');
                            $('#left-panel').removeClass('open-menu');
                        }
                    });
                </script>
            </body>
            </html>

