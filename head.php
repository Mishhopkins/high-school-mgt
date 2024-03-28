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

  <!-- my CSS Files -->
  <link rel="shortcut icon" href="assets/img/icon/student-grade.png" />
  <link href="assets/mine/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link href="assets/mine/icofont/icofont.min.css" rel="stylesheet"> -->
  <link href="assets/mine/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/mine/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/mine/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/mine/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


  <!-- Template Main CSS File -->
  <link href="styles.css" rel="stylesheet">

  
</head>

<body>

  <!-- ======= Header ======= -->

  <section id="header">

   <a href="#"><img src="assets/img/logos/logo.png" alt="Logo"></a>

      <h1> <a href="index.php">SCHOOL MANAGEMENT SYSTEM</a></h1>

      <div >
        <ul id="navbar">
        <li><a class="menu-item" href="index.php">Home</a></li>
        <li><a class="menu-item" href="about.php">About</a></li>
        <li><a class="menu-item" href="gallery.php">Our Gallery</a></li>
        <li><a class="menu-item" href="contact.php">Contact</a></li>
        <li><a class="menu-item" href="login.php">Login</a></li><br>
        <li><a class="menu-item" href="admi.php">Admission </a></li><br>

    
        </ul>
    </div>
  
</section>

<!-- End Header -->

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Get all menu items
    var menuItems = document.querySelectorAll(".menu-item");

    // Add a click event listener to each menu item
    menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
            // Remove the "active" class from all menu items
            menuItems.forEach(function (menuItem) {
                menuItem.classList.remove("active");
            });

            // Add the "active" class to the clicked menu item
            item.classList.add("active");
        });
    });
});
</script>


</body>

</html>

