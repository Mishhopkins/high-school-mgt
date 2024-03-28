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

// Check if the form is submitted
if (isset($_POST['viewResults'])) {
    // Get the selected subject and class from the dropdown
    $selectedSubjectClass = explode('-', $_POST['teacher_subject']);
    $selectedSubjectId = $selectedSubjectClass[0];
    $selectedClassId = $selectedSubjectClass[1];

    // Get the selected exam from the dropdown
    $selectedExamId = $_POST['examSelect'];

    // Fetch the exam details
    $examQuery = mysqli_query($link, "SELECT exam_schedule.*, subjects.subjectName 
                                      FROM exam_schedule 
                                      JOIN subjects ON exam_schedule.subjectid = subjects.id
                                      WHERE exam_schedule.id = '$selectedExamId'");
    $examRow = mysqli_fetch_assoc($examQuery);

    // Check if the exam details are found
    if ($examRow) {
        $subjectId = $examRow['subjectid'];

        // Get students and their marks for the specific exam, subject, and class
        $marksQuery = mysqli_query($link, "SELECT students.name, exam_marks.marks_obtained, exam_marks.grade, exam_marks.remarks
                                           FROM exam_marks
                                           JOIN students ON exam_marks.student_id = students.id
                                           WHERE exam_marks.exam_id = '$selectedExamId' AND exam_marks.subject_id = '$subjectId' AND students.classid = '$selectedClassId'");

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
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
<?php $page="exams"; include 'includes/leftMenu.php';?>

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
                                <li><a href="#">Teacher</a></li>
                                <li class="active">View Results </li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title"><h2 align="center">View Results</h2></strong>
                        </div>
                        <div class="card-body">
                        <form action="#" method="post">
                                <div class="row">
                                    <!-- Dropdown for Subject and Class -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="teacher_subject" class="control-label mb-1">Select Subject and Class:</label>
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

                                    <!-- Dropdown for Exam Selection -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="examSelect" class="control-label mb-1">Select Exam:</label>
                                            <select name="examSelect" id="examSelect">
                                                <?php
                                                // Fetch available exams with both name and status
                                                $examsQuery = mysqli_query($link, "SELECT id, CONCAT(examName, ' - ', examStatus) AS examDetails FROM exam_schedule");

                                                while ($examOption = mysqli_fetch_assoc($examsQuery)) :
                                                ?>
                                                    <option value="<?php echo $examOption['id']; ?>"><?php echo $examOption['examDetails']; ?></option>
                                                <?php
                                                endwhile;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Results Button -->
                                <div class="form-group">
                                    <button type="submit" name="viewResults" class="btn btn-primary">View Results</button>
                                </div>
                            </form>

                        <!-- Display exam results based on the selected subject, class, and exam -->
<?php
if (isset($_POST['viewResults'])) {
    // Get the selected subject and class from the dropdown
    $selectedSubjectClass = explode('-', $_POST['teacher_subject']);
    $selectedSubjectId = $selectedSubjectClass[0];
    $selectedClassId = $selectedSubjectClass[1];

    // Get the selected exam from the dropdown
    $selectedExamId = $_POST['examSelect'];

    // Fetch the exam details
    $examQuery = mysqli_query($link, "SELECT exam_schedule.*, subjects.subjectName 
                                      FROM exam_schedule 
                                      JOIN subjects ON exam_schedule.subjectid = subjects.id
                                      WHERE exam_schedule.id = '$selectedExamId'");
    $examRow = mysqli_fetch_assoc($examQuery);

    // Check if the exam details are found
    if ($examRow) {
        $subjectId = $examRow['subjectid'];

        // Get students and their marks for the specific exam, subject, and class
        $marksQuery = mysqli_query($link, "SELECT students.name, exam_marks.marks_obtained, exam_marks.grade, exam_marks.remarks
                                           FROM exam_marks
                                           JOIN students ON exam_marks.student_id = students.id
                                           WHERE exam_marks.exam_id = '$selectedExamId' AND exam_marks.subject_id = '$subjectId' AND students.classid = '$selectedClassId'");
?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"><h2 align="center">Exam Results</h2></strong>
                    </div>
                    <div class="card-body text-center">
                        <!-- Display exam details -->
                        <h3>Subject: <?php echo $examRow['subjectName']; ?></h3>
                        <!-- Display the selected exam -->
                        <h3>Exam: <?php echo $examRow['examName']; ?> - Status: <?php echo $examRow['examStatus']; ?></h3>
                    </div>

                       <!-- Display the results in a table -->
                <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Marks Obtained</th>
                            <th>Grade</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cnt = 1;
                        while ($marksRow = mysqli_fetch_assoc($marksQuery)) :
                        ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $marksRow['name']; ?></td>
                                <td><?php echo $marksRow['marks_obtained']; ?></td>
                                <td><?php echo $marksRow['grade']; ?></td>
                                <td><?php echo $marksRow['remarks']; ?></td>
                            </tr>
                        <?php
                            $cnt++;
                        endwhile;
                        ?>
                    </tbody>
                </table>
<?php
    } else {
        echo "Exam details not found.";
    }
}

?>
</div>
   </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>

<?php include 'includes/footer.php';?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="../../assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>

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

