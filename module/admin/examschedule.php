<?php
include_once('../../service/dbconnection.php');

// Check if the user is logged in
//session_start();
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit();
}

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name FROM admin WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];

$alertStyle = ""; // Initialize alert style
$statusMsg = ""; // Initialize status message

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate user input
    $subjectid = mysqli_real_escape_string($link, $_POST['subjectid']);
    $facilitatorId = mysqli_real_escape_string($link, $_POST['facilitatorId']);
    $formId = mysqli_real_escape_string($link, $_POST['formId']);
    $examName = mysqli_real_escape_string($link, $_POST['examName']);
    $examStatus = mysqli_real_escape_string($link, $_POST['examStatus']);
    $examDate = mysqli_real_escape_string($link, $_POST['examDate']);
    $examTime = mysqli_real_escape_string($link, $_POST['examTime']);

    // Insert the exam schedule into the database
    $query_insert_exam = "INSERT INTO exam_schedule (subjectid, facilitatorId, formId, examName, examStatus, examDate, examTime) 
                         VALUES ('$subjectid', '$facilitatorId','$formId', '$examName', '$examStatus', '$examDate', '$examTime')";

    if (mysqli_query($link, $query_insert_exam)) {
        // Exam schedule added successfully
        $alertStyle = "alert alert-success";
        $statusMsg = "Exam scheduled successfully.";
    } else {
        // Error occurred while adding the exam schedule
        $alertStyle = "alert alert-danger";
        $statusMsg = "Error: Unable to schedule exam.";
    }
}
?>

<?php
$sql = "SELECT * FROM exam_schedule";
$res = mysqli_query($link, $sql);

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
    <?php $page="department"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Admin</a></li>
                                    <li class="active">Manage exam </li>
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
                                <strong class="card-title"><h2 align="center">Add New Exam Schedule</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <form method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-4">
                                    <div class="form-group">
                                        <label for="subjectid" class="control-label mb-1">Subjects</label>
                                        <select required name="subjectid" class="custom-select form-control">
                                            <option value="">--Select subjects--</option>
                                            <?php
                                            $query = mysqli_query($link, "SELECT * FROM subjects ");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['subjectName'] . '</option>'; 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                        
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="facilitatorId" class="control-label mb-1">Select Facilitator:</label>
                                        <select required name="facilitatorId" class="custom-select form-control">
                                            <option value="">--Select Facilitator--</option>
                                            <?php
                                            $query = mysqli_query($link, "SELECT * FROM teachers ORDER BY name ASC");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="formId" class="control-label mb-1">Select Form:</label>
                                        <select required name="formId" class="custom-select form-control">
                                            <option value="">--Select Form--</option>
                                            <?php
                                            $query = mysqli_query($link, "SELECT * FROM forms");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['form'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                    
                     <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="examName" class="control-label mb-1">Exam Name</label>
                                <input type="text" id="examName" name="examName" required class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="examStatus" class="control-label mb-1">Exam Status:</label>
                                <select name="examStatus" id="examStatus" required class="custom-select form-control">
                                    <option value="Joint">Joint</option>
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                    <option value="Contest">Contest</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="examDate" class="control-label mb-1">Exam Date</label>
                                <input type="date" id="examDate" name="examDate" required class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="examTime" class="control-label mb-1">Exam Time:</label>
                                <input type="time" name="examTime" id="examTime" required class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-success">Schedule Exam</button>
                        </div>
                    </div>
                </form>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
               

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">All Exam Schedules</h2></strong>
                            </div>
                            <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Facilitator</th>
                                            <th>Form</th>
                                            <th>Exam Name</th>
                                            <th>Exam Status</th>
                                            <th>Exam Date</th>
                                            <th>Exam Time</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch exam schedules with subject and teacher names using SQL join
                                        $ret = mysqli_query($link, "SELECT exam_schedule.*, subjects.subjectName, teachers.name, forms.form
                                            FROM exam_schedule
                                            INNER JOIN forms ON exam_schedule.formId = forms.id
                                            INNER JOIN subjects ON exam_schedule.subjectid = subjects.id
                                            INNER JOIN teachers ON exam_schedule.facilitatorId = teachers.id");

                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $row['subjectName']; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['form']; ?></td>
                                                <td><?php echo $row['examName']; ?></td>
                                                <td><?php echo $row['examStatus']; ?></td>
                                                <td><?php echo $row['examDate']; ?></td>
                                                <td><?php echo $row['examTime']; ?></td>

                                                <td><a href="updateExamSchedule.php?updateScheduleId=<?php echo $row['id'];?>" class="badge badge-success">
                                                <i class="fa fa-edit fa-1x"></i>Update
                                                    </a>
                                                 <a onclick="return confirm('Are you sure you want to delete?')" href="deleteSchedule.php?delid=<?php echo $row['id'];?>" class="badge badge-danger">
                                                 <i class="fa fa-trash fa-1x"></i>Delete
                                                </a>
                                                
                                                </td>
                                                 </tr>
                                        <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                    </table>
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


    <script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );

      // Menu Trigger
      $('#menuToggle').on('click', function(event) {
            var windowWidth = $(window).width();   		 
            if (windowWidth<1010) { 
                $('body').removeClass('open'); 
                if (windowWidth<760){ 
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
