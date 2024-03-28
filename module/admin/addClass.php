<?php
include_once('../../service/dbconnection.php');
$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name FROM admin WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];
if (!isset($login_session)) {
    header("Location:../../");
}

// Adding Forms
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addForm'])) {
    $form = mysqli_real_escape_string($link, $_POST['form']);
    $query_add_form = "INSERT INTO forms (form) VALUES ('$form')";
    mysqli_query($link, $query_add_form);
}

// Adding Streams
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addStream'])) {
    $streamName = mysqli_real_escape_string($link, $_POST['streamName']);
    $query_add_stream = "INSERT INTO streams (streamName) VALUES ('$streamName')";
    mysqli_query($link, $query_add_stream);
}

// Selecting Forms and Streams
$query_forms = mysqli_query($link, "SELECT * FROM forms");
$query_streams = mysqli_query($link, "SELECT * FROM streams");

$statusMsg = "";
$alertStyle = "";

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $formId = $_POST['form']; // Get the selected form
    $streamId = $_POST['stream']; // Get the selected stream

    // Get formName and streamName from their respective tables
    $formQuery = mysqli_query($link, "SELECT form FROM forms WHERE id = '$formId'");
    $streamQuery = mysqli_query($link, "SELECT streamName FROM streams WHERE id = '$streamId'");

    $form = mysqli_fetch_assoc($formQuery)['form'];
    $stream = mysqli_fetch_assoc($streamQuery)['streamName'];

    $class_name = $form . $stream; // Generate the class name by concatenating form and stream
    $classT_id = $_POST['classT_id'];

    // Check if the class teacher is already assigned to a class
    $query = mysqli_query($link, "SELECT * FROM classes WHERE classT_id='$classT_id'");
    if (mysqli_num_rows($query) > 0) {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Class teacher is already assigned to a class!";
    } else {
        // Check if the class is already added
        $query = mysqli_query($link, "SELECT * FROM classes WHERE class_name ='$class_name'");
        if (mysqli_num_rows($query) > 0) {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Class already exists!";
        } else {
            // Insert the new class into the database
            $insertQuery = mysqli_query($link, "INSERT INTO classes (class_name, classT_id) VALUES ('$class_name', '$classT_id')");

            if ($insertQuery) {
                // Get the auto-generated class_id
                $class_id = mysqli_insert_id($link);

                // Update the class_id in classteachers table
                $updateQuery = mysqli_query($link, "UPDATE classteachers SET class_id = '$class_id' WHERE id = '$classT_id'");

                if ($updateQuery) {
                    // Insert the class teacher details into classteachers table
                    $classTeacherQuery = mysqli_query($link, "INSERT INTO classteachers (class_id, teacher_id) VALUES ('$class_id', '$classT_id')");

                    if ($classTeacherQuery) {
                        $alertStyle = "alert alert-success";
                        $statusMsg = "Class added successfully!";
                    } else {
                        $alertStyle = "alert alert-danger";
                        $statusMsg = "Failed to insert class teacher details into classteachers table!";
                    }
                } else {
                    $alertStyle = "alert alert-danger";
                    $statusMsg = "Failed to update class_id in classteachers table!";
                }
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred!";
            }
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
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style2.css">
    <script src="JS/currentDate.js"></script>
    <script src="JS/newStudentValidation.js"></script>

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
    <?php $page="class"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Class</a></li>
                                    <li class="active">Add New Class</li>
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
                                <strong class="card-title"><h2 align="center">Add New Form</h2></strong>
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
                                                        <label for="form" class="control-label mb-1">Add Form:</label>
                                                        <input type="text" id="form" name="form" required class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <button type="submit" name="addForm" class="btn btn-success">Add New Form</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Add New Stream</h2></strong>
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
                                                        <label for="streamName" class="control-label mb-1">Add Stream:</label>
                                                        <input type="text" id="streamName" name="streamName" required class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <button type="submit" name="addStream" class="btn btn-success">Add New Stream</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card -->
                    </div><!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"><h2 align="center">Add New Class</h2></strong>
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
                                                        <label for="form" class="control-label mb-1">Form</label>
                                                        <select name="form" class="custom-select form-control" required>
                                                            <option value="">-- Select Form --</option>
                                                            <?php
                                                            while ($row_form = mysqli_fetch_array($query_forms)) {
                                                                echo '<option value="' . $row_form['id'] . '">' . $row_form['form'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="stream" class="control-label mb-1">Stream</label>
                                                        <select name="stream" class="custom-select form-control" required>
                                                            <option value="">-- Select Stream --</option>
                                                            <?php
                                                            while ($row_stream = mysqli_fetch_array($query_streams)) {
                                                                echo '<option value="' . $row_stream['id'] . '">' . $row_stream['streamName'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="x_card_code" class="control-label mb-1">Class Teacher</label>
                                                        <?php 
                                                        $query = mysqli_query($link, "SELECT * FROM teachers ORDER BY name ASC");                        
                                                        $count = mysqli_num_rows($query);
                                                        if ($count > 0) {                       
                                                            echo '<select required name="classT_id" onchange="showValues(this.value)" class="custom-select form-control">';
                                                            echo '<option value="">--Select Class Teacher--</option>';
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                            }
                                                            echo '</select>';
                                                        }
                                                        ?>                                                     
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="submit" class="btn btn-success">Add New Class</button>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/init/datatables-init.js"></script>


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
