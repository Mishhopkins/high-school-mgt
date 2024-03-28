<?php
// Include the database connection
include_once('../../service/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit(); // Add an exit statement after redirection
}

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name, id FROM students WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];
$studentId = $row['id'];

// Fetch all exam results for the logged-in student
$examResultsQuery = mysqli_query($link, "SELECT exam_schedule.*, subjects.subjectName, exam_marks.marks_obtained, exam_marks.grade, exam_marks.remarks
                                          FROM exam_schedule
                                          JOIN subjects ON exam_schedule.subjectid = subjects.id
                                          JOIN exam_marks ON exam_schedule.id = exam_marks.exam_id
                                          WHERE exam_marks.student_id = '$studentId'");

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
    <?php $page = "Gradebook";
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
                                    <li><a href="#">Gradebook</a></li>
                                    <li class="active">view Results</li>
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
                            <!-- Display exam results for the logged-in student -->
                                            <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Subject</th>
                                                        <th>Exam</th>
                                                        <th>Marks Obtained</th>
                                                        <th>Grade</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($examResultsQuery) {
                                                        $cnt = 1;
                                                        while ($resultRow = mysqli_fetch_assoc($examResultsQuery)) :
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $cnt; ?></td>
                                                                <td><?php echo $resultRow['subjectName']; ?></td>
                                                                <td><?php echo $resultRow['examName'] . " - " . $resultRow['examStatus']; ?></td>
                                                                <td><?php echo $resultRow['marks_obtained']; ?></td>
                                                                <td><?php echo $resultRow['grade']; ?></td>
                                                                <td><?php echo $resultRow['remarks']; ?></td>
                                                            </tr>
                                                    <?php
                                                            $cnt++;
                                                        endwhile;
                                                    } else {
                                                        echo "No results found.";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
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

