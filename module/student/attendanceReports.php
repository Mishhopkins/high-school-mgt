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
$session = mysqli_query($link, "SELECT name, id FROM students WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];
$teacherId = $row['id'];

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT id, name, classid FROM students WHERE id='$check'");
$row = mysqli_fetch_array($session);
$student_id = $row['id'];
$student_name = $row['name'];
$selected_class = $row['classid'];


// Code to handle View Attendance button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_attendance'])) {
    // Fetch attendance records based on the selected student's class for a specific date range
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $attendance_query = mysqli_query($link, "SELECT subjects.subjectName, attendance.status, attendance.date
                        FROM attendance
                        JOIN subjects ON subjects.id = attendance.subject_id
                        WHERE attendance.student_id = '$check'
                        AND attendance.date BETWEEN '$start_date' AND '$end_date'");

    // Additional logic if needed
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <?php $page = "Attendance";
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
                                    <li><a href="#">My Attendance</a></li>
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
                                                <label for="start_date" class="control-label mb-1">Start Date:</label>
                                                <input id="start_date" name="start_date" type="date" class="form-control cc-exp" value="" required placeholder="Enter start date">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="end_date" class="control-label mb-1">End Date:</label>
                                                <input id="end_date" name="end_date" type="date" class="form-control cc-exp" value="" required placeholder="Enter end date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" name="view_attendance" class="btn btn-primary waves-effect waves-light mt-2"><i class="fa fa-eye"></i> Generate Report</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

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
                                    <h3 class="m-0 d-print-none"><?php echo ($student_name); ?>'s Attendance Report</h3> <br>
                                    <h3 class="text-center">Student ID: <?php echo $check; ?></h3>
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
                                        <p class="m-b-10"><strong>Period : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $start_date . ' to ' . $end_date; ?> </span></p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_attendance'])): ?>
                                                        <table class="table mt-4 table-centered table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Subject</th>
                                                                    <th>Attendance</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $cnt = 1;
                                                                $presentCount = 0;
                                                                $totalDays = 0;
                                                                while ($attendance_row = mysqli_fetch_array($attendance_query)) {
                                                                    $status = $attendance_row['status'];
                                                                    $statusText = ($status == 1) ? 'Present' : (($status == 0) ? 'Absent' : 'Unmarked');

                                                                    // Increment the totalDays only if attendance is marked
                                                                    if ($status !== 'Unmarked') {
                                                                        $totalDays++;
                                                                    }

                                                                    // Update the presentCount based on the 'Present' status
                                                                    if ($status == 1) {
                                                                        $presentCount++;
                                                                    }

                                                                    // Calculate the percentage based on the total number of days
                                                                    $percentage = ($totalDays > 0) ? ($presentCount / $totalDays) * 100 : 0;

                                                                    // Determine the color for the progress bar
                                                                    if ($status == 1) {
                                                                        $progressBarColor = 'bg-success';
                                                                    } elseif ($status == 0) {
                                                                        $progressBarColor = 'bg-danger';
                                                                    } else {
                                                                        $progressBarColor = 'bg-secondary';
                                                                    }
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $cnt; ?></td>
                                                                        <td><?php echo $attendance_row['subjectName']; ?></td>
                                                                        <td>
                                                                            <div class="progress">
                                                                                <div class="progress-bar <?php echo $progressBarColor; ?>" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <?php echo $statusText; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    $cnt++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <div class="legend mt-4">
                                                            <div class="legend-item" style="background-color: #28a745;">
                                                                <span class="legend-box"></span> Present
                                                            </div>
                                                            <div class="legend-item" style="background-color: #dc3545;">
                                                                <span class="legend-box"></span> Absent
                                                            </div>
                                                            <div class="legend-item" style="background-color: #6c757d;">
                                                                <span class="legend-box"></span> Unmarked
                                                            </div>
                                                        </div>


                                                        <div class="remarks mt-2">
                                                            <strong>Remarks:</strong>
                                                            <?php
                                                            if ($percentage >= 80) {
                                                                echo "Best";
                                                            } elseif ($percentage >= 60) {
                                                                echo "Good";
                                                            } elseif ($percentage >= 40) {
                                                                echo "Average";
                                                            } else {
                                                                echo "Poor";
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="text-right mt-4 d-print-none">
                                                            <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print mr-1"></i> Print Report</button>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                    </div>
                </div>
            </div>
        </div>
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
