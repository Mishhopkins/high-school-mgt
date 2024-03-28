
<?php
// Initialize the error message
$statusMsg = "";
$alertStyle = "";

// Check if the login form has been submitted
if (isset($_GET['signup']) && $_GET['signup'] == "false") {
    $statusMsg = "Please Enter all Required Credentials!!";
    $alertStyle = "alert-danger";
}
else{
    $statusMsg = "SignUp Successfully";
    $alertStyle = "alert-success";
}
?>
<?php
// error_reporting(0);
// session_start();
include_once('../../service/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errorMsg = ""; // Initialize error message
    

    // Check if all fields are filled in
    if (empty(trim($_POST["name"])) || empty(trim($_POST["id"])) || empty(trim($_POST["email"])) || empty(trim($_POST["password"])) || empty($_POST["phone"]) || empty($_POST["role"]) || empty($_POST["dob"]) || empty($_POST["address"]) || empty($_POST["stugender"])) {
        $errorMsg = "Please fill in all fields.";
    } else {
        // Check if email already exists
        $checkEmail = mysqli_real_escape_string($link, trim($_POST["email"]));
        $checkEmailQuery = mysqli_query($link, "SELECT id FROM admin WHERE email = '$checkEmail'");
        if (mysqli_num_rows($checkEmailQuery) > 0) {
            $errorMsg = "This email is already taken.";
        } else {
            // Prepare an insert statement
            $sql = "INSERT INTO admin (id, name, email, password, phone, role, dob, address, sex) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $link->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sssssssss", $param_id, $param_name, $param_email, $param_password, $param_phone, $param_role, $param_dob, $param_address, $param_stugender);

                // Set parameters 
                $param_name = trim($_POST["name"]);
                $param_id = trim($_POST["id"]);
                $param_email = trim($_POST["email"]);
                $param_password = trim($_POST["password"]);
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
    $link->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="shortcut icon" href="../../assets/img/icon/student-grade.png" />
    <link rel="stylesheet" href="../../styles.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="source/js/loginValidate.js"></script>

    <style>
    .status-message {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        text-align: center;
    }

    .status-message.alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .status-message.alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

</style>
</head>
<body class="bg-light">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                    </a>
                </div>

                <div class="login-form">
                    <form action=""  method="post"><br/>
                        
                        <div class="login-logo">
                        <a href="index.html"><img src="../../assets/img/logos/logo.png" alt="Logo" style="max-width: 150px;"></a>
                    </div>
                    
                    <div class="<?php echo $alertStyle; ?> status-message" role="alert">
                        <i class="fa fa-exclamation-circle"></i> <?php echo $statusMsg; ?>
                    </div>
                        <strong><h2 align="center">Admin Sign UP</h2></strong><hr>

                        <div class="form-group">
                            <label>name</label>
                            <input type="text" name="name" Required class="form-control" placeholder="Enter Fullname">
                        </div>

                        <div class="form-group">
                            <label>ID</label>
                            <input type="id" name="id" Required class="form-control" placeholder="Enter Admin ID">
                        </div>
                        
                        <div class="form-group">
                            <label>email</label>
                            <input type="email" name="email" Required class="form-control" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" Required class="form-control" placeholder="Enter Your Password">
                        </div>

                        <div class="form-group">
                            <label>phone</label>
                            <input type="text" name="phone" Required class="form-control" placeholder="Enter Your Phone NO.">
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" Required class="form-control" placeholder="Enter Your Role">
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" Required class="form-control" placeholder="Enter Your DOB">
                        </div>

                        <div class="form-group">
                                    <label class="control-label mb-1">Gender:</label> <br>
                                    <input type="radio" name="stugender" value="Male" onclick="stugender = this.value;"> Male
                                    <input type="radio" name="stugender" value="Female" onclick="this.value"> Female
                                </div>
                        
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" Required class="form-control" placeholder="Enter Your Address">
                        </div> 
                    
                        <div class="checkbox">
                            <label class="pull-left">
                                <a href="index.php">Go Back</a>
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgot Password?</a>
                            </label>
                        </div>
                        <br>
                        <button type="submit" name="signup" class="btn btn-success btn-flat m-b-30 m-t-30">Sign Up</button>
                        <div class="register-link m-t-15 text-center"> 
                            <p>Already Have an Account <a href="../../login.php">Log IN Here</a></p>
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

<!-- <label class="pull-right"> -->
                                <!-- <a href="#">Forgot Password?</a> -->
                            <!-- </label> -->