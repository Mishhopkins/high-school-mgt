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
    <title>About Page | ST. ANNES HIGH SCHOOL</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="assets/mine/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/mine/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/mine/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="assets/mine/aos/aos.css" rel="stylesheet">

    <!-- Main CSS File -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Anton&family=Pacifico&family=Uchen&display=swap');



button.normal{
    font-size: 15px;
    font-weight: 600;
    padding: 15px 30px;
    color: black;
    background-color: white;
    cursor: pointer;
    border: none;
    outline: none;
    transition: 0.2s;
    box-shadow:0 10px 20px rgba(0,0,0.06) ;
}

button.white{
    font-size: 13px;
    font-weight: 600;
    padding: 11px 18px;
    color: black;
    background-color:transparent;
    cursor: pointer;
    border: 1px solid white;
    outline: none;
    transition: 0.2s;
    box-shadow:0 10px 20px rgba(0,0,0.06) ;
}

body{
    width:100%;
}



    /* home page*/
    #hero{
        background-image: url(assets\img\bgs\bg3.jpg);
        height: 90vh;
        width: 100%;
        background-size: cover;
        background-position: top 25% right 0;
        padding: 0 80px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;

    }

    #hero h4{
        padding-bottom: 15px;
        font-weight: bold;
    }

    #hero h1{
        color: blue;
    }


    #feature{
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        padding: 25px 25px;

    }

    #feature .fe-box{
        width: 180px;
        text-align: center;
        padding: 25px 15px;
        box-shadow: 20px 20px 34px rgba(0,0,0.03);
        border: 1px solid #cce7d0;
        border-radius: 4px;
        margin: auto;
    }

    #feature .fe-box:hover{
        box-shadow: 10px 10px 54px rgba(70,62,221, 0.1)
    }

    #feature .fe-box img{
        width:100%;
        margin-bottom: 10px;

    }

    #feature .fe-box h6{
        display: inline-block;
        padding: 9px 8px 6px 8px;
        line-height: 1;
        border-radius: 4px;
        color:black;
        background-color: green;
        cursor: pointer;
    }

     #product1 {
        text-align: center;
        padding: 40px;
     }
     #product1, #banner h2{
        padding-bottom: 15px;
        font-weight: bold;
    }

    #product1 h4{
        font-weight: bold;
    }

     #product1 .pro-container{
        display: flex;
        justify-content: space-between;
        padding: 20px;
        flex-wrap: wrap;

     }

     #product1 .pro {
        width: 23%;
        min-width: 250px;
        padding: 10px 12px;
        border: 1px solid #cce7d0;
        border-radius: 25px;
        cursor: pointer;
        box-shadow: 20px 20px 30px rgba(0,0,0.02);
        margin: 15px;
        transition: 0.2s ease;
        position: relative;
     }

     #product1 .pro:hover{
        box-shadow: 20px 20px 30px rgba(0,0,0.02);

     }

     #product1 .pro img{
        width: 100%;
        border-radius: 20px;
     }

     #product1 .pro .desc{
        text-align: start;
        padding: 10px 0;
        
     }

     #product1 .pro .desc span{
        color:red;
        font-size: 15px;
        font-weight: 700;

     }

     #product1 .pro .desc h2{
        padding-top: 7px;
        color: #1a1a1a;
        font-size: 20px;
     }

     #product1 .pro .desc i{
        font-size: 12px;
        color: rgba(243,181,25)
     }

     #product1 .pro .desc p{
        padding-top: 7px;
        font-size: 18px;
        font-weight: 700;
        
     }

     #product1 .pro .cart{
        width: 40px;
        height: 40px;
        line-height: 40px;
        border-radius: 50px;
        background-color: #0deb2e;
        font-weight: 500;
        color: #088178;
        border: 1px solid red;
        position: absolute;
        bottom: 20px;
        right: 10px;

     }

     #banner{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        background-image: url(img/banner/b18.jpg);
        width: 100%;
        height: 60vh;
        background-size: cover;
        background-position: center;
     }

     #banner h2 span{
        color: red;
        
     }

     #banner button:hover{
        background-color: #0deb2e;
        color: white;
     }

    /* Add these styles for profile section */
#profiles {
    display: flex;
    align-items: center;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 40px;
}

.pro-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    display: flex;
    padding: 20px;
}

.pro {
        width: 23%;
        min-width: 250px;
        padding: 10px 12px;
        border: 1px solid #cce7d0;
        border-radius: 25px;
        cursor: pointer;
        box-shadow: 20px 20px 30px rgba(0,0,0.02);
        margin: 15px;
        transition: 0.2s ease;
        position: relative;
}

.pro img {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
}

.pro:hover img {
    transform: scale(1.1);
}

.pro .desc {
    text-align: start;
    padding: 10px;
}

.pro p {
    color: #333;
    padding-top: 7px;
    font-size: 18px;
    font-weight: 700;
}


</style>
</head>

<body>
<section id="hero">
<div class="containerposition-relative" data-aos="zoom-in" data-aos-delay="100">
  <?php
     $ret=mysqli_query($link,"select * from tblpage where PageType='aboutus' ");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

              ?>
        
        <h1><?php  echo $row['name'];?></h1> <br> 
        <h2> <?php  echo $row['motto'];?></h2>
               <?php } ?>
  </div>
    </section>

    <section id="feature" class="section-p1">
    
        <div class="fe-box">
            <img src="assets\img\icon/cert.png"alt="">
            <h6>Best Performance</h6>

        </div>
        <div class="fe-box">
            <img src="assets\img\icon/thumbs.png"alt="">
            <h6>Good Morals</h6>

        </div>
        <div class="fe-box">
            <img src="assets\img\icon/holy-bible.png"alt="">
            <h6>Prayers</h6>

        </div>
        <div class="fe-box">
            <img src="assets\img\icon/doc.png"alt="">
            <h6>Physical and Mental Health</h6>

        </div>
        <div class="fe-box">
            <img src="assets\img\icon/graduate.png"alt="">
            <h6>Student Support</h6>

        </div>

    </section>

    <section id="product1" class="section-p1">
    <h2>Featured Teachers</h2>
    <h4>Meet our Teaching Community</h4>

    </section>


    <section id="profiles" class="section-p1">
    <div class="pro-container">
        <?php
        $teacherIds = array(); // To store teacher IDs to avoid repetition

        $query = mysqli_query($link, "SELECT * FROM teachers ORDER BY RAND() LIMIT 6");
        while ($row = mysqli_fetch_array($query)) {
            $teacherId = $row['id'];
            $teacherName = $row['name'];
            $teacherImage = $row['file'];

            // Check if the teacher is already displayed
            if (!in_array($teacherId, $teacherIds)) {
                $teacherIds[] = $teacherId; // Add teacher ID to the array

                // Display the teacher profile
                ?>
                <div class="pro">
                    <img src="module/images/<?php echo $teacherImage; ?>" alt="">
                    <div class="desc">
                        <p><?php echo $teacherName; ?></p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>


    </section>

    <section id="banner"class="section-m1">
        <h2>Unlock a World of Knowledge and Opportunities <span> – Enroll at </span> -   <?php
     $ret=mysqli_query($link,"select * from tblpage where PageType='aboutus' ");
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {

              ?>
        
        <h1><?php  echo $row['name'];?></h1> 
               <?php } ?></h2>

        <h4>Apply for admission </h4>
        <a href="admi.php">
        <button class="normal">JOIN US NOW</button>
        </a>
    </section>

    
    <?php include('footer.php'); ?>
    <!-- Footer -->

    </body>
    </html>

