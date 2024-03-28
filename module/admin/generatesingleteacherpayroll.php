<?php
// session_start();
error_reporting(0);
include('main.php');
include('../../service/dbconnection.php');
$sql = "SELECT * FROM payrolls;";
$res = mysqli_query($link, $sql);

if (isset($_GET['generatePayrollId'])) {
    $payrollId = $_GET['generatePayrollId'];
    $_SESSION['generatePayrollId'] = $payrollId;

    $query = mysqli_query($link, "SELECT * FROM payrolls WHERE payrollno = '$_SESSION[generatePayrollId]'");
    $rowi = mysqli_fetch_array($query);

    // Retrieve additional data for the payslip
    $payrollNumber = $rowi['payrollno'];
    $teacherName = $rowi['payname'];
    $teacherID = $rowi['Teacher_id'];
    $payrollDate = date("d/m/Y - h:m:s", strtotime($rowi['paydategen']));
    $teacherSalary = $rowi['paysalary'];
    $payStatus = $rowi['paystatus'];
    $payDescription = $rowi['pay_description'];

    $mysqlDateTime = $rowi['paydategen']; // trim timestamp to DD/MM/YYYY format
} else {
    echo "<script type=\"text/javascript\">
    window.location = (\"viewpayroll.php\")
    </script>";
}
?>

<!doctype html>
<html class="no-js" lang=""> 

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include 'includes/title.php'; ?>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="../../assets/img/icon/student-grade.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/pixeden-stroke-7-icon@1.2.3/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <link rel="stylesheet" href="../../assets/css/style2.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
    <?php $page = "result"; include 'includes/leftMenu.php'; ?>
    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include 'includes/header.php'; ?>
        <!-- /header -->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li><a href="#">Manage Payrolls</a></li>
                                    <li class="active">Generate Payroll</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Add your content here -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                           
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">
                                        <img src="../../assets/img/logos/logo.png" alt="" height="100">
                                    </div>
                                    <div class="float-right">
                                        <h3 class="m-0 d-print-none"><?php echo $teacherName; ?>'s Payroll</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <p><b></b></p>
                                            <p class="text-muted"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 offset-md-2">
                                        <div class="mt-3 float-right">
                                            <p class="m-b-10"><strong>Generated Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo date("d-m-Y - h:m:s", strtotime($mysqlDateTime)); ?> </span></p>
                                            <p class="m-b-10"><strong>Payroll Status : </strong> <span class="float-right"><span class="badge badge-success"> <?php echo isset($rowi['paystatus']) ? $rowi['paystatus'] : 'N/A'; ?> </span></span></p>
                                            <p class="m-b-10"><strong>Payroll Number. : </strong> <span class="float-right"><?php echo isset($rowi['payrollno']) ? $rowi['payrollno'] : 'N/A'; ?></span></p>
                                            <p class="m-b-10"><strong>Teacher Number. : </strong> <span class="float-right"><?php echo isset($rowi['Teacher_id']) ? $rowi['Teacher_id'] : 'N/A'; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mt-4 table-centered table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Employee Department</th>
                                                        <th style="width: 10%">Salary</th>
                                                        <th style="width: 10%">(PAYE)Tax Rate</th>
                                                        <th style="width: 10%" class="text-right">Total Tax</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $ret = mysqli_query($link, "SELECT teachers.id, departments.department_name, payrolls.payname, payrolls.paysalary 
                                                        FROM payrolls
                                                        INNER JOIN teachers ON payrolls.Teacher_id = teachers.id
                                                        INNER JOIN departments ON teachers.department = departments.department_id");
                                                    $cnt = 1;
                                                    while ($row = mysqli_fetch_array($ret)) {
                                                        $tax = 16 / 100;
                                                        $teacherSalary = $row['paysalary'];
                                                        $taxable_salary = $tax * $teacherSalary;
                                                        //get total salary after tax reduction
                                                        $total_salary = $teacherSalary - $taxable_salary;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $cnt; ?></td>
                                                            <td><?php echo $row['department_name']; ?></td>
                                                            <td>Kshs.<?php echo $teacherSalary; ?></td>
                                                            <td>16%</td>
                                                            <td class="text-right">Kshs.<?php echo $taxable_salary; ?></td>
                                                        </tr>
                                                    <?php
                                                        $cnt = $cnt + 1;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="clearfix pt-5">
                                            <h6 class="text-muted">NB:</h6>
                                            <small class="text-muted">
                                                <?php echo isset($rowi['pay_description']) ? $rowi['pay_description'] : 'N/A'; ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="float-right">
                                            <p><b>Sub-total:</b> <span class="float-right">Kshs. <?php echo isset($teacherSalary) ? $teacherSalary : 'N/A'; ?></span></p>
                                            <p><b>PAYE Tax (16%) :</b> <span class="float-right"> &nbsp;&nbsp;&nbsp;Kshs. <?php echo isset($taxable_salary) ? $taxable_salary : 'N/A'; ?> </span></p>
                                            <h2>Kshs. <?php echo isset($total_salary) ? $total_salary : 'N/A'; ?></h2>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="mt-4 mb-1">
                                    <div class="text-right d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fas fa-print mr-1"></i> Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        <div class="clearfix"></div>

        <?php include 'includes/footer.php'; ?>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    <script src="../../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../../assets/js/init/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });

        // Menu Trigger
        $('#menuToggle').on('click', function(event) {
            var windowWidth = $(window).width();
            if (windowWidth < 1010) {
                $('body').removeClass('open');
                if (windowWidth < 760) {
                    $('#left-panel').slideToggle();
                } else {
                    $('#left-panel').toggleClass('open-menu');
                }
            } else {
                $('body').toggleClass('open');
                $('#left-panel').removeClass('open-menu');
            }
        });
    </script>
</body>

</html>
