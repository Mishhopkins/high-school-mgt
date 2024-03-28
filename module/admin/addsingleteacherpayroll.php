<?php
// Start or resume the session
// session_start();

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
$session = mysqli_query($link, "SELECT name FROM admin WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];

// Initialize variables for teacher data
$teacherName = $teacherId = $teacherEmail = $teacherPhone = $teacherSalary = "";

// Check if the teacher ID is provided via GET or POST
if (isset($_GET['addPayrollId'])) {
    $_SESSION['addPayrollId'] = $_GET['addPayrollId'];
    $query = mysqli_query($link, "SELECT * FROM teachers WHERE id='$_SESSION[addPayrollId]'");
    $rowi = mysqli_fetch_array($query);

    // Populate teacher data
    $teacherName = $rowi['name'];
    $teacherId = $rowi['id'];
    $teacherEmail = $rowi['email'];
    $teacherPhone = $rowi['phone'];
    $teacherSalary = $rowi['salary'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $pay_no = $_POST['pay_number'];
    $pay_descr = $_POST['pay_descr'];

    // Prepare the SQL statement
    $sql = "INSERT INTO payrolls (payrollno, Teacher_id, payname, payemail, payphone, paysalary, pay_description) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $pay_no, $teacherId, $teacherName, $teacherEmail, $teacherPhone, $teacherSalary, $pay_descr);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $statusMsg = "Payroll record added successfully.";
            $alertStyle = "alert alert-success";
        } else {
            $statusMsg = "Error adding payroll record: " . mysqli_error($link);
            $alertStyle = "alert alert-danger";
        }
    } else {
        $statusMsg = "Error preparing SQL statement: " . mysqli_error($link);
        $alertStyle = "alert alert-danger";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
</head>

<body onload="generateID()">

    <!-- Left Panel -->
    <?php $page="result"; include 'includes/leftMenu.php';?>

   <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
            <?php include 'includes/header.php';?>
        <!-- /header -->
        <!-- Header-->

        <?php

                    $sql = "SELECT * FROM teachers;";
                    $res = mysqli_query($link, $sql);

                    

                    if(isset($_GET['addPayrollId'])){

                    $_SESSION['addPayrollId'] = $_GET['addPayrollId'];

                    $query = mysqli_query($link,"select * from teachers where id='$_SESSION[addPayrollId]'");
                    $rowi = mysqli_fetch_array($query);

}
                
            ?>

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
								<!-- Log on to codeastro.com for more projects! -->
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li><a href="#">Manage Payrolls</a></li>
                                    <li class="active">Add Payroll Record</li>
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
                                <strong class="card-title"><h2 align="center">Add Payrolls</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <form action="#" method="post" enctype="multipart/form-data">


                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
													
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Name</label>  
                                                        <input id="text" disabled name="teacherName" type="text" class="form-control cc-exp" value="<?php echo $rowi['name'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Name">
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1"> Teacher Id</label>
                                                        <input id="text"  disabled name="teacherId" type="text" class="form-control cc-exp" value="<?php echo $rowi['id'];?>"  Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Id">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-4">
                                                    <div class="form-group">
                                            
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Phone:</label>
                                                        <input id="text" disabled name="teacherPhone" type="text" class="form-control cc-exp" value="<?php echo $rowi['phone'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Phone Number">
                                                    </div>
                                                </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Email:</label>
                                                        <input id="text" disabled name="teacherEmail" type="text" class="form-control cc-exp" value="<?php echo $rowi['email'];?>"data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                                                    </div>
                                                </div>

                                                     <div class="col-4">
                                                    <div class="form-group">

                                                        <label for="cc-exp" class="control-label mb-1">Teacher Salary:</label>
                                                        <input id="text" disabled name="teacherSalary" type="text" class="form-control cc-exp" value="<?php echo $rowi['salary'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Salary">
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                    <form action="#" method="post"  enctype="multipart/form-data">
                                        
                                       <div class="row">
                                                <div class="col-4">

                                            <div class="form-group col-md-2" style="display:none">
                                                    <?php 
                                                            $length = 5;    
                                                            $pay_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                        ?>
                                                        <label for="inputZip" class="col-form-label">Payroll Record Number</label>
                                                        <input type="text" name="pay_number" value="<?php echo $pay_no;?>" class="form-control" id="inputZip">
                                                    </div>
                                                </div>
                                             </div>
                                            <div class="row">
                                             <div class="col-8">
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Payroll Description</label>
                                                        <textarea   type="text" class="form-control" name="pay_descr" id="editor"> </textarea>
                                                </div>

                                                <button type="submit" name="add_payroll" class="btn btn-success">Add Payroll Record</button>

                                            </form>
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
