<?php
// Include the database connection and session start
include_once('../../service/dbconnection.php');
//session_start();
error_reporting(0);
// Check if the user is logged in
if (!isset($_SESSION['login_id'])) {
    header("Location: ../../");
    exit(); // Add an exit statement after redirection
}

$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name FROM admin WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];

$alertStyle = ""; // Initialize alert style
$statusMsg = ""; // Initialize status message

// Function to create a new session
function createSession($sessionName, $year) {
    global $link;

    // Check if the session name already exists
    $checkQuery = "SELECT * FROM session WHERE sessionName = '$sessionName'";
    $result = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Session already exists.";
        // return "Session already exists.";
    } else {
        // Insert the new session into the database
        $insertQuery = "INSERT INTO session (sessionName, status, year) VALUES ('$sessionName', 0, $year)";

        if (mysqli_query($link, $insertQuery)) {
        $alertStyle = "alert alert-success";
        $statusMsg = "Session created successfully.";
            // return "Session created successfully.";
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Error: Unable to create session:";
            // return "Error creating session: " . mysqli_error($link);
        }
    }
}

// Function to toggle (activate/deactivate) a session
function toggleSession($sessionId, $status) {
    global $link;

    // Update the session's status
    $updateQuery = "UPDATE session SET status = $status WHERE id = $sessionId";

    if (mysqli_query($link, $updateQuery)) {
        if ($status == 1) {
            $alertStyle = "alert alert-success";
        $statusMsg = "Session Activated successfully.";
            // return "Session activated successfully.";
        } else {
            $alertStyle = "alert alert-success";
        $statusMsg = "Session Deactivated successfully.";
            // return "Session deactivated successfully.";
        }
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Error: Unable to toggle session: ";
        // return "Error toggling session: " . mysqli_error($link);
    }
}

// Get the current year
$currentYear = date("Y");

if (isset($_POST['createSession'])) {
    // Handle creating a new session
    $sessionName = mysqli_real_escape_string($link, $_POST['sessionName']);
    $result = createSession($sessionName, $currentYear);
    echo $result;
}

if (isset($_POST['toggleSession'])) {
    // Handle activating/deactivating a session
    $sessionId = mysqli_real_escape_string($link, $_POST['sessionId']);
    $status = mysqli_real_escape_string($link, $_POST['status']);
    $result = toggleSession($sessionId, $status);
    echo $result;
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

<body>
    <!-- Left Panel -->
    <?php $page="session"; include 'includes/leftMenu.php';?>

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
                                    <li class="active">Create Sesssion</li>
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
                                <strong class="card-title"><h2 align="center">Create New Session</h2></strong>
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
                                            <label for="sessionName" class="control-label mb-1">Session Name:</label>
                                            <input type="text" id="sessionName" name="sessionName" required class="form-control">
                                            <button type="submit" name="createSession" class="btn btn-success">Create Session</button>
                                        </div>
                                    </div>
                                </div>      
                                </form>

                                <form method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="sessionId" class="control-label mb-1">Session:</label>
                                        <select required name="sessionId" class="custom-select form-control">
                                            <option value="">--Select session--</option>
                                            <?php
                                            $query = mysqli_query($link, "SELECT * FROM session ORDER BY sessionName ASC");
                                            while ($row = mysqli_fetch_array($query)) {
                                                echo '<option value="' . $row['id'] . '">' . $row['sessionName'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                        <div class="form-group">
                                            <label for="status" class="control-label mb-1">Status:</label>
                                            <select required id="status" name="status" class="custom-select form-control">
                                            <option value="1">--Activate session--</option>
                                            <option value="0">--Deactivate session--</option>
                                        </select>
                                            <button type="submit" name="toggleSession" class="btn btn-success">Toggle Session</button>
                                        </div>
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
