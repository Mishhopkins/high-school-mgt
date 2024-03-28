<?php
include_once('main.php');
include_once('../../service/dbconnection.php');
$sql = "SELECT * FROM payrolls;";
$res = mysqli_query($link, $sql);

$statusMsg = "";
$alertStyle = "";

if(isset($_GET['updatePayrollId'])){
    $_SESSION['updatePayrollId'] = $_GET['updatePayrollId'];
    $query = mysqli_query($link,"select * from payrolls where payrollno='$_SESSION[updatePayrollId]'");
    $rowi = mysqli_fetch_array($query);
} else {
    echo "<script type = \"text/javascript\"> window.location = ('viewpayroll.php') </script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $payrollno = $_POST['payrollno'];
    $teaId = $_POST['teacherId'];
    $teaName = $_POST['payname'];
    $teaEmail = $_POST['payemail'];
    $paysalary = $_POST['paysalary'];
    $pay_status = $_POST['paystatus'];
    $pay_descr = $_POST['pay_descr'];

    // Prepare the SQL statement for updating
    $sql = "UPDATE payrolls SET
            Teacher_id = ?,
            payname = ?,
            payemail = ?,
            paysalary = ?,
            paystatus = ?,
            pay_description = ?
            WHERE payrollno = ?";

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssss", $teaId, $teaName, $teaEmail, $paysalary, $pay_status, $pay_descr, $payrollno);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $statusMsg = "Payroll record updated successfully.";
            $alertStyle = "alert alert-success";
            // Redirect to viewpayroll.php after a successful update
            echo "<script type = 'text/javascript'> window.location = 'viewpayroll.php'; </script>";
        } else {
            $statusMsg = "Error updating payroll record: " . mysqli_error($link);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src = "JS/newTeacherValidation.js"></script>

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
                                    <li><a href="#">Manage payrolls</a></li>
                                    <li class="active">Update Payroll Record</li>
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
                                <strong class="card-title"><h2 align="center">Update Payroll</h2></strong>
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
                                                <input id="teaName" name="payname" type="text" class="form-control cc-exp" value="<?php echo $rowi['payname'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1"> Teacher Id</label>
                                                        <input id="teaId" name="teacherId" type="text" class="form-control cc-exp" value="<?php echo $rowi['Teacher_id'];?>"  Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                                    </div>
                                                </div>
                                       
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Teacher Email</label>
                                                <input id="teaEmail" name="payemail" type="text" class="form-control cc-exp" value="<?php echo $rowi['payemail'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                       
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Payroll NO.</label>
                                                <input id="payrollno" name="payrollno" type="text" class="form-control cc-exp" value="<?php echo $rowi['payrollno'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                            </div>
                                        </div>
                                    
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cc-exp" class="control-label mb-1">Teacher Salary (Kshs.)</label>
                                                <input id="paysalary" name="paysalary" type="text" class="form-control cc-exp" value="<?php echo $rowi['paysalary'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                        <div class="form-group">
                                            <label for="paystatus" class="control-label mb-1">Payroll Status</label>
                                            <select id="paystatus" name="paystatus" class="form-control">
                                               <option value="choose">Choose</option>
                                                <option value="Paid" <?php if ($rowi['paystatus'] === 'Paid') echo 'selected'; ?>>Paid</option>
                                                <option value="Unpaid" <?php if ($rowi['paystatus'] === 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                                                <option value="Pending" <?php if ($rowi['paystatus'] === 'Pending') echo 'selected'; ?>>Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div class="row">
                                             <div class="col-8">
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Payroll Description</label>
                                                        <textarea   type="text" class="form-control" name="pay_descr" id="editor"> <?php echo $rowi['pay_description'];?> </textarea>
                                                </div>

                                                <button type="submit" name="submit" class="btn btn-success">Update Payroll Record</button>
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
