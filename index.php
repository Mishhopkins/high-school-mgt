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

      <title>ST. ANNES HIGH SCHOOL</title>
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

      <!-- my Main CSS File -->
      <link rel="stylesheet" href="assets/css/style2.css">
      <link href="styles.css" rel="stylesheet">
</head>


<body>

  <!-- Hero Section -->

  <section id="hero">
  <div class="containerposition-relative" data-aos="zoom-in" data-aos-delay="100">
  <?php
     $ret=mysqli_query($link,"select * from tblpage where PageType='aboutus' ");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

              ?>
        
        <h1><?php  echo $row['name'];?></h1> <br> 
        <h2> <?php  echo $row['motto'];?></h2>
        <a href="about.php" class="btn-get-started">Read More</a>
               <?php } ?>
  </div>
     
  </section>

<!-- End Hero -->

<main id="main">

<!-- About Section  -->

  <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Mission</h2>
          <p>Our Mission</p>
        </div>

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/logos/logo1.png"  class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <?php

            $ret=mysqli_query($link,"select * from tblpage where PageType='contactus' ");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {

?>
            <p><?php  echo $row['mission'];?>.</p>
            <?php } ?>
            <ul>
              
            <a href="about.php" class="learn-more-btn">Read More</a>

          </div>

        </div>

      </div>

    </section>
    <!-- End About Section -->


    <!--  Counts Section -->

    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
         <?php $students=mysqli_query($link,"select * from students"); //students
         $countStudents = mysqli_num_rows($students); ?>

            <span data-toggle="counter-up"><span class="count"><?php echo $countStudents;?></span></span>
            <p>Students</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
          <?php $teachers=mysqli_query($link,"select * from teachers"); //teachers
         $countTeachers = mysqli_num_rows($teachers); ?>
            <span data-toggle="counter-up"><span class="count"><?php echo $countTeachers;?></span></span>
            <p>Teachers</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
          <?php $departments=mysqli_query($link,"select * from departments"); //departments
         $countDepartments = mysqli_num_rows($departments); ?>
            <span data-toggle="counter-up"><span class="count"><?php echo $countDepartments;?></span></span>
            <p>Departments</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">5</span>
            <p>Events</p>
          </div>

        </div>

      </div>
    </section>
    <!-- End Counts Section -->


    <!--  Footer -->

   <?php include('footer.php');?> 

<!-- End Footer -->


</body>

</html>