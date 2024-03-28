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
.container {
 padding: 2rem;
}
.slider-wrapper {
    position: relative;
    width: 100%;
    margin-top: 100px;
}
.slider {
    display: flex;
    aspect-ratio: 16 / 9;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    box-shadow: 0 1.5rem 3rem -0.75rem hsla(0, 0%, 0%, 0.25);
    border-radius: 5px;
}
.slider img {
    flex: 1 0 100%;
    scroll-snap-align: start;
    object-fit: cover;
}

.slider-nav {
    display: flex;
    column-gap: 1rem;
    position: absolute;
    bottom: 1.25rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
}

.slider-nav a {
    width: 1.0rem;
    height: 1.0rem;
    border-radius: 50%;
    background-color: #fff;
    opacity: 0.75;
    transition: opacity ease 250ms;
}

.slider-nav a:hover{
    opacity: 1;
}

@keyframes slide {
    0%, 100% {
        transform: translateX(0);
    }
    33.3%, 66.6% {
        transform: translateX(-100%);
    }
}

/* Styling for Testimonial Part */
#testimonial {
        background-color: #f9f9f9;
    }

    .testimonial-content {
        padding: 100px 0;
    }

    .testimonial-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .testimonial-title h2 {
        font-size: 36px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .testimonial-title h5 {
        font-size: 18px;
        font-weight: 400;
        color: #666;
    }

    .testimonial-quote {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }

    .testimonial-quote i {
        font-size: 32px;
        color: #3498db;
        margin-right: 15px;
    }

    .testimonial-text {
        font-size: 18px;
        color: #666;
        text-align: center;
        margin-bottom: 20px;
    }

    .testimonial-author {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }

    .testimonial-role {
        font-size: 16px;
        color: #666;
        text-align: center;
    }

/* Styling for Video Feature Part */
#video-feature {
        background-image: url("assets/img/bgs/EmpClass.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Optional, use this if you want a fixed background */
    }

    .video i {
        width: 120px;
        height: 120px;
        line-height: 120px;
        text-align: center;
        font-size: 24px;
        background-color: #ffc600;
        color: #07294d;
        border-radius: 50%;
    }

    .video-feature-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .video-feature-title h3 {
        font-size: 36px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .feature-list {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    height: 100%;
    width: 100%;
}

    .feature-list-item {
        display: flex;
        margin-bottom: 20px;
    }

    .feature-icon {
       float: left;
       overflow: hidden;
       display: inline-block;
       padding-right: 30px;
}


    .feature-icon img {
        max-width: 100%;
        height: auto;
    }

    .feature-details {
        flex: 1;
        padding-left: 20px;
        width: auto;
       float: left;
       overflow: hidden;
    }

    .feature-details h4 {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
}
    

    .feature-details p {
        font-size: 16px;
        color: #666;
    }

/* Styling for Teachers Part */
#teachers-part {
        background-color: #f9f9f9;
    }

    .teachers-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .teachers-title h5 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .teachers-title h2 {
        font-size: 36px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .teachers-description {
        font-size: 18px;
        color: #666;
        line-height: 1.6;
    }

    .read-more-btn {
        display: inline-block;
        margin-top: 30px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .read-more-btn:hover {
        background-color: #0056b3;
    }

    .teacher-list {
        list-style: none;
        padding-left: 0;
        margin-top: 50px;
    }

    .teacher-list-item {
        margin-bottom: 30px;
    }

    .teacher-image {
        width: 100%;
    }

    .teacher-name {
        font-size: 20px;
        color: #333;
        margin-top: 10px;
    }

    .teacher-role {
        font-size: 16px;
        color: #666;
    }

    /* Testimonials Part */

    #testimonials {
            background-position: center;
            background-size: cover;
            position: relative;
    }

        .section-title{
            text-align: center;
            margin-bottom: 40px;
        }

        .testimonials-slider {
            display: flex;
            overflow: hidden;
            /* animation: slide 8s infinite; */
            display: flex;
            aspect-ratio: 16 / 9;
            overflow-x: auto;
           scroll-snap-type: x mandatory;
           scroll-behavior: smooth;
           box-shadow: 0 1.5rem 3rem -0.75rem hsla(0, 0%, 0%, 0.25);
           border-radius: 5px;
        }

        .testimonials-item {
            flex: 0 0 50%;
            padding: 20px;
            opacity: 0;
            flex: 1 0 100%;
           scroll-snap-align: start;
           object-fit: cover;
            transform: translateX(100%);
            transition: opacity 1s, transform 1s;
        }

        .testimonials-slider .testimonials-item.active {
            opacity: 1;
            transform: translateX(0);
        }

        .testimonials-thumb .quote {
            font-size: 24px;
            color: #ff4c07;
            margin-bottom: 20px;
        }

        .testimonials-content h6 {
            font-size: 18px;
            font-weight: 600;
            margin-top: 20px;
        }

        .testimonials-content span {
            display: block;
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        @keyframes slide {
            0%, 100% {
                transform: translateX(0);
                opacity: 1;
            }
            20%, 80% {
                transform: translateX(-100%);
                opacity: 0;
            }
            25%, 75% {
                transform: translateX(100%);
                opacity: 0;
            }
        }
</style>
  
</head>

<body>
    <!-- Preloader -->
    <div class="preloader" style="display: none;">
        <!-- Preloader content -->
    </div>

    <!-- Slider Section -->
    <section class="container">
        <div class="slider-wrapper">
            <div class="slider">
                <img id="slide-1" src="assets/img/logos/logo1.png" alt="">
                <img id="slide-2" src="assets\img\bgs\bg3.jpg" alt="">
                <img id="slide-3" src="assets\img\bgs\bg2.jpg" alt="">
            </div>
            <div class="slider-nav">
                <a href="#slide-1"></a>
                <a href="#slide-2"></a>
                <a href="#slide-3"></a>
            </div>
        </div>
    </section>

  <!-- Testimonial Part -->
  <section id="testimonial">
        <div class="testimonial-content container">
        <?php
                $ret=mysqli_query($link,"select * from tblpage where PageType='aboutus' ");
                $cnt=1;
                while ($row=mysqli_fetch_array($ret)) {
                ?>
            <div class="testimonial-title">
                <h2>Welcome to <?php echo $row['name']; ?></h2>
                <h5><?php echo $row['motto']; ?></h5>
            </div>
            <div class="testimonial-quote">
                <i class="fa fa-quote-left"></i>
                <div class="testimonial-text">
                    At <?php echo $row['name']; ?>, <?php echo $row['PageDescription']; ?>
                </div>
                <i class="fa fa-quote-right"></i>
            </div>
            <div class="testimonial-author">
                Dr. Jane Doe
            </div>
            <div class="testimonial-role">
                Principal, <?php echo $row['name']; ?>
            </div>
            <?php } ?>
        </div>
    </section>

      <!-- Video Feature Section -->
      <section id="video-feature">
        <div class="video-feature-content container">
            <div class="video-feature-title">
                <h3>Experience Our Facilities</h3>
            </div>
            <div class="row align-items-center">
            <div class="col-lg-6 order-last order-lg-first">
                    <div class="video text-lg-left text-center pt-50">
                        <a class="Video-popup" href="https://youtu.be/6S5OwAjHh5c">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1 order-first order-lg-last">
                    <ul class="feature-list">
                        <li class="feature-list-item">
                            <div class="feature-icon">
                                <img src="assets\img\icon/cert.png" alt="icon">
                            </div>
                            <div class="feature-details">
                                <h4>K.C.S.E Performance</h4>
                                <p>At ST. ANNES HIGH SCHOOL, we pride ourselves in consistently achieving outstanding K.C.S.E results, setting a benchmark for excellence.</p>
                            </div>
                        </li>
                        <li class="feature-list-item">
                            <div class="feature-icon">
                                <img src="assets\img\icon/graduate.png" alt="icon">
                            </div>
                            <div class="feature-details">
                                <h4>Student Support Systems</h4>
                                <p>We are dedicated to nurturing students' holistic growth - mentally, spiritually, academically, and physically, providing comprehensive support systems.</p>
                            </div>
                        </li>
                        <li class="feature-list-item">
                            <div class="feature-icon">
                                <img src="assets\img\icon/book.png" alt="icon">
                            </div>
                            <div class="feature-details">
                                <h4>World Class Libraries</h4>
                                <p>Our school libraries are a sanctuary of knowledge, fostering an environment of exploration, learning, and imagination.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="feature-bg"></div>
    </section>
    <!-- End of Video Feature Section -->

      <!-- Teachers Part Section -->
      <section id="teachers-part">
        <div class="teachers-content container">
            <div class="teachers-title">
                <h5>Meet Our Dedicated Teachers</h5>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="teachers-description">
                        <p>Over the many years of our existence, ST. ANNES HIGH SCHOOL has soared high and established itself as one of Kenya's top-performing learning institutions.</p>
                        <p>We take immense pride in this outstanding academic performance and remain committed to onboarding the best, most talented, and effective teachers who passionately nurture and educate our boys to excel both academically and ethically.</p>
                        <p>Guided by our motto, ST. ANNES HIGH SCHOOL is dedicated to providing comprehensive education, instilling values, and mentoring our students to become not only top scholars but also men of integrity in all aspects of life.</p>
                        <p>On behalf of the school’s management and staff, we warmly welcome you to explore the rich educational journey that ST. ANNES HIGH SCHOOL offers.</p>
                    </div>
                    <a href="#" class="read-more-btn">Read More</a>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <ul class="teacher-list">
                        <li class="teacher-list-item">
                            <div class="teacher-image">
                                <img src="assets\img\users/avatarm7-min1.jpg" alt="Teachers">
                            </div>
                            <div class="teacher-name">
                                <a href="teachers-singel.php">Mr. Caspal Maina</a>
                            </div>
                            <div class="teacher-role">
                                The Chief Principal
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Teachers Part Section -->


    <!-- Testimonials Part Section -->
    <section id="testimonials" class="bg_cover pt-115 pb-115" data-overlay="8" style="background-image: url(images/pichapatch/admin7.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-40">
                        <h5>Testimonials</h5>
                        <h2>What Our Community Says</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->

            <div class="row testimonials-slider mt-40">
                <!-- Testimonial Item 1 -->
                <div class="col-lg-6 testimonials-item active">
                    <div class="testimonials-thumb">
                        <div class="quote">
                            <i class="fa fa-quote-right"></i>
                        </div>
                    </div>
                    <div class="testimonials-content">
                        <p>
                            "My son, like all children, was born with a “love of learning”. As he started progressing in the school district, he became bored, complacent, and restless. His “love of learning” quickly deteriorated and began to manifest as behavioral issues that included acting out and apathy toward learning.
                            <br>
                            The answer was simple. I found a school that challenged him enough to feed his “love of learning”, acknowledge his individuality, and guide him to 'do the right thing'. I found this in ST ANNES HIGH SCHOOL."
                        </p>
                        <h6>Dr. Jamal Mohammed</h6>
                        <h5>Parent</h5>
                    </div>
                </div>

                 <!-- Testimonial Item 2 -->
                 <div class="col-lg-6 testimonials-item active">
                    <div class="testimonials-thumb">
                        <div class="quote">
                            <i class="fa fa-quote-right"></i>
                        </div>
                    </div>
                    <div class="testimonials-content">
                    <p>
                        "Witnessing my son's transformation has been nothing short of remarkable. Like a caterpillar evolving into a butterfly, his journey at ST ANNES HIGH SCHOOL has unveiled his true potential. From the cocoon of mere routine, he emerged as a vibrant, curious learner eager to explore the world.
                       <br>
                       The spark of his "love of learning" rekindled as he embraced challenges that nurtured his individuality and led him to pathways of wisdom. His journey to 'do the right thing' was guided by the nurturing environment of ST ANNES HIGH SCHOOL."
                    </p>
                        <h6>Mrs. Faith Moraa</h6>
                        <h5>Parent</h5>
                    </div>
                </div>
                
                <!-- Add more testimonial items as needed -->
                
            </div> <!-- testimonials-slider -->
        </div> <!-- container -->
    </section>
    <!-- End of Testimonials Part Section -->


    <?php include('footer.php'); ?>
    <!-- Footer -->

    <script>
    // JavaScript to toggle teacher descriptions
    const readMoreButtons = document.querySelectorAll('.read-more-btn');
    readMoreButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const teacherDescription = button.previousElementSibling;
            teacherDescription.classList.toggle('show-description');
        });
    });
</script>

    <script>
    const slider = document.querySelector('.slider');

    function autoSlide() {
        const currentScroll = slider.scrollLeft;
        const newScroll = currentScroll + slider.clientWidth;

        if (newScroll >= slider.scrollWidth) {
            slider.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
        } else {
            slider.scrollTo({
                left: newScroll,
                behavior: 'smooth'
            });
        }
    }

    let intervalId = setInterval(autoSlide, 1300);

    // Adjust scroll behavior on user interaction
    slider.addEventListener('mouseenter', () => {
        clearInterval(intervalId);
    });

    slider.addEventListener('mouseleave', () => {
        intervalId = setInterval(autoSlide, 1300);
    });
</script>


</body>
</html>