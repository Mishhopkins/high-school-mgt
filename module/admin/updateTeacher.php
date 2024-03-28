<?php
include_once('main.php');
include_once('../../service/dbconnection.php');
$sql = "SELECT * FROM teachers;";
$res = mysqli_query($link, $sql);

  

if(isset($_GET['updateTeacherId'])){

$_SESSION['updateTeacherId'] = $_GET['updateTeacherId'];

$query = mysqli_query($link,"select * from teachers where id='$_SESSION[updateTeacherId]'");
$rowi = mysqli_fetch_array($query);

}
else{

echo "<script type = \"text/javascript\">
    window.location = (\"addTeacher.php\")
    </script>"; 
}

?>

<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate user input
    $department_id = mysqli_real_escape_string($link, $_POST['department_id']);
    $teaId = mysqli_real_escape_string($link, $_POST['teacherId']);
    $teaName = mysqli_real_escape_string($link, $_POST['teacherName']);
    $teaPassword = mysqli_real_escape_string($link, $_POST['teacherPassword']);
    $teaPhone = mysqli_real_escape_string($link, $_POST['teacherPhone']);
    $teaEmail = mysqli_real_escape_string($link, $_POST['teacherEmail']);
    $teaGender = mysqli_real_escape_string($link, $_POST['gender']);
    $teaDOB = mysqli_real_escape_string($link, $_POST['teacherDOB']);
    $teaHireDate = mysqli_real_escape_string($link, $_POST['teacherHireDate']);
    $teaAddress = mysqli_real_escape_string($link, $_POST['teacherAddress']);
    $teaSalary = mysqli_real_escape_string($link, $_POST['teacherSalary']);
    $session_id = mysqli_real_escape_string($link, $_POST['session_id']);

    // Check if the file upload field is set and not empty
    if (isset($_FILES["file"]) && !empty($_FILES["file"]["name"])) {
        $finame = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($finame, PATHINFO_EXTENSION));
        $filename = "teacher-" . $teaId . "pic." . $imageFileType;
        $folder = "../images/" . $filename;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($tempname, $folder)) {
            // update data into teachers table
            $sql = "UPDATE teachers SET department = '$department_id', file='$filename', id='$teaId', name='$teaName', password='$teaPassword', phone='$teaPhone', email='$teaEmail', sex='$teaGender', dob='$teaDOB', hiredate='$teaHireDate', address='$teaAddress', salary='$teaSalary', sessionid='$session_id' WHERE id='$teaId'";
            $success = mysqli_query($link, $sql);

            // Check if the teacher was inserted successfully
            if ($success) {
                // update data into users table
                $sql = "UPDATE users SET password='$teaPassword', usertype='teacher' WHERE userid='$teaId'";
                $success = mysqli_query($link, $sql);


                    echo "<script type = \"text/javascript\">
                    window.location = (\"viewTeacher.php\")
                    </script>"; 

                    $alertStyle = "alert alert-success";
                    $statusMsg = "Teacher Updated Successfully!";
                
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred while upadating the teacher to the teachers table.";
            }
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Failed to upload the teacher's picture.";
        }
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Please select a picture for the teacher.";
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
<script src = "JS/newTeacherValidation.js""></script>

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
    <?php $page="teacher"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Manage Teachers</a></li>
                                    <li class="active">Edit Teacher</li>
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
                                <strong class="card-title"><h2 align="center">Update Teacher</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <form action="#" method="post"onsubmit="return newTeacherValidation();" enctype="multipart/form-data">

                                       <div class="row">
                                       <div class="col-6">
                                            <div class="form-group">
                                                <label for="x_card_code" class="control-label mb-1">Department</label>
                                                <?php 
                                                $query = mysqli_query($link, "SELECT * FROM departments ORDER BY department_name ASC");                        
                                                $count = mysqli_num_rows($query);
                                                if ($count > 0) {                       
                                                    echo '<select required name="department_id" class="custom-select form-control">';
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        $selected = ($row['department_id'] == $row_subject['department_id']) ? 'selected' : '';
                                                        echo '<option value="'.$row['department_id'].'" '.$selected.'>'.$row['department_name'].'</option>';
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
													
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Name</label>  
                                                        <input id="teaName" name="teacherName" type="text" class="form-control cc-exp" value="<?php echo $rowi['name'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Name">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1"> Teacher Id</label>
                                                        <input id="teaId" name="teacherId" type="text" class="form-control cc-exp" value="<?php echo $rowi['id'];?>"  Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Id">
                                                    </div>
                                                </div>
                                                </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Password</label>
                                                        <input id="teaPassword" name="teacherPassword" type="text" class="form-control cc-exp" value="<?php echo $rowi['password'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                
                                           
                                                <div class="col-6">
                                                    <div class="form-group">
                                            
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Phone:</label>
                                                        <input id="teaPhone" name="teacherPhone" type="text" class="form-control cc-exp" value="<?php echo $rowi['phone'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Phone Number">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Email:</label>
                                                        <input id="teaEmail" name="teacherEmail" type="text" class="form-control cc-exp" value="<?php echo $rowi['email'];?>"data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                
                                          
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Gender:</label>  <BR>
                                                        <input type="radio" name="gender" value="Male" onclick="teaGender = this.value;"> Male <input type="radio" name="gender" value="Female" onclick="this.value"> Female 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher DOB:</label>
                                                        <input id="teaDOB" name="teacherDOB" type="date" class="form-control cc-exp" value="<?php echo $rowi['dob'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter DOB">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                            
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Hire Date:</label> <BR>
                                                        <input id="teaHireDate"name="teacherHireDate"value = "<?php echo date('Y-m-d');?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Teacher Address:</label>
                                                        <input id="teaAddress" name="teacherAddress" type="text" class="form-control cc-exp" value="<?php echo $rowi['address'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Address">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">

                                                        <label for="cc-exp" class="control-label mb-1">Teacher Salary:</label>
                                                        <input id="teaSalary" name="teacherSalary" type="text" class="form-control cc-exp" value="<?php echo $rowi['salary'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Salary">
                                                    </div>
                                                </div>
                                             </div>

                                             <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">

                                                        <label for="cc-exp" class="control-label mb-1">Teacher Picture:</label>
                                                        <input id="file" name="file" type="file" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="CHOOSE PHOTO">
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="col-6">
                                                <div class="form-group">
                                                     <label for="x_card_code" class="control-label mb-1">Session</label>
                                                    <?php 
                                                    $query=mysqli_query($link,"select * from session where status = 1");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required name="session_id" class="custom-select form-control">';
                                                        echo'<option value="">--Select Session--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'.$row['id'].'" >'.$row['sessionName'].'</option>';
                                                            }
                                                                echo '</select>';
                                                            }
                                                ?>   
                                                </div>
                                            </div>
                                                                         
                                                 </div>

                                                <button type="submit" name="submit" class="btn btn-success">Update Teacher</button>
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
