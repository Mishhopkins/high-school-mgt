<h4 style="background: linear-gradient(to bottom, #ff6a00, #ee0979); color: blue; padding: 10px; border-radius: 5px;">
Hi!admin <?php echo $check." ";?>
</h4>

<aside id="left-panel" class="left-panel" style="background: #ff6a00;">
<nav class="navbar navbar-expand-sm navbar-default" style="background: linear-gradient(to top, #ff6a00, blue);">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                
                <li class="menu-title" style="color: white;">ADMIN: &nbsp;&nbsp;&nbsp;<?php echo ucfirst($loged_user_name);?></li>
                    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>">
                        <a href="index.php" style="color: black;"><i class="menu-icon fa fa-dashboard" style="color: black;"></i>Dashboard </a>
                    </li>

                    <li class="menu-item-has-children dropdown <?php if($page=='admin'){ echo 'active'; }?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-user" style="color: white;"></i>Admin</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-plus" style="color: black;"></i><a href="createAdmin.php">Add Administrator</a></li>
                                <li><i class="fa fa-eye" style="color: black;"></i><a href="viewAdmin.php">View Administrator</a></li>
                            </ul>
                        </li> 

                        <li class="menu-item-has-children dropdown <?php if($page=='pages'){ echo 'active'; }?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-book" style="color: white;"></i>Manage Pages</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-plus" style="color: black;"></i><a href="contact_us.php">contact Us</a></li>
                                <li><i class="fa fa-eye" style="color: black;"></i><a href="about_us.php">About Us</a></li>
                            </ul>
                        </li> 
                  
                 <li class="menu-item-has-children dropdown <?php if($page=='session'){ echo 'active'; }?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-cogs" style="color: white;"></i>Manage Session</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus" style="color: black;"></i> <a href="createSession.php">Add New Session</a></li>
                        <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewSession.php">view Session</a></li>
                    </ul>
                </li>

                
                <li class="menu-item-has-children dropdown <?php if($page=='departments'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-book" style="color: white;"></i>Manage Departments</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addDepartment.php">Add Department</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewDepartment.php">View Departments</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown <?php if($page=='Accomodation'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-house" style="color: white;"></i>Accomodation</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addHostels.php">Add Hostels</a></li>

                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addRooms.php">Add Hostel-Rooms</a></li>

                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addBeds.php">Add Beds</a></li>
                        </ul>
                    </li>

                <li class="menu-item-has-children dropdown <?php if($page=='subject'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-book" style="color: white;"></i>Manage Subjects</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addSubject.php">Add New Subjects</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewSubject.php">View Subjects</a></li>
                        </ul>
                    </li>
                   

                    <li class="menu-title">Student Section</li>
                    <li class="menu-item-has-children dropdown <?php if($page=='class'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-users" style="color: white;"></i>ManageClass</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addClass.php">Add New Class</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewClasses.php">View Classes</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown <?php if($page=='student'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-users" style="color: white;"></i>Manage Students</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="AddStudent.php">Add Students</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewStudent.php">View Students</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown <?php if($page=='parent'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-users" style="color: white;"></i>Manage Parents</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addParent.php">Add Parent</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewParent.php">View Parent</a></li>
                        </ul>
                    </li>
                 
                    <li class="menu-title">Staff</li>
                    <li class="menu-item-has-children dropdown <?php if($page=='teacher'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-th" style="color: white;"></i>Manage Teachers</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addTeacher.php">Add New Teacher</a></li>
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="assign_teacher.php">Assign Teacher</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewTeacher.php">View Teachers</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-item-has-children dropdown <?php if($page=='staff'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-bars" style="color: white;"></i>Manage Staff</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="addStaff.php">Add New Staff</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewStaff.php">View Staff</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">Exams and Results</li>
                      <li class="menu-item-has-children dropdown <?php if($page=='exams'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-file" style="color: white;"></i>Manage Exams</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="examschedule.php">Exam Shedhule</a></li>
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="manageAssingnments.php">Manage Assignments</a></li>
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="viewResults.php">View/Print Result</a></li>                     
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="gradingCriteria.php">View Grading Criteria</a></li>

                        </ul>
                    </li>

                    <li class="menu-title">Payrolls</li>
                    <li class="menu-item-has-children dropdown <?php if($page=='staff'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-bars" style="color: white;"></i>Manage Payrolls</a>
                        <ul class="sub-menu children dropdown-menu">
                           <li><i class="fa fa-plus" style="color: black;"></i> <a href="addpayroll.php">Add Payrolls</a></li>
                            <li><i class="fa fa-eye" style="color: black;"></i> <a href="viewpayroll.php">View Payrolls</a></li>
                            <li><i class="fa fa-plus" style="color: black;"></i> <a href="generatepayroll.php">Generate Payrolls</a></li>
                        </ul>
                    </li>
                    

                    <li class="menu-title">Account</li>
                    <li class="menu-item-has-children dropdown <?php if($page=='profile'){ echo 'active'; }?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="color: white;"> <i class="menu-icon fa fa-user-circle" style="color: white;"></i>Profile</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-user" style="color: black;"></i> <a href="updateProfile.php">Update Profile</a></li>
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