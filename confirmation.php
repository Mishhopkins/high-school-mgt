<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }

        .confirmation-container {
        max-width: 600px;
        margin: auto;
        background: linear-gradient(40deg, white, yellow, blue);
        padding: 20px;
        border-radius: 8px;
        margin-top: 150px;
        box-shadow: 10px 10px 10px black;
        float: center; 
        }

        h2 {
            color: #28a745;
        }
    </style>
</head>
<body>

<div class="confirmation-container">

<a href="#"><img src="assets/img/logos/logo.png" alt="Logo"></a>
    <?php
    // Display success message or redirect to a confirmation page
    if ($balance == 0) {
        $message = "Registration successful! You have paid the full fee.";
    } else {
        $message = "Please make a full payment to complete your registration. Remaining balance: $balance";
    }

    echo '<h2>' . htmlspecialchars($message) . '</h2>';
    ?>
</div>

<script>
    // Redirect back to the first step after 10 seconds
    setTimeout(function () {
        window.location.href = 'admi.php?step=1'; // Replace with the actual URL of your first step page
    }, 10000);
</script>

</body>
</html>
