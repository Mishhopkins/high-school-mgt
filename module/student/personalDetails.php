<?php
// Include the database connection
include_once('../../service/dbconnection.php');
//error_reporting(0)

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit(); // Add an exit statement after redirection
}

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT id, name, email, phone FROM students WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];
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
    <?php $page = "Myinfo";
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
                                    <li><a href="#">My Information</a></li>
                                    <li class="active"> Personal Info </li>
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
                        <strong class="card-title"><h2 align="center">Personal Info</h2></strong>
                    </div>
                    <div class="card-body">
                            <div class="card-box">
                                
                                <div class="container mt-3">
                                <ul class="nav nav-pills navtab-bg nav-justified nav-border 5px solid black">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#personal_info">Personal Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#parent_info">Parent Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#class_subjects">Class & Subjects</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#accommodation">Accommodation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#financial_info">Financial Info</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- Personal Info Tab -->
        <div class="tab-pane show active" id="personal_info">
            <!-- Personal Info Table -->
            <table class="table table-bordered table-hover">
                <tbody>
                    <?php
                    $sql = "SELECT * FROM students WHERE id='$check';";
                    $res = mysqli_query($link, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <tr>
                            <td colspan="2" class="text-center">
                                <img src="../images/<?php echo $row['file']; ?>" alt="<?php echo $check ?>" style="width: 100px; height: 100px; border-radius: 50%;">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Student's Name:</strong></td>
                            <td><?php echo $row['name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Student's Number:</strong></td>
                            <td><?php echo $row['id']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Student's Phone:</strong></td>
                            <td><?php echo $row['phone']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Student's Email:</strong></td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date Admitted:</strong></td>
                            <td><?php echo $row['addmissiondate']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td><?php echo $row['address']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Parent Info Tab -->
        <div class="tab-pane" id="parent_info">
            <!-- Parent Info Table -->
            <table class="table table-bordered table-hover">
                <tbody>
                    <?php
                    $studentId = mysqli_real_escape_string($link, $check);
                    $parentQuery = "SELECT parent_id FROM student_parent WHERE student_id = '$studentId'";
                    $parentResult = mysqli_query($link, $parentQuery);

                    if ($parentRow = mysqli_fetch_assoc($parentResult)) {
                        $parentId = $parentRow['parent_id'];

                        $parentDetailsQuery = "SELECT * FROM parents WHERE id = '$parentId'";
                        $parentDetailsResult = mysqli_query($link, $parentDetailsQuery);

                        if ($parentDetailsRow = mysqli_fetch_assoc($parentDetailsResult)) {
                    ?>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <strong>Parent Information</strong>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Parent's Name:</strong></td>
                                <td><?php echo $parentDetailsRow['fathername'] . ' ' . $parentDetailsRow['mothername']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Parent's Phone (Father):</strong></td>
                                <td><?php echo $parentDetailsRow['fatherphone']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Parent's Phone (Mother):</strong></td>
                                <td><?php echo $parentDetailsRow['motherphone']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td><?php echo $parentDetailsRow['address']; ?></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="2" class="text-danger text-center">
                                    <strong>Parent/Guardian information not available.</strong>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="2" class="text-danger text-center">
                                <strong>Parent ID not found for the student.</strong>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Class & Subjects Tab -->
        <div class="tab-pane" id="class_subjects">
            <!-- Class & Subjects Table -->
            <table class="table table-bordered table-hover">
                <tbody>
                    <?php
                    $classSubjectsQuery = "SELECT classes.class_name, session.sessionName
                                        FROM students
                                        INNER JOIN classes ON students.classid = classes.id
                                        INNER JOIN session ON students.sessionid = session.id
                                        WHERE students.id='$check';";

                    $classSubjectsResult = mysqli_query($link, $classSubjectsQuery);

                    if ($classSubjectsRow = mysqli_fetch_assoc($classSubjectsResult)) {
                    ?>
                        <tr>
                            <td colspan="2" class="text-center">
                                <strong>Class & Subjects Information</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Class:</strong></td>
                            <td><?php echo $classSubjectsRow['class_name']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Session:</strong></td>
                            <td><?php echo $classSubjectsRow['sessionName']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="text-dark mt-3 mb-2"><strong>Subjects:</strong></p>
                                <?php
                                $studentId = mysqli_real_escape_string($link, $check);
                                $subjectsQuery = "SELECT subjects.subjectName
                                                FROM student_subjects
                                                JOIN subjects ON student_subjects.subjectId = subjects.id
                                                WHERE student_subjects.studentId = '$studentId'";
                                $subjectsResult = mysqli_query($link, $subjectsQuery);

                                if (mysqli_num_rows($subjectsResult) > 0) {
                                    echo "<ul class='list-unstyled'>";
                                    while ($subjectRow = mysqli_fetch_assoc($subjectsResult)) {
                                        echo "<li>{$subjectRow['subjectName']}</li>";
                                    }
                                    echo "</ul>";
                                } else {
                                    echo "<p class='text-danger'>No subjects found for the student.</p>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="2" class="text-danger text-center">
                                <strong>Class and subjects information not available.</strong>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Accommodation Info Tab -->
        <div class="tab-pane" id="accommodation">
            <!-- Accommodation Info Table -->
            <table class="table table-bordered table-hover">
                <tbody>
                    <?php
                    $accommodationQuery1 = "SELECT hostels.hostels_name
                                        FROM students
                                        INNER JOIN hostels ON students.hostelid = hostels.id
                                        WHERE students.id = '$check'";

                    $accommodationResult1 = mysqli_query($link, $accommodationQuery1);

                    if ($accommodationRow1 = mysqli_fetch_assoc($accommodationResult1)) {
                    ?>
                        <tr>
                            <td colspan="2" class="text-center">
                                <strong>Accommodation Information</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Hostel Name:</strong></td>
                            <td><?php echo $accommodationRow1['hostels_name']; ?></td>
                        </tr>
                    <?php } ?>

                    <?php
                    // Query to get accommodation details
                    $accommodationQuery2 = "SELECT hostelrooms.room_no, beds.bed_no
                                            FROM beds 
                                            JOIN hostelrooms ON beds.room_id = hostelrooms.id
                                            WHERE beds.student_id = '$check'";

                    $accommodationResult2 = mysqli_query($link, $accommodationQuery2);
                    if ($accommodationRow2 = mysqli_fetch_assoc($accommodationResult2)) {
                    ?>
                        <tr>
                            <td><strong>Room NO:</strong></td>
                            <td><?php echo $accommodationRow2['room_no']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bed NO:</strong></td>
                            <td><?php echo $accommodationRow2['bed_no']; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="2" class="text-danger text-center">
                                <strong>Accommodation information not available.</strong>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Financial Info Tab -->
        <div class="tab-pane" id="financial_info">
            <!-- Financial Info Table -->
            <table class="table table-bordered table-hover">
                <tbody>
                    <?php
                    $financialQuery1 = "SELECT session.sessionName, payments.paid_amount, payments.balance, payments.status, payments.created_at
                                        FROM payments
                                        INNER JOIN session ON payments.session_id = session.id
                                        WHERE student_id = '$check'";

                    $financialResult1 = mysqli_query($link, $financialQuery1);

                    if ($financialRow1 = mysqli_fetch_assoc($financialResult1)) {
                    ?>
                        <tr>
                            <td colspan="2" class="text-center">
                                <strong>Financial Information</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Session ID:</strong></td>
                            <td><?php echo $financialRow1['sessionName']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fees:</strong></td>
                            <td><?php echo $financialRow1['paid_amount']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Balance:</strong></td>
                            <td><?php echo $financialRow1['balance']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fees Status:</strong></td>
                            <td><?php echo $financialRow1['status']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Payment Date:</strong></td>
                            <td><?php echo $financialRow1['created_at']; ?></td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="2" class="text-danger text-center">
                                <strong>Financial information not available.</strong>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


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

