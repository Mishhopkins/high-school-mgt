<?php
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



    if (isset($_POST['submit'])) {
        $pagetitle = $_POST['pagetitle'];
        $pagedes = $_POST['pagedes'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $mission = $_POST['mission'];
        $town = $_POST['town'];
        $street = $_POST['street'];
        $mobnumber = $_POST['mobnumber'];
        $timing = $_POST['timing'];

        $query = mysqli_query($link, "UPDATE tblpage SET PageTitle='$pagetitle', Email='$email', MobileNumber='$mobnumber', address='$address', street='$street', town='$town', PageDescription='$pagedes', mission= '$mission', Timing= '$timing' WHERE PageType='contactus'");
        if ($query) {
            $alertStyle ="alert alert-success";
            $statusMsg="Contact Us Page Updated Successfully!";
    }
}
?>
<!DOCTYPE HTML>
<html>

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
    <script src = "JS/currentDate.js"></script>
        <script src = "JS/newStudentValidation.js"></script>

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
    <?php $page="pages"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="contact_us.php">Dashboard</a></li>
                                    <li><a href="#">Pages</a></li>
                                    <li class="active">Contact Us</li>
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
                                <strong class="card-title"><h2 align="center">Edit Contact Us</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <div class="card-body">
                                            <form method="POST" action="" enctype="multipart/form-data">
                                            <?php
                                        
                                        $ret=mysqli_query($link,"select * from  tblpage where PageType='contactus'");
                                        $cnt=1;
                                        while ($row=mysqli_fetch_array($ret)) {
                                        
                                        ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="pagetitle" class="control-label mb-1">Page Title:</label>
                                                        <input type="text" id="pagetitle" name="pagetitle" required class="form-control" value="<?php echo $row['PageTitle']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group">
                                                        <label for="email" class="control-label mb-1">Email:</label>
                                                        <input type="text" id="email" name="email" required class="form-control" value="<?php echo $row['Email']; ?>">
                                                    </div>
                                                </div>
                                            <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="mobnumber" class="control-label mb-1">Telephone No.:</label>
                                                        <input type="text" id="mobnumber" name="mobnumber" required class="form-control" value="<?php echo $row['MobileNumber']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="address" class="control-label mb-1">Address:</label>
                                                        <input type="text" id="address" name="address" required class="form-control" value="<?php echo $row['address']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                <div class="form-group">
                                                        <label for="street" class="control-label mb-1">Street</label>
                                                        <input type="text" id="street" name="street" required class="form-control" value="<?php echo $row['street']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="town" class="control-label mb-1">Town/city:</label>
                                                        <input type="text" id="town" name="town" required class="form-control" value="<?php echo $row['town']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="timing" class="control-label mb-1">Timing:</label>
                                                        <input type="text" id="timing" name="timing" required class="form-control" value="<?php echo $row['Timing']; ?>">
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="pagedes" class="control-label mb-1">Page Description</label>
                                                        <textarea name="pagedes" id="pagedes" rows="5" class="form-control"><?php  echo $row['PageDescription'];?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                <div class="form-group">
                                                        <label for="mission" class="control-label mb-1">Mission</label>
                                                        <textarea name="mission" id="mission" rows="5" class="form-control"><?php  echo $row['mission'];?></textarea> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="submit" class="btn btn-success">Update Page</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->
               

                <br><br>
                   
<!-- end of datatable -->

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


