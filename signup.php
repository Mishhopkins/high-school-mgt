<?php
error_reporting(0);
//session_start();
include_once('../../service/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorMsg = ""; // Initialize error message

    // Check if all fields are filled in
    if (empty(trim($_POST["name"])) || empty(trim($_POST["id"])) || empty(trim($_POST["email"])) || empty(trim($_POST["password"])) || empty($_POST["phone"]) || empty($_POST["role"]) || empty($_POST["dob"]) || empty($_POST["address"]) || empty($_POST["stugender"])) {
        $errorMsg = "Please fill in all fields.";
    } else {
        // Check if email already exists
        $checkEmail = trim($_POST["email"]);
        $checkEmailQuery = mysqli_query($con, "SELECT id FROM admins WHERE email = '$checkEmail'");
        if (mysqli_num_rows($checkEmailQuery) > 0) {
            $errorMsg = "This email is already taken.";
        } else {
            // Prepare an insert statement
            $sql = "INSERT INTO admins (id, name, email, password, phone, role, dob, address, sex) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $con->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sssssssss", $param_id, $param_name, $param_email, $param_password, $param_phone, $param_role, $param_dob, $param_address, $param_stugender);

                // Set parameters 
                $param_name = trim($_POST["name"]);
                $param_id = trim($_POST["id"]);
                $param_email = trim($_POST["email"]);
                $param_password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
                $param_phone = trim($_POST["phone"]);
                $param_role = trim($_POST["role"]);
                $param_dob = trim($_POST["dob"]);
                $param_address = trim($_POST["address"]);
                $param_stugender = trim($_POST["stugender"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect user to login page
                    header("location: ../../login.php");
                } else {
                    $errorMsg = "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    // Close connection
    $con->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Sign Up</title>
    <meta content="" name="descriptison">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!--  CSS Files -->
      <link rel="shortcut icon" href="assets/img/icon/student-grade.png" />
      <link href="assets/mine/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- <link href="assets/mine/icofont/icofont.min.css" rel="stylesheet"> -->
      <link href="assets/mine/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/mine/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/mine/animate.css/animate.min.css" rel="stylesheet">
      <link href="assets/mine/aos/aos.css" rel="stylesheet">

      
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

</head>
  
<body class="bg-light">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <!-- <img class="align-content" src="images/staffGreen.png" alt=""> -->
                    </a>
                </div>
                <div class="login-form">
                    <form method="Post" Action="">
                            <?php echo $errorMsg; ?>
                        <strong><h2 align="center"> Admins' SignUp</h2></strong><hr>

                        <div class="form-group">
                            <label>name</label>
                            <input type="text" name="name" Required class="form-control" placeholder="Fullname">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" Required class="form-control" placeholder="Password">
                        </div>
                        
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" name="email" Required class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" Required class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label>phone</label>
                            <input type="text" name="phone" Required class="form-control" placeholder="TEL.">
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" Required class="form-control" placeholder="Your Role">
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" Required class="form-control" placeholder="DOB">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" Required class="form-control" placeholder="Address">
                        </div>

                                <div class="form-group">
                                    <label class="control-label mb-1">Gender:</label> <br>
                                    <input type="radio" name="stugender" value="Male" onclick="stugender = this.value;"> Male
                                    <input type="radio" name="stugender" value="Female" onclick="this.value"> Female
                                </div>
                            </div>
                        </div>
                     

                        
                        <div class="checkbox">
                           <label class="pull-right">
                                <a href="index.php">Go Back</a>
                            </label>
                            <!-- <label class="pull-right"> -->
                                <!-- <a href="#">Forgot Password?</a> -->
                            <!-- </label> -->
                        </div>
                        <br>
                        <button type="submit" name="login" class="btn btn-success btn-flat m-b-30 m-t-30">Sign UP</button>

                        <!-- <div class="social-login-content">  -->
                            <!-- <div class="social-button"> -->
                                <!-- <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button> -->
                                <!-- <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button> -->
                            <!-- </div> -->
                        <!-- </div> -->

                        <div class="register-link m-t-15 text-center"> 
                            <p>Already have an account ? <a href="Login.php"> Login Here</a></p>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
