<?php
    //session_start();
    include_once('service/dbconnection.php');
    include('head.php');
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <title> Contact Page  |ST. ANNES HIGH SCHOOL</title>
      <meta content="" name="descriptison">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="../assets/img/icon/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!--  CSS Files -->
      <link rel="shortcut icon" href="../assets/img/icon/student-grade.png" />
      <link href="assets/mine/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- <link href="assets/mine/icofont/icofont.min.css" rel="stylesheet"> -->
      <link href="assets/mine/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/mine/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/mine/animate.css/animate.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link href="assets/mine/aos/aos.css" rel="stylesheet">

      <!-- my Main CSS File -->
      <link href="styles.css" rel="stylesheet">
</head>



<body>

  
<section class="contact-banner">
    <div class="contact-header">
        <div class="container">
            <h3>Contact Us</h3>
        </div>
    </div>
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-list">
                <li><a href="index.php">Home</a> <span class="breadcrumb-arrow">›</span></li>
                <li class="active">Contact</li>
            </ul>
        </div>
    </div>
</section>


<section class="contact-info" id="contact">
    <div class="contact-section">
        <div class="containers">
            <div class="contact-details">
                <?php
                $ret=mysqli_query($link,"select * from tblpage where PageType='contactus' ");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                ?>
                 <div class="contact-item">
                            <span class="contact-icon fa fa-phone text-primary"></span>
                            <div class="contact-info">
                                <h6>Call Us</h6>
                                <p><a href="tel:+44 99 555 42">+<?php echo $row['MobileNumber']; ?></a></p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon fa fa-envelope text-primary"></span>
                            <div class="contact-info">
                                <h6>Email Us</h6>
                                <p><a href="mailto:example@mail.com" class="mail"><?php echo $row['Email']; ?></a></p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon fa fa-map-marker text-primary"></span>
                            <div class="contact-info">
                                <h6>Address</h6>
                                <p><?php echo $row['street']; ?></p>
                                <p><?php echo $row['address']; ?></p>
                                <p><?php echo $row['town']; ?></p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon fa fa-clock text-primary"></span>
                            <div class="contact-info">
                                <h6>Official Hours</h6>
                                <p><?php echo $row['Timing']; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
          
            <div class="contact-form">
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="fname" placeholder="First Name" required="">
                        <input type="text" class="form-control" name="lname" placeholder="Last Name" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" required="" name="phone" pattern="[0-9]+" maxlength="10">
                        <input type="email" class="form-control" placeholder="Email" required="" name="email">
                    </div>
                    <textarea class="form-control" id="message" name="message" placeholder="Message" required=""></textarea>
                    <button type="submit" class="btn-contact" name="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include_once('footer.php');?>  
    <!--  Footer -->

</body>
</html>
<style>

/* Global Styles */
body {
    font-family: Arial, sans-serif;
}

/* Contact Banner */
.contact-banner {
  background-image: url(assets/img/logos/logo.png);
  height: 500px;
  width: 100%;
  background-size: cover;
  background-position: top 25% right 0;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  padding: 30px 0px 30px;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  -ms-background-size: cover;
  position: relative;
  display: grid;
  z-index: 0;
  align-items: center;
}


.contact-header h3 {
    font-size: 50px;
    font-weight: bold;
    margin-top: 40px;
    align-items: center;
}

.breadcrumb-list {
    list-style: none;
    padding: 0;
    margin: 0;
    align-items: center;
    font-size: 24px;
    font-weight: bold;
    line-height: 18px;
}

.breadcrumb-list li {
    display: inline-block;
}

.breadcrumb-list li a {
    text-decoration: none;
    color: black;
}

.breadcrumb-arrow {
    margin: 0 10px;
    color: #666;
    font-size: 30px
}

.breadcrumb-list li.active {
    font-weight: bold;
    color: red;
}

.breadcrumb-list li a:hover,
.breadcrumb-list li a.active
    {
        color: red;
    }

/* Contact Section */
.contact-section {
    padding: 70px 0px 100px;
}


.containers {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
    display: grid;
    grid-template-columns: 1fr 1.3fr;
    grid-gap: 30px;
}

/* Contact Details */
.contact-details {
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
}

.contact-item {
    display: block;
    align-items: center;
}

.contact-icon {
    font-size: 24px;
    margin-right: 10px;
    color: blue;
}

.contact-info h6 {
    margin-bottom: 10px;
    font-size: 24px;
    line-height: 30px;
    color: blue;
    
}

.contact-info p a {
    margin: 0;
    font-size: 18px;
    line-height: 26px;
    font-weight: bold;
    color: black;
}

.contact-info p {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
    line-height: 26px;
    color: black;
}

/* Contact Form */
.contact-form {
    margin-top: 40px;
    
}

.contact-form input, .contact-form textarea {
  border: 3px solid #black;
    background: #f8f9fa;
    color: #777;
    font-size: 16px;
    padding: 12px 15px;
    width: 100%;
    border-radius: 6px;
    box-shadow: 10px 10px 54px rgba(70,62,221, 0.1)
    height: 55px;

}

.contact-form textarea {
resize: none;
min-height: 140px;
}

.form-group {
    margin-bottom: 20px;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr 1fr;
    margin-bottom: 20px;
    
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-contact {
    border: none;
    font-size: 16px;
    padding: 15px 30px;
    margin: 20px auto 0;
    color: #fff;
    background: red;
    border-color: #f567a6;
    display: inline-block;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border-radius: 6px;
    float: right;
}

.btn-contact:hover {
    background: blue;
}

