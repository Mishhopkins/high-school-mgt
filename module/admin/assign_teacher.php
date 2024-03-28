<?php
// Start or resume the session
//session_start();
//error_reporting (0);

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
$login_session = $loged_user_name = isset($row['name']) ? $row['name'] : 'Default Name';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the data sent from JavaScript
    $teacherId = mysqli_real_escape_string($link, $_POST['selectTeacher']);
    
    // Check if the arrays are set and not null
    $assignedSubjects = isset($_POST['teacherSubjects']) ? $_POST['teacherSubjects'] : [];
    $assignedClasses = isset($_POST['teacherClasses']) ? $_POST['teacherClasses'] : [];

    // // Remove any existing assignments for this teacher
    // $deleteSubjectsSql = "DELETE FROM teacher_subjects WHERE teacher_id = '$teacherId'";
    // mysqli_query($link, $deleteSubjectsSql);

    // Insert assigned subjects into the teacher_subjects table
    foreach ($assignedSubjects as $subjectId) {
        foreach ($assignedClasses as $classId) {
            // Check if the assignment already exists in the database
            $checkAssignmentSql = "SELECT * FROM teacher_subjects WHERE teacher_id = '$teacherId' AND subject_id = '$subjectId' AND class_id = '$classId'";
            $result = mysqli_query($link, $checkAssignmentSql);

            if (mysqli_num_rows($result) == 0) {
                // If the assignment does not exist, insert it
                $sql = "INSERT INTO teacher_subjects (teacher_id, subject_id, class_id, date_assigned) VALUES ('$teacherId', '$subjectId', '$classId', NOW())";
                mysqli_query($link, $sql);
            } else {
                // If the assignment already exists, set an error message
                $statusMsg = "Error: Assignment already exists for the selected teacher, subject, and class.";
                $alertStyle = "alert alert-danger";
            }
        }
    }

    // Check if the insertions were successful
    if (mysqli_error($link)) {
        $statusMsg = "Error: " . mysqli_error($link);
        $alertStyle = "alert alert-danger";
    } elseif (empty($statusMsg)) {
        $statusMsg = "Subjects and classes assigned successfully!";
        $alertStyle = "alert alert-success";
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
    <script src = "JS/currentDate.js"></script>

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
<body>

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
                                 <li class="active">Assign Teacher</li>
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
                             <strong class="card-title"><h2 align="center">Assign Teacher</h2></strong>
                         </div>
                         <div class="card-body">
                             <!-- Credit Card -->
                             <div id="pay-invoice">
                                 <div class="card-body">
                                    <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="selectTeacher" class="control-label mb-1">Select Teacher to Assign</label>
                                                    <select id="selectTeacher" name="selectTeacher" class="form-control" onchange="fetchTeacherDepartment(this)">
                                                        <?php
                                                        // Fetch teachers from the database and populate the dropdown
                                                        $teacherQuery = mysqli_query($link, "SELECT id, name, department FROM teachers");
                                                        while ($row = mysqli_fetch_assoc($teacherQuery)) {
                                                            echo '<option value="' . $row['id'] . '" data-department="' . $row['department'] . '">' . $row['name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="teacherDepartment" class="control-label mb-1">Teacher's Department</label>
                                                    <input type="text" id="teacherDepartment" name="teacherDepartment" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="teacherSubjects" class="control-label mb-1">Subjects</label>
                                                    <select id="teacherSubjects" name="teacherSubjects[]" class="form-control" multiple>
                                                        <?php
                                                        // Fetch subjects from the database and populate the dropdown
                                                        $subjectQuery = mysqli_query($link, "SELECT id, subjectName FROM subjects");
                                                        while ($row = mysqli_fetch_assoc($subjectQuery)) {
                                                            echo '<option value="' . $row['id'] . '">' . $row['subjectName'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="teacherClasses" class="control-label mb-1">Classes</label>
                                                    <select id="teacherClasses" name="teacherClasses[]" class="form-control" multiple>
                                                        <?php
                                                        // Fetch classes from the database and populate the dropdown
                                                        $classQuery = mysqli_query($link, "SELECT id, class_name FROM classes");
                                                        while ($row = mysqli_fetch_assoc($classQuery)) {
                                                            echo '<option value="' . $row['id'] . '">' . $row['class_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-success">Assign Teacher</button>
                                    </form>

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
document.getElementById("assignTeacherBtn").addEventListener("click", function () {
    // Get the form data
    const form = document.querySelector("form");
    const formData = new FormData(form);

    // Send the data to the server using AJAX for processing and database update
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "assign_teacher.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the server (e.g., show a success message)
            alert(xhr.responseText);
        }
    };

    // Send the form data
    xhr.send(formData);
});
</script>

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

<script>
       function fetchTeacherDepartment(select) {
    const selectedOption = select.options[select.selectedIndex];
    const teacherId = selectedOption.value;

    // Make an AJAX request to fetch the department name
    $.ajax({
        type: "POST",
        url: "fetch_department.php", // Replace with the actual URL to fetch department name
        data: { teacherId: teacherId },
        success: function (response) {
            const departmentInput = document.getElementById('teacherDepartment');
            departmentInput.value = response;
        }
    });
}

 </script>

</body>
</html>