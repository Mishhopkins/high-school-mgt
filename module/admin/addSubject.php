<?php

// error_reporting(0);
// Start or resume the session
//session_start();

$statusMsg = "";
$alertStyle = "";


// Include the database connection
include_once('../../service/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit(); // Add an exit statement after redirection
}

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name FROM admin WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];

?>

<?php
// Check if the form is submitted

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize and validate user input
        $subjectName = mysqli_real_escape_string($link, $_POST['subjectName']);
        $department_id = mysqli_real_escape_string($link, $_POST['department_id']);
        $subject_code = mysqli_real_escape_string($link, $_POST['subject_code']);
        $isDefault = mysqli_real_escape_string($link, $_POST['isDefault']); // Get the value from the select Dropdown

    $subjectNameUpper = strtoupper($subjectName);

    // Check if the subject with the same name and department already exists in the database
    $query_check_subject = mysqli_query($link, "SELECT * FROM subjects WHERE UPPER(subjectName)='$subjectNameUpper' AND department_id='$department_id'");
    $count_subject = mysqli_num_rows($query_check_subject);

    if ($count_subject > 0) {
        // Subject with the same name and department already exists, show an error message
        $alertStyle = 'alert alert-danger';
        $statusMsg = 'Subject with the same name and department already exists.';
    } else {
        // Subject is unique, insert the subject into the database
        $query_insert_subject = "INSERT INTO subjects (subjectName, department_id, subject_code, is_default) VALUES ('$subjectNameUpper', '$department_id', '$subject_code', '$isDefault')";

        if (mysqli_query($link, $query_insert_subject)) {
            // Subject added successfully
            $alertStyle = 'alert alert-success';
            $statusMsg = 'Subject added successfully.';
        } else {
            // Error occurred while adding the subject
            $alertStyle = 'alert alert-danger';
            $statusMsg = 'Error: Unable to add subject.';
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
    <?php $page="subject"; include 'includes/leftMenu.php';?>

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
			
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Admin</a></li>
                                    <li class="active">Add Subject</li>
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
                                <strong class="card-title"><h2 align="center">Add New Subject</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="subject_code" class="control-label mb-1">Subject Name</label>
                                                <input type="text" id="subject_name" name="subjectName" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                                <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Department</label>
                                                    <?php 
                                                    $query = mysqli_query($link, "SELECT * FROM departments ORDER BY department_name ASC");                        
                                                    $count = mysqli_num_rows($query);
                                                    if ($count > 0) {                       
                                                        echo '<select required name="department_id" onchange="showValues(this.value)" class="custom-select form-control">';
                                                        echo '<option value="">--Select Department--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                            echo '<option value="'.$row['department_id'].'">'.$row['department_name'].'</option>';
                                                        }
                                                            echo '</select>';
                                                }
                                                    ?>                                                     
                                                </div>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="subject_code" class="control-label mb-1">Subject Code</label>
                                                <input type="text" id="subject_code" name="subject_code" required class="form-control">
                                            </div>
                                        </div>

                                    <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="isDefault">Set subject as :</label>
                                                        <select name="isDefault" class="form-control">
                                                            <option value="1">Default</option>
                                                            <option value="0">Optional</option>
                                                        </select>
                                                    </div>
                                                      
                                          </div>
                        
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn btn-success">Add New Subject</button>
                                        </div>
                                    </div>
                                </form>

                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
               


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
