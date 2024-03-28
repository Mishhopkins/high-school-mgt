
<?php
include_once('../../service/dbconnection.php');
include_once('main.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'includes/title.php'; ?>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="../../assets/img/icon/student-grade.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../../assets/css/style2.css">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <style>
        /* Your custom styles here */
    </style>
</head>
<body>
    <!-- Left Panel -->
    <?php $page = "profile"; include 'includes/leftMenu.php'; ?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row m-0">
                                    <div class="col-sm-4">
                                        <div class="page-header float-left">
                                            <div class="page-title">
                                                <h1>&nbsp;&nbsp;&nbsp;<?php echo ucfirst($loged_user_name); ?>'s Profile</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="page-header float-right">
                                            <div class="page-title">
                                                <ol class="breadcrumb text-right">
                                                    <li><a href="index.php">Dashboard</a></li>
                                                    <li><a href="#">profile</a></li>
                                                    <li class="active">View my profile</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                    <div class="card-box text-center bg-white" style="border-radius: 20px; padding: 20px; border: 5px solid black;">
                            <?php
                            $sql = "SELECT * FROM teachers WHERE id='$check';";
                            $res = mysqli_query($link, $sql);
                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <img src="../images/<?php echo $row['file']; ?>" alt="<?php echo $check ?>" style="width: 100px; height: 100px; border-radius: 50%;">
                                <div class="text-centre mt-1">
                                    <p class="text-dark mt-1 m-0"><strong>Teacher Full Name:</strong> <?php echo $row['name']; ?> </p>
                                    <p class="text-dark mt-1 m-0"><strong>Teacher Number:</strong> <?php echo $row['id']; ?> </p>
                                    <p class="text-dark mt-1 m-0"><strong>Teacher Phone:</strong> <?php echo $row['phone']; ?></p>
                                    <p class="text-dark mt-1 m-0"><strong>Teacher Email:</strong> <?php echo $row['email']; ?></p>
                                    <p class="text-dark mt-1 m-0"><strong>Date Hired:</strong> <?php echo $row['hiredate']; ?></p>
                                    <p class="text-dark mt-1 m-0"><strong>Address:</strong> <?php echo $row['address']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <?php

                                // Fetch subjects and classes assigned to the teacher
                                $assignmentQuery = mysqli_query($link, "SELECT subjects.subjectName, classes.class_name, teacher_subjects.date_assigned
                                    FROM teacher_subjects
                                    LEFT JOIN subjects ON subjects.id = teacher_subjects.subject_id
                                    LEFT JOIN classes ON classes.id = teacher_subjects.class_id
                                    WHERE teacher_subjects.teacher_id = '$check'");

                                ?>

                                <div class="col-lg-6 col-xl-6">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Subjects Assigned</th>
                                                    <th>Classes Assigned</th>
                                                    <th>Date Assigned</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                
                                                // Loop through and display subjects and classes assigned
                                                while ($assignmentRow = mysqli_fetch_assoc($assignmentQuery)) {
                                                    echo "<tr>";
                                                    echo "<td>{$assignmentRow['subjectName']}</td>";
                                                    echo "<td>{$assignmentRow['class_name']}</td>";
                                                    echo "<td>{$assignmentRow['date_assigned']}</td>";
                                                    echo "</tr>";
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                <!-- /.row -->

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <!-- <script src="../assets/js/main.js"></script> -->
    <script src="../../assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="../../assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="../../assets/js/init/fullcalendar-init.js"></script>

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function ($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1, 32]], color: '#5c6bc0' },
                { label: "Tab visits", data: [[1, 33]], color: '#ef5350' },
                { label: "Mobile visits", data: [[1, 35]], color: '#66bb6a' }
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1, 65]], color: '#5b83de' },
                { label: "Channel Sell", data: [[1, 35]], color: '#00bfa5' }
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                }, grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2, 4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'), [{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
                {
                    series: {
                        lines: {
                            show: true,
                            lineColor: '#fff',
                            lineWidth: 2
                        },
                        points: {
                            show: true,
                            fill: true,
                            fillColor: "#ffffff",
                            symbol: "circle",
                            radius: 3
                        },
                        shadowSize: 0
                    },
                    points: {
                        show: true,
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        show: false
                    }
                });
            // Line Chart  #flotLine5 End
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    series: [
                        [0, 18000, 35000, 25000, 22000, 0],
                        [0, 33000, 15000, 20000, 15000, 300],
                        [0, 15000, 28000, 15000, 30000, 5000]
                    ]
                }, {
                    low: 0,
                    showArea: true,
                    showLine: false,
                    showPoint: false,
                    fullWidth: true,
                    axisX: {
                        showGrid: true
                    }
                });

                chart.on('draw', function (data) {
                    if (data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById("TrafficChart");
                ctx.height = 150;
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                        datasets: [
                            {
                                label: "Visit",
                                borderColor: "rgba(4, 73, 203,.09)",
                                borderWidth: "1",
                                backgroundColor: "rgba(4, 73, 203,.5)",
                                data: [0, 2900, 5000, 3300, 6000, 3250, 0]
                            },
                            {
                                label: "Bounce",
                                borderColor: "rgba(245, 23, 66, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(245, 23, 66,.5)",
                                pointHighlightStroke: "rgba(245, 23, 66,.5)",
                                data: [0, 4200, 4500, 1600, 4200, 1500, 4000]
                            },
                            {
                                label: "Targeted",
                                borderColor: "rgba(40, 169, 46, 0.9)",
                                borderWidth: "1",
                                backgroundColor: "rgba(40, 169, 46, .5)",
                                pointHighlightStroke: "rgba(40, 169, 46,.5)",
                                data: [1000, 5200, 3600, 2600, 4200, 5300, 0]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                });
            }
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13], [8, 5], [10, 7], [12, 4], [14, 6], [16, 15], [18, 9], [20, 17], [22, 7], [24, 4], [26, 9], [28, 11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });

        // Menu Trigger
$('#menuToggle').on('click', function(event) {
  var windowWidth = $(window).width();   		 
  if (windowWidth<1010) { 
    $('body').removeClass('open'); 
    if (windowWidth<760){ 
      $('#left-panel').slideToggle(); 
    } else {
      $('#left-panel').toggleClass('open-menu');  
    } 
  } else {
    $('body').toggleClass('open');
    $('#left-panel').removeClass('open-menu');  
  } 
     
}); 

 
$(".menu-item-has-children.dropdown").each(function() {
  $(this).on('click', function() {
    var $temp_text = $(this).children('.dropdown-toggle').html();
    $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>'); 
  });
});
    </script>
</body>

</html>