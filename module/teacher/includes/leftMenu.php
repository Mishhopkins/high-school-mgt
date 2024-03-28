<h4 style="background: linear-gradient(to bottom, #ff6a00, #ee0979); color: blue; padding: 10px; border-radius: 5px;">
Hi! Teacher <?php echo $check." ";?>
</h4>
                  
<aside id="left-panel" class="left-panel" style="background: #ff6a00;">
<nav class="navbar navbar-expand-sm navbar-default" style="background: linear-gradient(to top, #ff6a00, blue);">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                <li class="menu-title" style="color: white;">TEACHER: &nbsp;&nbsp;&nbsp;<?php echo ucfirst($loged_user_name);?></li>
                    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>">
                        <a href="index.php" style="color: black;"><i class="menu-icon fa fa-dashboard" style="color: black;"></i>Dashboard </a>
                    </li>
                    
                    <li class="menu-item-has-children dropdown <?php if($page=='My students'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-users" style="color: white;"></i>My students</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-eye" style="color: black;"></i><a href="viewStudent.php" style="color: black;">View students</a></li>
                        </ul>
                    </li>


                    <li class="menu-item-has-children dropdown <?php if ($page == 'Gradebook') { echo 'active'; } ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                            <i class="menu-icon fa fa-book" style="color: white;"></i>Gradebook
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            
                        <li><i class="fa fa-edit" style="color: black;"></i><a href="manageExams.php" style="color: black;">Manage Exams</a></li>
                        <li><i class="fa fa-eye" style="color: black;"></i> <a href="studentResult.php" style="color: black;"> View Result</a></li>
                             <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewFinalResult.php" style="color: black;"> Final Result</a></li>
                            <li><i class="fa fa-list-alt" style="color: black;"></i><a href="manageAssignments.php" style="color: black;">Manage Assignments</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewAssignments.php" style="color: black;"> View Assignments</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown <?php if ($page == 'Attendance') { echo 'active'; } ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                                <i class="menu-icon fa fa-edit" style="color: white;"></i>Attendance </a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-pencil" style="color: black;"></i><a href="takeAttendance.php" style="color: black;">Take Attendance</a></li>
                                <li><i class="fa fa-eye" style="color: black;"></i><a href="viewAttendance.php" style="color: black;">View Attendance</a></li>
                                <li><i class="fa fa-file-alt" style="color: black;"></i><a href="attendanceReports.php" style="color: black;">Attendance Reports</a></li>
                            </ul>
                        </li>


                    <li class="menu-item-has-children dropdown <?php if($page=='payroll'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-dollar" style="color: white;"></i>Payrolls</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-eye" style="color: black;"></i><a href="viewpayroll.php" style="color: black;">View Payrolls</a></li>
                        </ul>
                    </li>
                                   
                    <!-- <li class="menu-title">Profile</li>/.menu-title -->
                    <li class="menu-item-has-children dropdown <?php if($page=='profile'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-user" style="color: white;"></i>Profile</a>
                        <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-eye" style="color: black;"></i><a href="my_account.php" style="color: black;"> view Profile</a></li>
                            <li><i class="menu-icon fa fa-user-circle" style="color: black;"></i><a href="updateProfile.php" style="color: black;"> Update Profile</a></li>
                            </li>
                        </ul>
                         <li>
                        <a href="logout.php" style="color: white;"> <i class="menu-icon fa fa-power-off" style="color: white;"></i>Logout </a>
                    </li>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>

                   
        </nav>
    </aside>