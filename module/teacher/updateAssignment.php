<?php
// Include the database connection
include_once('../../service/dbconnection.php');

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

// Check if updateAssignId is set in the URL
if (isset($_GET['updateAssignId'])) {
    $updateAssignId = $_GET['updateAssignId'];

    // Fetch assignment details based on updateAssignId
    $assignment_query = mysqli_query($link, "SELECT * FROM assignments WHERE id='$updateAssignId'");
    $assignment_row = mysqli_fetch_array($assignment_query);

    // Fetch subjects and classes assigned to the teacher
    $teacherSubjectsQuery = mysqli_query($link, "SELECT subject_id, class_id FROM teacher_subjects WHERE teacher_id='$check'");
    $subjectClassPairs = [];

    while ($subjectClassRow = mysqli_fetch_assoc($teacherSubjectsQuery)) {
        $subjectClassPairs[] = $subjectClassRow;
    }

    // Fetch subject name and class name based on subject_id and class_id
    $subjectNameQuery = mysqli_query($link, "SELECT subjectName FROM subjects WHERE id='{$assignment_row['subject_id']}'");
    $subjectName = mysqli_fetch_assoc($subjectNameQuery)['subjectName'];

    $classNameQuery = mysqli_query($link, "SELECT class_name FROM classes WHERE id='{$assignment_row['class_id']}'");
    $className = mysqli_fetch_assoc($classNameQuery)['class_name'];
} else {
    // If updateAssignId is not set, redirect to viewAssignments.php
    header("Location: viewAssignments.php");
    exit();
}

// Code to handle Update Assignment button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_assignment'])) {
    // Retrieve form data
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
            // Update assignment data in the database
            $update_query = mysqli_query($link, "UPDATE assignments SET description='$assignment_description', file_name='$unique_filename', file_path='$upload_path' WHERE id='$updateAssignId'");

            if ($update_query) {
                // Assignment updated successfully
                $statusMsg = "Assignment updated successfully.";
                $alertStyle = "alert-success";
            } else {
                // Error in updating assignment
                $statusMsg = "Error updating assignment. Please try again.";
                $alertStyle = "alert-danger";
            }
        } else {
            // Error in moving the uploaded file
            $statusMsg = "Error in moving the uploaded file. Please try again.";
            $alertStyle = "alert-danger";
        }
    } else {
        // If no new file is uploaded, update assignment data without changing the file
        $update_query = mysqli_query($link, "UPDATE assignments SET description='$assignment_description' WHERE id='$updateAssignId'");

        if ($update_query) {
            // Assignment updated successfully
            $statusMsg = "Assignment updated successfully.";
            $alertStyle = "alert-success";
        } else {
            // Error in updating assignment
            $statusMsg = "Error updating assignment. Please try again.";
            $alertStyle = "alert-danger";
        }
    }
}
?>

<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../assets/js/main.js"></script>

    <link rel="stylesheet" href="../../assets/css/style2.css">
    

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <script>
function showValues(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxCall2.php?fid="+str,true);
        xmlhttp.send();
    }
}
</script>


</head>
        <body>

        <!-- Left Panel -->
    <?php $page="student"; include 'includes/leftMenu.php';?>

<!-- /#left-panel -->

 <!-- Left Panel -->

 <!-- Right Panel -->

 <div id="right-panel" class="right-panel">

     <!-- Header-->
         <?php include 'includes/header.php';?>
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
                                 <li><a href="#">Gradebook</a></li>
                                 <li class="active">Edit Assignments</li>
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
                             <strong class="card-title"><h2 align="center"> Edit Assignments </h2></strong>
                         </div>
                         <div class="card-body">
                             <!-- Credit Card -->
                             <div id="pay-invoice">
                                 <div class="card-body">
                                 <?php if (isset($_SESSION['statusMsg'])) : ?>
                                    <div class="<?php echo $_SESSION['alertStyle']; ?>" role="alert"><?php echo $_SESSION['statusMsg']; ?></div>
                                    <?php unset($_SESSION['statusMsg'], $_SESSION['alertStyle']); // Clear the session variables after displaying ?>
                                <?php endif; ?>

                                        <form action="#" method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="teacher_subject">Subject and Class:</label>
                                                        <input type="text" class="form-control" value="<?php echo $subjectName . ' - ' . $className; ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="assignment_description">Assignment Description:</label>
                                                        <textarea name="assignment_description" id="assignment_description" class="form-control" rows="5" required><?php echo $assignment_row['description']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="assignment_file">Upload New Assignment File:</label>
                                                        <input type="file" name="assignment_file" id="assignment_file" class="form-control-file">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" name="update_assignment" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> UPDATE ASSIGNMENT</button>
                                            </div>
                                        </form>
                                    </div>
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
