<header id="header" class="header" style="background: linear-gradient(to right, #ee0979, #ff6a00 ); color: white;">
    <div class="top-left">
        <div class="navbar-header" style="color: blue;">
            <a class="navbar-brand" href="./">School Management System</a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
                <button class="search-trigger"><i class="fa fa-search"></i></button>
                <div class="form-inline">
                    <form class="search-form">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                            aria-label="Search">
                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                    </form>
                </div>
            </div>

            <div class="user-area dropdown float-right">
                <?php
                $sql = "SELECT * FROM students WHERE id='$check';";
                $res = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_array($res)) {
                ?>
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="../images/<?php echo $row['file']; ?>"
                            alt="<?php echo $check ?>" style="width: 50px; height: 50px; alt="User Avatar">
                    <?php } ?>
                    </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="updateProfile.php"><i class="fa fa-user"></i>My Profile</a>

                    <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>

<script src="../../assets/js/main.js"></script>
