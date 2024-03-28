<?php
// Start or resume the session
// session_start();
error_reporting(0);

// Include the database connection
include_once('../../service/dbconnection.php');
include_once('main.php');

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

// Define $selected_subject here
$selected_subject = "";

// Code to handle View Attendance button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_attendance'])) {
    if (isset($_POST['teacher_subject'])) {
        list($selected_subject, $selected_class) = explode('-', $_POST['teacher_subject']);

        // Fetch attendance records based on the selected subject and class for a specific date
        $view_date = $_POST['view_date'];

        $attendance_query = mysqli_query($link, "SELECT students.id, students.name, attendance.status
                            FROM students 
                            LEFT JOIN attendance ON students.id = attendance.student_id
                            WHERE attendance.subject_id = '$selected_subject' 
                            AND attendance.date = '$view_date'");

        // Additional logic if needed

    } else {
        // Handle the case where 'teacher_subject' is not set
        $statusMsg = "Please select a subject and class before viewing attendance.";
        $alertStyle = "alert-danger";
    }
}
?>

<!doctype html>
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>

    <link rel="stylesheet" href="../../assets/css/style2.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

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
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajaxCall2.php?fid=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
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
                                    <li><a href="#">Attendance</a></li>
                                    <li class="active"> Attendance Reports </li>
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
                        <strong class="card-title"><h2 align="center">Generate Attendance Reports</h2></strong>
                    </div>
                    <div class="card-body">
                        <div class="<?php echo $alertStyle; ?>" role="alert"><?php echo $statusMsg; ?></div>
                        <form action="#" method="post" enctype="multipart/form-data">

                            <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                        <label for=teacher_subject" class="control-label mb-1">Select Subject and Class:</label>
                                        <select name="teacher_subject" id="teacher_subject">
                                            <?php
                                            // Fetch subjects and classes assigned to the teacher from teacher_subjects
                                            $teacher_id = $_SESSION['teacher_id'];  // Assuming you have a teacher_id in your session
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

                                <div class="col-6">
                                <div class="form-group">
                                    <label for="view_date" class="control-label mb-1">Select Date:</label>
                                    <input id="view_date" name="view_date" type="date" class="form-control cc-exp" value="" required placeholder="Enter DOB">
                                </div>
                            </div>
                        </div>
                            
                            <div class="text-right">
                                <button type="submit" name="view_attendance" class="btn btn-primary waves-effect waves-light mt-2"><i class="fa fa-eye"></i> Generate Report</button>
                            </div>
                        </form>

                        </div>
                    </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Add your content here -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-body">
                            <div class="clearfix text-center">
                            <div class="mt-4 mb-1">
                                    <img src="../../assets/img/logos/logo.png" alt="" height="100">
                                </div>
                                <div class="mt-2">
                                    <h3 class="m-0 d-print-none"><?php echo getClassName($selected_class); ?>'s Attendance Report</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mt-3">
                                        <p><b></b></p>
                                        <p class="text-muted"></p>
                                    </div>
                                </div>
                                <div class="col-md-4 offset-md-2">
                                    <div class="mt-3">
                                        <p class="m-b-10"><strong>Generated Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo date("d-m-Y ", strtotime($view_date)); ?> </span></p>
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_attendance'])): ?>
                                            <table class="table mt-4 table-centered table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Student ID</th>
                                                        <th>Student Name</th>
                                                        <th>Status</th>
                                                </thead>
                                                <tbody>
                                    <?php
                                    $cnt = 1;

                                    while ($attendance_row = mysqli_fetch_array($attendance_query)) {
                                        echo '<tr>
                                            <td>' . $cnt . '</td>
                                            <td>' . $attendance_row['id'] . '</td>
                                            <td>' . $attendance_row['name'] . '</td>
                                            <td>' . ($attendance_row['status'] == 1 ? 'Present' : 'Absent') . '</td>
                                            
                                        </tr>';
                                        $cnt++;
                                    }
                                    
                                    
                                    ?>
                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                              

                        
                            </table>
                        <?php endif; ?>
                        <div class="text-right mt-4 d-print-none">
                          <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fas fa-print mr-1"></i> Print</a>
                        </div>
                    </div>
                    <?php
                        // Function to get the class name based on class ID
                        function getClassName($classId) {
                            global $link;

                            $query = mysqli_query($link, "SELECT class_name FROM classes WHERE id = '$classId'");
                            $row = mysqli_fetch_array($query);

                            return $row['class_name'];
                        }
                        ?>

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
