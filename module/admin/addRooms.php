<?php
include_once('../../service/dbconnection.php');
$check = $_SESSION['login_id'];
$session = mysqli_query($link, "SELECT name FROM admin WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];
if (!isset($login_session)) {
    header("Location:../../");
}
?>
<?php
// error_reporting(0);

$statusMsg = "";
$alertStyle = "";

// Check if the form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostelId = $_POST["hostel_id"];
    $roomNo = $_POST["room_no"];
    $availability = $_POST['availability'];

    // You may want to add more validation here

    // Check if the room already exists in the hostel
    $checkRoomQuery = mysqli_query($link, "SELECT id FROM hostelrooms WHERE room_no = '$roomNo' AND hostel_id = '$hostelId'");
    if (mysqli_num_rows($checkRoomQuery) > 0) {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Room already exists.";
    } else {
        // Insert the new room
        $insertRoomQuery = mysqli_query($link, "INSERT INTO hostelrooms (room_no, hostel_id, availability) VALUES ('$roomNo', '$hostelId', '$availability')");
        if ($insertRoomQuery) {
            $alertStyle = "alert alert-success";
            $statusMsg = "Room updated successfully.";
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "Error updating Room .";
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
    <?php $page="Accomodation"; include 'includes/leftMenu.php';?>

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
                                    <li><a href="#">Accomodation</a></li>
                                    <li class="active">Add New Hostel Room</li>
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
                                <strong class="card-title"><h2 align="center">Add New Hostel Room</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       <div class="<?php echo $alertStyle;?>" role="alert"><?php echo $statusMsg;?></div>

    <form method="POST" action="addRooms.php">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="hostel_id" class="control-label mb-1">Select Hostel:</label>
                 <select required name="hostel_id" class="form-control">
            <!-- Fetch and display hostels dynamically -->
            <?php
                $query = mysqli_query($link, "SELECT * FROM hostels ORDER BY hostels_name ASC");                        
                $count = mysqli_num_rows($query);
                if ($count > 0) {                       
                    while ($row = mysqli_fetch_array($query)) {
                        echo '<option value="' . $row['id'] . '">' . $row['hostels_name'] . '</option>';
                    }
                }
            ?>
        </select>
     </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="room_no" class="control-label mb-1">Room No:</label>
             <input type="text" id="room_no" name="room_no" required class="form-control">
        </div>
    </div>
</div>
                                  <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="availability" class="control-label mb-1">Set Room as :</label>
                                                    <select required name="availability" class="form-control">
                                                        <option value="1">Available</option>
                                                        <option value="0">Not Available</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" name="submit" class="btn btn-success">Add New Room</button>
                                            </div>
                                    </div>
                            </form>

                            </div>
                    </div>
                </div>
            </div> <!-- .card -->
        </div><!--/.col-->
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"><h2 align="center">All Hostel Rooms</h2></strong>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table" class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hostel Name</th>
                        <th>Room No</th>
                        <th>Availability</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ret = mysqli_query($link, "SELECT hostels.hostels_name, hostelrooms.room_no, hostelrooms.availability
                                                FROM hostelrooms
                                                INNER JOIN hostels ON hostels.id = hostelrooms.hostel_id");

                    $cnt = 1;
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row['hostels_name']; ?></td>
                            <td><?php echo $row['room_no']; ?></td>
                            <td><?php echo ($row['availability'] == '1') ? 'Available' : 'Not-Available'; ?></td>
                            <td><a href="updateRoom.php?updateroomId=<?php echo $row['room_no']; ?>" title="Edit Details"><i class="fa fa-edit fa-1x"></i></a>
                            <a onclick="return confirm('Are you sure you want to delete?')" href="deleteRoom.php?delid=<?php echo $row['room_no']; ?>" title="Delete Room Details"><i class="fa fa-trash fa-1x"></i></a></td>
                        </tr>
                    <?php
                        $cnt = $cnt + 1;
                    }
                    ?>
                </tbody>
            </table>
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

