<?php
include_once('main.php');
include_once('../../service/dbconnection.php');
$sql = "SELECT * FROM students;";
$res = mysqli_query($link, $sql);

$statusMsg = "";
$alertStyle = "";
  

if(isset($_GET['updateStudentId'])){

$_SESSION['updateStudentId'] = $_GET['updateStudentId'];

$query = mysqli_query($link,"select * from students where id='$_SESSION[updateStudentId]'");
$rowi = mysqli_fetch_array($query);

$query1 = mysqli_query($link,"select * from student_parent where id='$_SESSION[updateStudentId]'");
$roww = mysqli_fetch_array($query);

}
else{

echo "<script type = \"text/javascript\">
    window.location = (\"AddStudent.php\")
    </script>"; 
}

?>

<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate user input
    $stuId = mysqli_real_escape_string($link, $_POST['studentId']);
    $stuName = mysqli_real_escape_string($link, $_POST['studentName']);
    $stuPassword = mysqli_real_escape_string($link, $_POST['studentPassword']);
    $stuPhone = mysqli_real_escape_string($link, $_POST['studentPhone']);
    $stuEmail = mysqli_real_escape_string($link, $_POST['studentEmail']);
    $stugender = mysqli_real_escape_string($link, $_POST['gender']);
    $stuDOB = mysqli_real_escape_string($link, $_POST['studentDOB']);
    $stuAddmissionDate = mysqli_real_escape_string($link, $_POST['studentAddmissionDate']);
    $stuAddress = mysqli_real_escape_string($link, $_POST['studentAddress']);
    $hostel_id = mysqli_real_escape_string($link, $_POST['hostel_id']);
    $session_id = mysqli_real_escape_string($link, $_POST['session_id']);
    $class_id = mysqli_real_escape_string($link, $_POST['class_id']);

    // Check if the file upload field is set and not empty
    if (isset($_FILES["file"]) && !empty($_FILES["file"]["name"])) {
        $finame = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($finame, PATHINFO_EXTENSION));
        $filename = "student" . $stuId . "pic." . $imageFileType;
        $folder = "../images/" . $filename;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($tempname, $folder)) {
            // Insert data into students table
            $sql = "UPDATE students SET file='$filename', id='$stuId', name='$stuName', password='$stuPassword', phone='$stuPhone', email='$stuEmail', sex='$stugender', dob='$stuDOB', addmissiondate='$stuAddmissionDate', address='$stuAddress', classid='$class_id', hostelid='$hostel_id', sessionid='$session_id' WHERE id='$stuId'";
            $success = mysqli_query($link, $sql);

            // Check if the student was inserted successfully
            if ($success) {
                // update data into users table
                $sql = "UPDATE users SET password='$stuPassword', usertype='student' WHERE userid='$stuId'";
                $success = mysqli_query($link, $sql);


                    echo "<script type = \"text/javascript\">
                    window.location = (\"viewStudent.php\")
                    </script>"; 

                    $alertStyle = "alert alert-success";
                    $statusMsg = "Student Updated Successfully!";
                
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred while upadating the student to the students table.";
            }
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Failed to upload the student's picture.";
        }
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Please select a picture for the student.";
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

<body onload="generateUPI()">

    <!-- Left Panel -->
    <?php $page="student"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Manage Student</a></li>
                                    <li class="active">Edit Student</li>
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
                                <strong class="card-title"><h2 align="center">Update Student</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                       <form action="#" method="post"onsubmit="return newStudentValidation();" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
													
                                                        <label for="cc-exp" class="control-label mb-1">Full Name</label>  
                                                        <input id="stuName" name="studentName" type="text" class="form-control cc-exp" value="<?php echo $rowi['name'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Name">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1"> Student UPI No</label>
                                                        <input id="stuId" name="studentId" type="text" class="form-control cc-exp" value="<?php echo $rowi['id'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter UPI No.">
                                                    </div>
                                                </div>
                                                </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Student Password</label>
                                                        <input id="stuPassword" name="studentPassword" type="text" class="form-control cc-exp" value="<?php echo $rowi['password'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                
                                           
                                                <div class="col-6">
                                                    <div class="form-group">
                                            
                                                        <label for="cc-exp" class="control-label mb-1">Student Phone:</label>
                                                        <input id="stuPhone" name="studentPhone" type="text" class="form-control cc-exp" value="<?php echo $rowi['phone'];?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Phone Number">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Student Email:</label>
                                                        <input id="stuEmail" name="studentEmail" type="text" class="form-control cc-exp" value="<?php echo $rowi['email'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                
                                          
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Gender:</label>  <BR>
                                                        <input type="radio" name="gender" value="Male" onclick="stuGender = this.value;"> Male <input type="radio" name="gender" value="Female" onclick="this.value"> Female 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Student DOB:</label>
                                                        <input id="stuDOB" name="studentDOB" type="date" class="form-control cc-exp" value="<?php echo $rowi['dob'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter DOB">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                            
                                                        <label for="cc-exp" class="control-label mb-1">Student Addmission Date:</label> <BR>
                                                        <input id="stuAddmissionDate"name="studentAddmissionDate"value = "<?php echo date('Y-m-d');?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Student Address:</label>
                                                        <input id="stuAddress" name="studentAddress" type="text" class="form-control cc-exp" value="<?php echo $rowi['address'];?>" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Enter Address">
                                                    </div>
                                                </div>

                                                
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Student Class :</label>
                                                        <?php 
                                        $query=mysqli_query($link,"select * from classes ORDER BY class_name ASC");                        
                                        $count = mysqli_num_rows($query);
                                        if($count > 0){                       
                                            echo ' <select required name="class_id" class="custom-select form-control">';
                                            echo'<option value="">--Select Class--</option>';
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo'<option value="'.$row['id'].'" >'.$row['class_name'].'</option>';
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

                                                        <label for="cc-exp" class="control-label mb-1">Student Picture:</label>
                                                        <input id="file" name="file" type="file" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="CHOOSE PHOTO">
                                                    </div>
                                                </div>
                                            
                                                <div class="col-6">
                                                    <div class="form-group">
                                                    <label for="x_card_code" class="control-label mb-1">Hostel</label>
                                                    <?php 
                                                    $query=mysqli_query($link,"select * from hostels ORDER BY hostels_name ASC");                        
                                                    $count = mysqli_num_rows($query);
                                                    if($count > 0){                       
                                                        echo ' <select required name="hostel_id" onchange="showValues(this.value)" class="custom-select form-control">';
                                                        echo'<option value="">--Select Hostel--</option>';
                                                        while ($row = mysqli_fetch_array($query)) {
                                                        echo'<option value="'.$row['id'].'" >'.$row['hostels_name'].'</option>';
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
                                                                         
                                                 </div>

                                                <button type="submit" name="submit" class="btn btn-success">Update Student</button>
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
