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

// Define $selected_subject here
$selected_subject = "";

// Code to handle Modify button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modify'])) {
    if (isset($_POST['teacher_subject'])) {
        list($selected_subject, $selected_class) = explode('-', $_POST['teacher_subject']);

        // Store the selected subject and class in a session variable
        $_SESSION['selected_subject'] = $selected_subject;
        $_SESSION['selected_class'] = $selected_class;

        // rest of the modify button code
    } else {
        // Handle the case where 'teacher_subject' is not set
        $statusMsg = "Please select a subject and class before modifying.";
        $alertStyle = "alert-danger";
    }
}

// Code to handle Mark Attendance button
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_attendance'])) {
    // Retrieve the selected subject and class from the session variable
    $selected_subject = $_SESSION['selected_subject'];
    $selected_class = $_SESSION['selected_class'];

    // Check if subject and class are selected before proceeding
    if (empty($selected_subject) || empty($selected_class)) {
        $statusMsg = "Please select a subject and class before marking attendance.";
        $alertStyle = "alert-danger";
    } else {
        // Fetch students based on the selected subject and class from student_subjects
        $student_query = mysqli_query($link, "SELECT students.id, students.name
                            FROM students 
                            JOIN student_subjects ON students.id = student_subjects.studentId
                            WHERE student_subjects.subjectId = '$selected_subject'");

        // Get the attendance date (you may adjust the format as needed)
        $attendance_date = date("Y-m-d");

     // Loop through the students
while ($student_row = mysqli_fetch_array($student_query)) {
    $student_id = $student_row['id'];

    // Check if the attendance button for this student is clicked
    if (isset($_POST['mark_attendance'][$student_id])) {
        // Determine the status based on which button is clicked
        $status = $_POST['mark_attendance'][$student_id] === 'present' ? 1 : 0;

        // Insert the attendance record into the database
        $insert_query = mysqli_query($link, "INSERT INTO attendance (student_id, subject_id, date, status)
                            VALUES ('$student_id', '$selected_subject', '$attendance_date', '$status')");

        // Check if the insertion was successful
        if ($insert_query) {
            // Attendance recorded successfully
            $statusMsg = "Attendance recorded successfully.";
            $alertStyle = "alert-success";
        } else {
            // Error in recording attendance
            $statusMsg = "Error recording attendance. Please try again.";
            $alertStyle = "alert-danger";
        }
    }
}
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
                                    <li><a href="#">My Students</a></li>
                                    <li class="active">View Students </li>
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
                                <strong class="card-title"><h2 align="center">My Students</h2></strong>
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
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" name="modify" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> MODIFY & VIEW</button>
                                        </div>
                                        </form>
                                        

                            
                                        <div class="content">
                                            <div class="animated fadeIn">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                        </div> <!-- .card -->
                                                    </div><!--/.col-->

                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <strong class="card-title"><h2 align="center">Students List</h2></strong>
                                                            </div>
                                                            <div class="card-body">
                                                            <div class="<?php echo $alertStyle; ?>" role="alert"><?php echo $statusMsg; ?></div>
                                                            <form action="#" method="post" enctype="multipart/form-data">
                                                                <table id="attendance-data-table" class="table table-hover table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Student ID</th>
                                                                            <th>Student Name</th>>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        // Fetched and processed the students in the PHP code
                                                                        $student_query = mysqli_query($link, "SELECT students.id, students.name
                                                                                                            FROM students 
                                                                                                            JOIN student_subjects ON students.id = student_subjects.studentId
                                                                                                            WHERE student_subjects.subjectId = '$selected_subject'");

                                                                        $cnt = 1;

                                                                        while ($student_row = mysqli_fetch_array($student_query)) {
                                                                           

                                                                            echo '<tr class="">
                                                                            <td>' . $cnt . '</td>
                                                                            <td>' . $student_row['id'] . '</td>
                                                                            <td>' . $student_row['name'] . '</td>
                                                                            
                                                                        </tr>';
                                                                    $cnt++; // Increment the counter
                                                                    
                                                                }
                                                                        ?>
                                                                    </tbody>
                                                                </table>

                                                            </form>
                                                             

                                                            </div>
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