<?php
include_once('main.php');
include_once('../../service/dbconnection.php');
$sql = "SELECT * FROM parents;";
$res = mysqli_query($link, $sql);

  

if(isset($_GET['updateParentId'])){

$_SESSION['updateParentId'] = $_GET['updateParentId'];

$query = mysqli_query($link,"select * from parents where id='$_SESSION[updateParentId]'");
$rowi = mysqli_fetch_array($query);

}
else{

echo "<script type = \"text/javascript\">
    window.location = (\"addParent.php\")
    </script>"; 
}

?>

<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate user input
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $fathername = mysqli_real_escape_string($link, $_POST['fathername']);
    $mothername = mysqli_real_escape_string($link, $_POST['mothername']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $fatherphone = mysqli_real_escape_string($link, $_POST['fatherphone']);
    $motherphone = mysqli_real_escape_string($link, $_POST['motherphone']);
    $address = mysqli_real_escape_string($link, $_POST['address']);

            // update data into teachers table
            $sql = "UPDATE parents SET id='$id', fathername='$fathername', mothername='$mothername', password='$password', fatherphone='$fatherphone', motherphone='$motherphone', address='$address' WHERE id='$id'";
            $success = mysqli_query($link, $sql);

            // Check if the teacher was inserted successfully
            if ($success) {
                // update data into users table
                $sql = "UPDATE users SET password='$password', usertype='parent' WHERE userid='$id'";
                $success = mysqli_query($link, $sql);


                    echo "<script type = \"text/javascript\">
                    window.location = (\"viewParent.php\")
                    </script>"; 

                    $alertStyle = "alert alert-success";
                    $statusMsg = "parent Updated Successfully!";
                
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred while upadating the parent to the parents table.";
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
    <?php $page="parent"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Manage Parents</a></li>
                                    <li class="active">Edit Parent</li>
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
                                <strong class="card-title"><h2 align="center">Update parent</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <form action="#" method="post"onsubmit="return newParentValidation();" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
													
                                                        <label for="cc-exp" class="control-label mb-1">Parent Id</label>  
                                                        <input id="id" name="id" type="text" class="form-control cc-exp" value="<?php echo $rowi['id'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter ID">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1"> Parent Password</label>
                                                        <input id="password" name="password" type="text" class="form-control cc-exp" value="<?php echo $rowi['password'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Father's Name </label>
                                                        <input id="fathername" name="fathername" type="text" class="form-control cc-exp" value="<?php echo $rowi['fathername'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Father's Name">
                                                    </div>
                                                </div>
                                                
                                           
                                                <div class="col-6">
                                                    <div class="form-group">
                                            
                                                        <label for="cc-exp" class="control-label mb-1">Mother's Name:</label>
                                                        <input id="mothername" name="mothername" type="text" class="form-control cc-exp" value="<?php echo $rowi['mothername'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Mother's Name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Father's Phone:</label>
                                                        <input id="fatherphone" name="fatherphone" type="text" class="form-control cc-exp" value="<?php echo $rowi['fatherphone'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Father's Phone">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Mother's Phone:</label>
                                                        <input id="motherphone" name="motherphone" type="text" class="form-control cc-exp" value="<?php echo $rowi['motherphone'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Mother's Phone">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Parent's Address:</label>
                                                        <input id="address" name="address" type="text" class="form-control cc-exp" value="<?php echo $rowi['address'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Address">
                                                    </div>
                                                </div>

                                            </div>

                                                <button type="submit" name="submit" class="btn btn-success">Update Parent</button>
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
