<?php
// Initialize the error message
$statusMsg = "";
$alertStyle = "";

// Check if the login form has been submitted
if (isset($_GET['login']) && $_GET['login'] == "false") {
    $statusMsg = "Please Enter the correct Credentials!!";
    $alertStyle = "alert-danger";
}
else{
    $statusMsg = "Login Successfully";
    $alertStyle = "alert-success";
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
    <link rel="shortcut icon" href="assets/img/icon/student-grade.png" />
    <link rel="stylesheet" href="styles.css">
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
                    <form action="service/check.access.php" onsubmit="return loginValidate();" method="post"><br/>
                        
                        <div class="login-logo">
                        <a href="index.html"><img src="assets/img/logos/logo.png" alt="Logo" style="max-width: 150px;"></a>
                    </div>
                    
                    <div class="<?php echo $alertStyle; ?> status-message" role="alert">
                        <i class="fa fa-exclamation-circle"></i> <?php echo $statusMsg; ?>
                    </div>
                        <strong><h2 align="center">User Login</h2></strong><hr>
                        <div class="form-group">
                            <label>Login ID</label>
                            <input type="text" class="form-control" id="myid" name="myid" class="form-control cc-exp" value="" Required placeholder="Enter Your ID" autofocus=""   />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="mypassword" name="mypassword"  class="form-control cc-exp" value="" Required placeholder="Enter Password" autofocus="" placeholder="Password"  />
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
                        <button type="submit" name="login" class="btn btn-success btn-flat m-b-30 m-t-30">Log in</button>
                        <div class="register-link m-t-15 text-center"> 
                            <p>For Admins ONLY!! <a href="module\admin\signup.php">Sign Up Here</a></p>
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