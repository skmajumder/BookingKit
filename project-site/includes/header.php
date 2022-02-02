<?php include 'functions/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="600;url=logout.php"/>
    <title>Booking.com</title>

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/vendors.css" rel="stylesheet">
    <link href="css/icon_fonts/css/all_icons_min.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="css/date_picker.css" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Modernizr -->
    <script src="js/modernizr.js"></script>

    <!-- Ajax -->
    <script src="js/ajax.js"></script>
    <script src="js/ajax_validation.js"></script>

</head>

<body>

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<header class="header_sticky">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div id="logo_home">
                    <h1><a href="index.php" title=""></a></h1>
                </div>
            </div>
            <nav class="col-lg-9 col-6">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
                <ul id="top_access">
                    <?php if (get_logged_in()) : ?>
                        <?php
                        if ($_SESSION['user_cat'] === 1) {
                            $profile_path = 'author/industry';
                        }
                        if ($_SESSION['user_cat'] === 2) {
                            $profile_path = 'author/academy';
                        }
                        if ($_SESSION['user_cat'] === 3) {
                            $profile_path = 'author/student';
                        }
                        if ($_SESSION['user_cat'] === 4) {
                            $profile_path = 'author/admin';
                        }
                        ?>
                        <li id="user">
                            <a href="<?php echo $profile_path; ?>" class="account-btn">
                                My Account
                            </a>
                        </li>
                    <?php else: ?>
                        <li id="user">
                            <a href="#0" class="account-btn">
                                Visit Account
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
                <div class="main-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <?php if (get_logged_in()) : ?>
                            <li><a href="list.php">Listings</a></li>
                            <li><a href="students.php">Student List</a></li>
                            <?php if ($_SESSION['user_cat'] === 3) : ?>
                                <li><a href="notice.php">Notice</a></li>
                            <?php endif; ?>
                            <li><a href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="register.php">Register</a></li>
                            <li><a href="login.php">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- /main-menu -->
            </nav>
        </div>
    </div>
    <!-- /container -->

</header>
<!-- /header -->
