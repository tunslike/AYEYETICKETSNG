<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600&family=Rubik:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/styles/default.min.css">
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo URLROOT ?>/public/css/fontawesome/css/all.css?v=<?php echo rand(10000000000,99999999999); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/home.css?v=<?php echo rand(10000000000,99999999999); ?>">
    <script async src="https://maps.googleapis.com/maps/api/js?key=<?php echo GoogleAPIKeys; ?>&libraries=places&callback=initMap"></script>
</head>
<body>
<div class="wrapper">

<header>
<div class="topDiv">
<div class="helpText">
        <i style="margin-right:5px;" class="fas fa-question-circle"></i> Need help? contact <span class="helpColor"><i class="fas fa-envelope" style="margin-right:5px;"></i> help@ayeyetickets.com  <span style="margin-left: 15px;"><i class="fas fa-phone-alt" style="margin-right:5px;"></i> 0709 9839 890</span><span> (HOTLINE)</span></span>
        </div>
        <div class="topnavright">
            <p>
            <?php if(isset($_SESSION['user_id'])) : ?>
                <a style="text-decoration:none; color:#285c85; margin-right:57px;" href="<?php echo URLROOT; ?>/accounts/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php endif; ?>
                <a href="#"><i class="fab fa-facebook-f socialicons"></i></a>
                <a href="#"><i class="fab fa-twitter socialicons"></i></a>
                <a href="#"><i class="fab fa-instagram socialicons"></i></a>
                <a href="#"><i class="fab fa-youtube socialicons"></i></a>
            </p>
        </div>
</div>
<div class="logoarea">
<a href="<?php echo URLROOT; ?>/index" title="Back to Home"><img src="<?php echo URLROOT; ?>/public/images/logo.jpg?v=<?php echo rand(10000000000,99999999999); ?>" alt="Logo" width="150px" /></a>
        <nav>
            <ul>
                <li><a href="<?php echo URLROOT; ?>/index">Events</a></li>
                <li><a href="<?php echo URLROOT; ?>/aboutus">Deals</a></li>
                <li><a href="<?php echo URLROOT; ?>/store">About</a></li>
                <li><a href="<?php echo URLROOT; ?>/requests">Contact</a></li>
            </ul>
        </nav>

        <div style="display:flex;">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <a class="signin" href="<?php echo URLROOT; ?>/accounts/dashboard"><i style="margin-right:5px;" class="fa fa-user"></i> Hi, <?php echo ucfirst($_SESSION['firstname']); ?></a>
        <?php else : ?>
            <a class="signin" href="<?php echo URLROOT; ?>/accounts/login">Sign In <i style="margin-left:7px;" class="fa fa-arrow-right"></i></a>
        <?php endif; ?>
            <a class="createTicket" href="<?php echo URLROOT; ?>/events/createTicket">Sell Tickets <i style="margin-left:7px;" class="fa fa-money-bill-wave"></i></a>
        </div>
</div>
</header>




