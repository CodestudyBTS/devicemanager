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
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/logo.jpg">
        <title>Thông tin liên hệ</title>
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
                <div class="navbar-header">
                    <!-- responsive nav button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <!-- /responsive nav button -->
                    
                    <!-- logo -->
                    <div class="navbar-brand">
                        <a href="index.php" >
                            <img src="images/logo.jpg" width="200" height="80" alt="">
                        </a>
                    </div>
                    <!-- /logo -->
                </div>
                <!-- main menu -->
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <div class="main-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="index.php" >Home</a>
                            </li>
                            
                            <!--
                            <li><a href="about.html">About</a></li>
                            <li><a href="service.html">Service</a></li>
                            -->
                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">MONITOR <span class="caret"></span></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a href="function/mcc.php">Máy Chấm Công</a></li>
                                        <li><a href="function/backup_server.php">Backup server</a></li>
                                        <!--
                                        <li><a href="gallery.html">Gallery</a></li>
                                        -->
                                    </ul>
                                </div>
                            </li>
                            <!--
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <span class="caret"></span></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a href="blog-fullwidth.html">Blog Full</a></li>
                                        <li><a href="blog-left-sidebar.html">Blog Left sidebar</a></li>
                                        <li><a href="blog-right-sidebar.html">Blog Right sidebar</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="contact.html">Contact</a></li> 
                            -->                         
                            <?php                           
                            if (isset($_SESSION['username']))
                            {
                            ?>
                            <li> <a > <font color="#FF0000"> 
                            <?php 
                            echo "User: " .$_SESSION['username'] ;  
                            ?>
                            </font>
                            </a>                            
                            </li>                           
                            <li> 
                            <a href="admin/logout.php"><font color="#0000FF">Logout</font></a>
                            </li>
                            <?php }
                            else 
                            {
                            ?>
                            <li>
                            <a href="admin/login.php"> <font color="#0000FF">Login </font></a>
                            </li>
                            <?php
                            }
                            ?>
                            <?php
                            if ( $_SESSION['admin'] == 2 )
                            {
                             ?>

                            <li>
                                <a href="admin_rating/thongke.php" ><i class="ion-gear-a"></i></a>
                            </li>
                                                      
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
                <!-- /main nav -->
            </div>
        </header>

        <!-- 
        ================================================== 
            Global Page Section Start
        ================================================== -->
        <section class="global-page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2>Contact</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="ion-ios-home"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">Contact</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>   
        </section><!--/#page-header-->


        <!-- 
        ================================================== 
            Contact Section Start
        ================================================== -->
        <section id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block">
                            <h2 class="subtitle wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s">Contact Me</h2>
                            <p class="subtitle-des wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
                                Thông tin nhân sự trong team
                            </p>
                            <div class="contact-form">
                                <form id="contact-form" method="post" action="sendmail.php" role="form">
                        
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".6s">
                                        <input type="text" placeholder="Your Name" class="form-control" name="name" id="name">
                                    </div>
                                    
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".8s">
                                        <input type="email" placeholder="Your Email" class="form-control" name="email" id="email" >
                                    </div>
                                    
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1s">
                                        <input type="text" placeholder="Subject" class="form-control" name="subject" id="subject">
                                    </div>
                                    
                                    <div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1.2s">
                                        <textarea rows="6" placeholder="Message" class="form-control" name="message" id="message"></textarea>    
                                    </div>
                                    
                                    
                                    <div id="submit" class="wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1.4s">
                                        <input type="submit" id="contact-submit" class="btn btn-default btn-send" value="Send Message">
                                    </div>                      
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="map-area">
                            <h2 class="subtitle  wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s">LOCATION</h2>                    
                            <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=22 ly chieu hoang&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://formatjson.org/">format json</a></div><style>.mapouter{position:relative;text-align:right;width:600px;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:600px;height:400px;}.gmap_iframe {width:600px!important;height:400px!important;}</style></div>
                        </div>
                    </div>
                </div>
                <div class="row address-details">
                    <div class="col-md-2">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>22 Lý Chiêu Hoàng <br>Phạm Tân Tiến</h5>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>22 Lý Chiêu Hoàng <br>Trần Mạnh Tiến</h5>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>22 Lý Chiêu Hoàng <br>Nguyễn Hồng Phúc</h5>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>22 Lý Chiêu Hoàng <br>Phạm Đăng Khoa</h5>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>22 Lý Chiêu Hoàng <br>Phan Ngọc Hoan</h5>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>VP Trần Hưng Đạo <br>Phạm Quốc Trầm</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 
        ================================================== 
            Call To Action Section Start
        ================================================== 
        <section id="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">INTERESTED IN WORKING TOGETHER? ?</h1>
                            <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis,</br>possimus commodi, fugiat magnam temporibus vero magni recusandae? Dolore, maxime praesentium.</p>
                            <a href="contact.html" class="btn btn-default btn-contact wow fadeInDown" data-wow-delay=".7s" data-wow-duration="500ms">Contact With Me</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section> -->


        <!--
            ==================================================
            Footer Section Start
            ================================================== -->
            <footer id="footer">
                <div class="container">                    
                    <div class="col-md-12">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>              
                   
                    </div>                 
                </div>
            </footer> <!-- /#footer -->
    
    </body>
</html>
<?php
}else
{
    header("Location: admin/login.php");
}

