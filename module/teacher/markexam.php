<?php
include_once('main.php');
include_once('../../service/dbconnection.php');

$statusMsg = "";
$alertStyle = "";

if (isset($_GET['examId'])) {
    $_SESSION['examId'] = $_GET['examId'];

    // Fetch exam details, subject name, and teacher id
    $examQuery = mysqli_query($link, "SELECT exam_schedule.*, subjects.subjectName, teacher_subjects.teacher_id 
                                      FROM exam_schedule 
                                      JOIN subjects ON exam_schedule.subjectid = subjects.id
                                      JOIN teacher_subjects ON subjects.id = teacher_subjects.subject_id
                                      WHERE exam_schedule.id = '$_SESSION[examId]'");
    $examRow = mysqli_fetch_assoc($examQuery);

    if ($examRow) {
        $subjectId = $examRow['subjectid'];
        $teacherId = $examRow['teacher_id'];

        // Check if the teacher has already marked exams for this subject
        $markedExamsQuery = mysqli_query($link, "SELECT COUNT(*) AS count FROM exam_marks
                                                 WHERE exam_id = '$_SESSION[examId]' AND subject_id = '$subjectId'");
        $markedExamsRow = mysqli_fetch_assoc($markedExamsQuery);

        if ($markedExamsRow['count'] > 0) {
            // Redirect or display an error message
            echo "<script type = \"text/javascript\">
                  alert('You have already marked exams for this subject.');
                  window.location = (\"manageExams.php\");
                  </script>";
        } else {
            // Fetch students in the classes for marking for the specific exam
            $studentsQuery = "SELECT students.id, students.name 
                              FROM students 
                              WHERE students.classid IN (
                                  SELECT class_id
                                  FROM teacher_subjects
                                  WHERE subject_id = '$subjectId' AND teacher_id = '$teacherId'
                              )";
            $studentsResult = mysqli_query($link, $studentsQuery);
        }
    } else {
        // Handle the case where exam details are not found
        echo "<script type = \"text/javascript\">
              window.location = (\"manageExams.php\");
              </script>";
    }
} else {
    // Handle the case where exam id is not provided
    echo "<script type = \"text/javascript\">
          window.location = (\"manageExams.php\");
          </script>";
}
?>


<?php



// Function to get the grade based on marks
function getGrade($link, $marks) {
    $gradesQuery = mysqli_query($link, "SELECT grade FROM grades WHERE min_marks <= $marks AND max_marks >= $marks");
    $gradeRow = mysqli_fetch_assoc($gradesQuery);

    return ($gradeRow) ? $gradeRow['grade'] : 'N/A';
}

// Function to get remarks based on grade
function getRemarks($link, $grade) {
    $remarksQuery = mysqli_query($link, "SELECT remarks FROM grades WHERE grade = '$grade'");
    $remarksRow = mysqli_fetch_assoc($remarksQuery);

    return ($remarksRow) ? $remarksRow['remarks'] : 'N/A';
}

if (isset($_POST['submitMarks'])) {
    // Get exam details
    $examId = $_SESSION['examId'];

   
   // Loop through submitted marks
foreach ($_POST['marks'] as $index => $marks) {
    // The student ID is used as the array key, so update how you access it
    $studentId = $index;
    $subjectId = $_POST['subjectId'];

    // Validate marks if needed

    // Get the grade
    $grade = getGrade($link, $marks);

    // Get remarks based on grade
    $remarks = getRemarks($link, $grade);

    // Insert marks into the exam_marks table
    $insertQuery = "INSERT INTO exam_marks (student_id, exam_id, subject_id, marks_obtained, grade, remarks, created_at)
                    VALUES ('$studentId', '$examId', '$subjectId', '$marks', '$grade', '$remarks', NOW())";
    mysqli_query($link, $insertQuery);
}


    // You can redirect or display a success message if needed
    echo "<script type = \"text/javascript\">
              window.location = (\"manageExams.php\")
          </script>";
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
                                <li class="active">Mark exam </li>
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
                            <strong class="card-title"><h2 align="center">All Exam Schedules</h2></strong>
                        </div>
                        <div class="card-body">
                        <form action="#" method="post">
        <!-- Table to display students and allow entering marks -->
                            <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1; // Initialize $cnt before the while loop
                        while ($student = mysqli_fetch_assoc($studentsResult)) :
                        ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $student['name']; ?></td>
                                <td>
                                    <input type="hidden" name="studentIds[]" value="<?php echo $student['id']; ?>">
                                    <input type="hidden" name="subjectId" value="<?php echo $subjectId; ?>">
                                    <input type="text" name="marks[<?php echo $student['id']; ?>]" value="">
                                </td>
                            </tr>
                        <?php
                        $cnt++;
                        endwhile;
                        ?>
                        </tbody>
                    </table>


                    <div class="row justify-content-center">
                    <div class="col-4">
                        <button type="submit" name="submitMarks" class="btn btn-success btn-block">Submit Marks</button>
                    </div>
                </div>

    </form>
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

