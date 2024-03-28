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
$session = mysqli_query($link, "SELECT name, email, phone FROM teachers WHERE id='$check'");
$row = mysqli_fetch_array($session);
$login_session = $loged_user_name = $row['name'];

if (isset($_POST['submit'])) {
    $alertStyle = "";
    $statusMsg = "";

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $ret = mysqli_query($link, "UPDATE teachers SET name='$name', email='$email', phone='$phone' where id='$check'");

    if ($ret == TRUE) {
        $alertStyle = "alert alert-success";
        $statusMsg = "Profile Updated Successfully!";
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "An error Occurred!";
    }
}
?>

<?php
if (isset($_POST['update_pwd'])) {
    $oldPassword = mysqli_real_escape_string($link, $_POST['old_password']);
    $newPassword = mysqli_real_escape_string($link, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($link, $_POST['new_password']);

    // Validate if old password is correct
    $checkOldPassword = mysqli_query($link, "SELECT * FROM teachers WHERE id='$check' AND password='$oldPassword'");
    if (mysqli_num_rows($checkOldPassword) > 0) {
        // Old password is correct, update the password
        if ($newPassword == $confirmPassword) {
            // Update password in teachers table
            $updatePassword = mysqli_query($link, "UPDATE teachers SET password='$newPassword' WHERE id='$check'");
            if ($updatePassword) {
                // Update password in users table
                $updateUserPassword = mysqli_query($link, "UPDATE users SET password='$newPassword' WHERE userid='$check'");
                
                if ($updateUserPassword) {
                    $alertStyle = "alert alert-success";
                    $statusMsg = "Password Updated Successfully!";
                } else {
                    $alertStyle = "alert alert-danger";
                    $statusMsg = "An error occurred while updating the password in the users table!";
                }
            } else {
                $alertStyle = "alert alert-danger";
                $statusMsg = "An error occurred while updating the password in the teachers table!";
            }
        } else {
            $alertStyle = "alert alert-danger";
            $statusMsg = "New password and confirm password do not match!";
        }
    } else {
        $alertStyle = "alert alert-danger";
        $statusMsg = "Old password is incorrect!";
    }
}
?>


<!doctype html>
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/.....
    ...
    <link rel="stylesheet" href="../../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>

    <link rel="stylesheet" href="../../assets/css/style2.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

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
    <?php $page = "teacher";
    include 'includes/leftMenu.php'; ?>

    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include 'includes/header.php'; ?>
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
                                    <li><a href="#">Profile</a></li>
                                    <li class="active">update profile </li>
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
                                <strong class="card-title"><h2 align="center">Update Profile Information</h2></strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="<?php echo $alertStyle; ?>" role="alert"><?php echo $statusMsg; ?></div>
                                        <form action="#" method="post" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-lg-4 col-xl-4">
                                                    <div class="card-box text-center bg-white" style="border-radius: 20px; padding: 20px; border: 5px solid black;">
                                                        <?php
                                                        $sql = "SELECT * FROM teachers WHERE id='$check';";
                                                        $res = mysqli_query($link, $sql);
                                                        while ($row = mysqli_fetch_array($res)) {
                                                        ?>
                                                            <img src="../images/<?php echo $row['file']; ?>" alt="<?php echo $check ?>" style="width: 100px; height: 100px; border-radius: 50%;">
                                                            <div class="text-centre mt-1">
                                                                <p class="text-dark mt-1 m-0"><strong>Teacher Full Name:</strong> <?php echo $row['name']; ?> </p>
                                                                <p class="text-dark mt-1 m-0"><strong>Teacher Number:</strong> <?php echo $row['id']; ?> </p>
                                                                <p class="text-dark mt-1 m-0"><strong>Teacher Phone:</strong> <?php echo $row['phone']; ?></p>
                                                                <p class="text-dark mt-1 m-0"><strong>Teacher Email:</strong> <?php echo $row['email']; ?></p>
                                                                <p class="text-dark mt-1 m-0"><strong>Date Hired:</strong> <?php echo $row['hiredate']; ?></p>
                                                                <p class="text-dark mt-1 m-0"><strong>Address:</strong> <?php echo $row['address']; ?></p>
                                                            </div>

                                                    </div>
                                                </div>


                                                <div class="col-lg-8 col-xl-8">
                                                    <div class="card-box">
                                                        <ul class="nav nav-pills navtab-bg nav-justified nav-border 5px solid black">
                                                            <li class="nav-item">
                                                                <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                                    Update Profile
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                                    Change Password
                                                                </a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content">
                                                            <div class="tab-pane show active" id="aboutme">
                                                                <!-- Update Profile Form -->
                                                                <br>

                                                                <form method="post" enctype="multipart/form-data">

                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label for="cc-exp" class="control-label mb-1">Full name</label>
                                                                                <input id="" name="name" type="text" class="form-control cc-exp" value="<?php echo $row['name']; ?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Firstname">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label for="x_card_code" class="control-label mb-1">Email Address</label>
                                                                                <input id="" name="email" type="email" class="form-control cc-cvc" value="<?php echo $row['email']; ?>" Required data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" placeholder="Email Address">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label for="cc-exp" class="control-label mb-1">Phone Number</label>
                                                                                <input id="" name="phone" type="text" class="form-control cc-exp" value="<?php echo $row['phone']; ?>" Required data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="Phone Number">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>

                                                                    <button type="submit" name="submit" class="btn btn-success">Update Profile</button>
                                                                </form>
                                                            </div>

                                                            <div class="tab-pane" id="settings">
                                                                <!-- Change Password Form -->
                                                                <form method="post">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="firstname">Old Password</label>
                                                                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter Old Password">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="lastname">New Password</label>
                                                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password">
                                                                            </div>
                                                                        </div> <!-- end col -->
                                                                    </div> <!-- end row -->

                                                                    <div class="form-group">
                                                                        <label for="useremail">Confirm Password</label>
                                                                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Confirm New Password">
                                                                    </div>

                                                                    <div class="text-right">
                                                                        <button type="submit" name="update_pwd" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update Password</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- .animated -->
                        </div><!-- .content -->

                        <div class="clearfix"></div>

                        <?php include 'includes/footer.php'; ?>

                    </div><!-- /#right-panel -->

                    <!-- Right Panel -->

                    <!-- Scripts -->
                    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
                    <script src="../../assets/js/main.js"></script>

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
                        $(document).ready(function () {
                            $('#bootstrap-data-table-export').DataTable();
                        });

                        // Menu Trigger
                        $('#menuToggle').on('click', function (event) {
                            var windowWidth = $(window).width();
                            if (windowWidth < 1010) {
                                $('body').removeClass('open');
                                if (windowWidth < 760) {
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
