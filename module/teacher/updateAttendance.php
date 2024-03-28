<?php
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

// Check if the updateAttendId is set in the URL
if (isset($_GET['updateAttendId'])) {
    $updateAttendId = $_GET['updateAttendId'];

    // Fetch the attendance record based on the updateAttendId
    $attendance_query = mysqli_query($link, "SELECT students.id, students.name, attendance.status
                        FROM students 
                        LEFT JOIN attendance ON students.id = attendance.student_id
                        WHERE students.id = '$updateAttendId'");

    $attendance_row = mysqli_fetch_array($attendance_query);

    // Check if the attendance record is found
    if ($attendance_row) {
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
                                 <li><a href="#">Manage Student</a></li>
                                 <li class="active">Edit Student</li>
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
                             <strong class="card-title"><h2 align="center"> Update Attendance </h2></strong>
                         </div>
                         <div class="card-body">
                             <!-- Credit Card -->
                             <div id="pay-invoice">
                                 <div class="card-body">
                                 <?php if (isset($_SESSION['statusMsg'])) : ?>
                                    <div class="<?php echo $_SESSION['alertStyle']; ?>" role="alert"><?php echo $_SESSION['statusMsg']; ?></div>
                                    <?php unset($_SESSION['statusMsg'], $_SESSION['alertStyle']); // Clear the session variables after displaying ?>
                                <?php endif; ?>
           
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="studentId">Student ID:</label>
                                                <input type="text" id="studentId" name="studentId" class="form-control" value="<?php echo $attendance_row['id']; ?>" readonly>
                                            </div>
                                        </div>
                                    
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="studentName">Student Name:</label>
                                                <input type="text" id="studentName" name="studentName" class="form-control" value="<?php echo $attendance_row['name']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="currentStatus">Current Status:</label>
                                                <input type="text" id="currentStatus" name="currentStatus" class="form-control" value="<?php echo ($attendance_row['status'] == 1) ? 'Present' : 'Absent'; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>



                                        <!-- Your form for updating attendance goes here -->
                                <form action="processUpdateAttendance.php" method="post">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="status">New Attendance Status:</label>
                                                <select name="status" id="status">
                                                    <option value="1" <?php echo ($attendance_row['status'] == 1) ? 'selected' : ''; ?>>Present</option>
                                                    <option value="0" <?php echo ($attendance_row['status'] == 0) ? 'selected' : ''; ?>>Absent</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Hidden input for updateAttendId -->
                                        <input type="hidden" name="updateAttendId" value="<?php echo $updateAttendId; ?>">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <button type="submit" name="updateAttendance" class="btn btn-success">Update Attendance</button>
                                            </div>
                                        </div>
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
        <?php
    } else {
        echo "Attendance record not found.";
    }
} else {
    echo "UpdateAttendId not set in the URL.";
}
?>
