

<footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-contact">
             <?php

              $ret=mysqli_query($link,"select * from tblpage where PageType='aboutus' ");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

              ?>
        
               <img class="logo" src="assets/img/logos/logo.png" alt="Logo">
               <p><?php  echo $row['motto'];?>.</p>
               <?php } ?> <br><br>

               <?php
                $ret=mysqli_query($link,"select * from tblpage where PageType='contactus' ");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                ?>
                 <div class="contact-item">
                            <span class="contact-icon fa fa-phone text-primary"></span>
                            <div class="contact-info">
                                <h4><a href="tel:+44 99 555 42">+<?php echo $row['MobileNumber']; ?></a></h4>
                            </div>
                        </div>
                  <div class="contact-item">
                            <span class="contact-icon fa fa-envelope text-primary"></span>
                            <div class="contact-info">
                                <h4><a href="mailto:example@mail.com"><?php echo $row['Email']; ?></h4></p>
                                <?php } ?>
                            </div>
                        </div>
            </div>
              
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="about.php">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="gallery.php">Gallery</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contact.php">Contact Us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>


          <div class="col-lg-4 col-md-6 text-center footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Join Our School and have the best high School Experience!</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Join Now!">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; <strong><span> <?php echo date('Y');?> School Management System</span></strong>- Developed By Mishytechs @ TUM
        </div>
       
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>

<a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
<div id="preloader"></div>

<!-- my JS Files -->
<script src="assets/mine/jquery/jquery.min.js"></script>
<script src="assets/mine/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/mine/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/mine/php-email-form/validate.js"></script>
<script src="assets/mine/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/mine/counterup/counterup.min.js"></script>
<script src="assets/mine/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/mine/aos/aos.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>

