<?php require_once("../include/functions.php") ?>
<!DOCTYPE html>
<html>
<head>
    <title>Flight Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script rel="script" type="text/javascript" src="javascript/jquery.min.js"></script>
    <script rel="script" type="text/javascript" src="javascript/bootstrap.min.js"></script>

    <?php if(isset($using_jquery_ui) && $using_jquery_ui == true):?>
        <!--Including jquery-ui CSS and JS -->
        <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
        <script src="jquery-ui/jquery-ui.min.js"></script>
    <?php endif;?>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Google Fonts: Raleway and Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Raleway|Source+Sans+Pro&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script type="text/javascript">
        $(document).ready(function(){
            $(".dropdown").hover(function(){
                var dropdownToggle = $(this).children(".dropdown-toggle");
                dropdownToggle.attr('aria-expanded', 'true');
                $(this).addClass('show');
                $(this).children(".dropdown-menu").addClass('show');
            });
            $(".dropdown").mouseleave(function(){
                var dropdownToggle = $(this).children(".dropdown-toggle");
                dropdownToggle.attr('aria-expanded', 'false');
                $(this).removeClass('show');
                $(this).children(".dropdown-menu").removeClass('show');
            });

        });
    </script>

</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-light border-bottom border-dark">
            <div class="container">
            <a class="navbar-brand" href="index.php">FlightBooking</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ml-auto mr-4">
                    <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'index.php')? 'active': ''?>">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'book_flight.php')? 'active': ''?>">
                        <a class="nav-link" href="book_flights.php">Book Flights</a>
                    </li>
                    <!--<li class="nav-item  <?php /*echo (basename($_SERVER['SCRIPT_NAME']) == 'about.php')? 'active': ''*/?>">
                        <a class="nav-link" href="#">About</a>
                    </li>-->
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['username'])):?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'profile.php')? 'active': ''?>" id="navbarDropdownMenuLink" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome, <?=$_SESSION['username']?></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="profile.php">View Profile</a>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    <?php else:?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'login.php')? 'active': ''?>" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'register.php')? 'active': ''?>" href="register.php">Register</a>
                        </li>
                    <?php endif;?>
                </ul>
            </div>
            </div>
        </nav>
    <?php display_message();?>


