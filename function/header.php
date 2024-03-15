<!DOCTYPE html>
<?php
session_start();
?>
<?php                           
                            if (isset($_SESSION['username']))
                            {
                            ?>

<html class="no-js">
    <head>
        <!-- header read pdf file -->
        <?php
        //header('Content-type: application/pdf'); 
        //header('Content-Disposition: inline; filename="' .$file. '"'); 
       // header('Content-Transfer-Encoding: binary'); 
        //header('Accept-Ranges: bytes');
        ?>
        <!-- Basic Page Needs
        ================================================== -->
        <meta http-equiv='refresh' content='30'>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/logo.jpg">
        <title>IT Manager Dasboard</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Ionicons Fonts Css -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="css/slider.css">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/jquery.fancybox.css">
        <!-- template main css file -->
        <link rel="stylesheet" href="css/main.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
        
        <!-- Template Javascript Files
        ================================================== -->
        <!-- modernizr js -->
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <!-- jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- owl carouserl js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- bootstrap js -->

        <script src="js/bootstrap.min.js"></script>
        <!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- slider js -->
        <script src="js/slider.js"></script>
        <script src="js/jquery.fancybox.js"></script>
        <!-- template main js -->
        <script src="js/main.js"></script>
    </head>
    <body>
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <header id="top-bar" class="navbar-fixed-top animated-header">
            <div class="container">
                    <!-- logo -->
                    <div class="navbar-brand">
                        <a href="../index.php" >
                            <img src="images/logo.jpg" width="200" height="80" alt="">
                        </a>
                    </div>
                    <!-- /logo -->
                </div>
            </div>
        </header>
    </body>
    </html>
    <?php
}
else
{
    header("Location: ../admin/login.php");
}
?>