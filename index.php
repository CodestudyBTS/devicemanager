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
        <!-- <meta http-equiv='refresh' content='30'> -->
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
        <link href="css/font-awesome.min.css" rel="stylesheet">
        
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
                    <div class="menu-wrapper menu-gold">
                        <ul class="menu">                            
                            <li>
                                <a href="index.php" >Trang chủ</a>
                            </li>
							<?php
                            if( $_SESSION['admin'] >= 1)
                            {
                                ?>
                              <li>
                                <a>Kiểm tra hệ thống</a>
                                    <ul>

                                        <li><a href="function/mcc.php">Máy Chấm Công</a>
                                        </li>
                                        <?php
                                        if( $_SESSION['admin'] >= 2 )
                                        {
                                            ?>
                                          <li><a href="function/backup_server.php">Backup server</a></li>
                                          <?php 
                                        }
                                        ?>                                        
                                    </ul>
                            </li>
                            <?php 
                            }
                            if( $_SESSION['admin'] >=1)
                            {
                            ?>
                            <li>
                                <a>Quản lý dịch vụ</a>
                                    <ul>
                                        <?php 
                                        if( $_SESSION['admin365'] >= 2 || $_SESSION['admin'] >= 3 )
                                        {
                                        ?>
                                          <li><a href="admin_rating/office365.php">Hệ thống Office 365</a></li>
                                        <?php 
                                        }
                                        if( $_SESSION['adminticket'] >= 2 || $_SESSION['admin'] >= 3)
                                        {
                                        ?>
                                        <li>
                                            <a>Hệ thống Ticket</a>
                                            <ul>
                                            <li><a href="ticket/thongke_ticket.php">Ticket</a></li>
                                            <li><a href="admin_rating/thongke.php">Đánh giá Ticket</a></li>
                                            </ul>
                                        </li>
                                        <?php 
                                        } 
                                        ?>                         
                                    </ul>
                            </li>
                            <?php 
                            }
                            if( $_SESSION['admin'] >=1)
                            {
                                ?>
                            <li>
                                <a>Máy móc thiết bị CNTT</a>
                                <ul> 
                            <?php
                                if( $_SESSION['admin_mmtb'] >=1 || $_SESSION['admin'] >= 2)
                            {
                            ?>
                                <li>
                                    <a>Tổng công ty</a>
                                    <ul>
                                    <li><a href="mmtb/thongke_category.php">Danh mục thiết bị - phòng ban</a></li>
                                    <li><a href="mmtb/thongke_device.php">Danh sách thiết bị</a></li>
                                    <li><a href="network/thongke_network.php">Danh sách đường truyền internet</a></li>
                                    <li><a href="camera/thongke_camera.php">Danh sách Camera</a></li>
                                    </ul>
                                </li>
                            <?php 
                            }
                                if($_SESSION['admin'] >= 2)
                            {
                            ?>
                                <li>
                                    <a>Chi Nhánh</a>
                                    <ul>
                                    <li><a href="mmtbcn/thongke_category.php">Danh mục thiết bị - Chi Nhánh</a></li>
                                    <li><a href="mmtbcn/thongke_device.php">Danh sách thiết bị</a></li>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                            </li> 
                            <?php 
                        }
                        ?>
                            <?php
                                if($_SESSION['admin'] >= 3)
                                {
                            ?>
                                <li>
                                    <a>Admin</a>
                                    <ul>
                                        <li><a href="admin_rating/thongke_member.php">Danh sách thành viên</a></li>
                                        <li><a href="mmtb/log_operation.php">Log máy móc thiết bị</a></li>
                                    </ul>
                            </li> 
                                    <?php
                                }
                            ?>				
							<?php 							
							if (isset($_SESSION['username']))
							{
							?>
							<?php 
                            if( $_SESSION['gioitinh'] == 'Nam' )
                            {
                                ?>
                                <li> <a > <font color="#FF0000"> <em class="fa fa-user"></em>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <li> <a > <font color="#FF0000"> <em class="ion-woman"></em>
                                        <?php
                                }
							echo $_SESSION['username'] ;	
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
                        </ul>
                    </div>
                </nav>
                <!-- /main nav -->
            </div>
        </header>
        
        <!--
        ============= -->          
            <section id="feature">
                <div class="container">
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">DASHBOARD </h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            Dashboard thành viên <?php echo $_SESSION['username']; ?> thuộc đơn vị <?php 
                            if( $_SESSION['staff_location'] == "cty")
                            {
                                echo "Tổng công ty" ;
                            }
                            elseif( $_SESSION['staff_location'] == "CNMB" || $_SESSION['staff_location'] == "cnmb")
                            {
                                echo "Chi Nhánh Miền Bắc" ;
                            }
                            elseif( $_SESSION['staff_location'] == "CNMN" || $_SESSION['staff_location'] == "cnmn")
                            {
                                echo "Chi Nhánh Miền Nam" ;
                            }
                            elseif( $_SESSION['staff_location'] == "CNMT" || $_SESSION['staff_location'] == "cnmt")
                            {
                                echo "Chi Nhánh Miền Tây" ;
                            }
                            elseif( $_SESSION['staff_location'] == "CNTN" || $_SESSION['staff_location'] == "cntn")
                            {
                                echo "Chi Nhánh Miền Trung - Tây Nguyên" ;
                            }
                            ?>
                        </p>
                    </div>
                    <!-- <div class="test123 col-lg-12" >
                        <p>Các dịch vụ internet</p>
                    </div> -->
                    <!--  menu chi nhanh -->
                    <?php
                    if ( $_SESSION['admin_cn_mmtb'] >= 2 ) 
                    {
                    ?>
                    <div class="row">   
                    <!-- Trình duyệt google -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://www.google.com" target="_blank"><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://www.google.com" target="_blank">Tìm kiếm google</a></h4>
                                    <p> Trang tìm kiếm google</p>
                                </div>
                            </div>
                        </div>
                    <!-- Danh mục thiết bị chi nhánh-->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="mmtbcn/thongke_category.php" target="_blank"><i class="fa fa-bars"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="mmtbcn/thongke_category.php" target="_blank">Danh mục linh kiện và phòng ban</a></h4>
                                    <p> Menu danh mục linh kiện MMTB và phòng ban</p>
                                </div>
                            </div>
                        </div>
                        <!-- danh sách thiết bị chi nhánh -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="mmtbcn/thongke_device.php" target="_blank"><i class="fa fa-tablet"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="mmtbcn/thongke_device.php" target="_blank">Danh sách thiết bị</a></h4>
                                    <p> Menu danh sách MMTB và phòng ban</p>
                                </div>
                            </div>
                        </div>
                        <!-- danh sách đường truyền chi nhánh -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="network/thongke_network.php" target="_blank"><i class="fa fa-globe"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="network/thongke_network.php" target="_blank">Danh sách đường truyền network</a></h4>
                                    <p> Menu danh sách đường truyền internet tại chi nhánh và các cửa hàng tiếp thị</p>
                                </div>
                            </div>
                        </div>
                        <!-- danh sách hệ thống camera  -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="camera/thongke_camera.php" target="_blank"><i class="fa fa-camera"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="camera/thongke_camera.php" target="_blank">Danh sách hệ thống camera</a></h4>
                                    <p> Menu danh sách hệ thống camera tại chi nhánh và các cửa hàng tiếp thị</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php 
                    }
                    ?>



                    <!-- end menu chi nhánh -->
                    <?php
                    if ( $_SESSION['admin'] >= 1 ) 
                    {
                    ?>
                    <div class="row">	
                    <!-- Trình duyệt google -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://www.google.com" target="_blank"><i class="fa fa-google"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://www.google.com" target="_blank">Tìm kiếm google</a></h4>
                                    <p> Trang tìm kiếm google</p>
                                </div>
                            </div>
                        </div>                    			
					<!-- Ticket -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://hotro.bitisgroup.vn/scp/login.php" target="_blank"><i class="fa fa-ticket"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://hotro.bitisgroup.vn/scp/login.php" target="_blank">Ticket System</a></h4>
                                    <p> Hệ thống tạo yêu cầu hỗ trợ xử lý các vấn đề CNTT  </p>
                                </div>
                            </div>
                        </div>
						  
						<!-- 365 -->
						<div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://www.office.com/" target="_blank"><i class="ion-ios-email-outline"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://www.office.com/" target="_blank">Office 365</a></h4>
                                    <p> Hệ thống mail office 365</p>
                                </div>
                            </div>
                        </div>
					<!-- Haraworks -->
						<div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://haraworks.vn/" target="_blank"><i class="ion-navicon-round"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://haraworks.vn/" target="_blank">Haraworks</a></h4>
                                    <p>Hệ thống quản lý nhân sự Haraworks</p>
                                </div>
                            </div>
                        </div>                   

					<!-- Data bitis -->
						<div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://data.bitisgroup.vn" target="_blank"><i class="ion-ios-cloud-outline"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://data.bitisgroup.vn" target="_blank">Data Biti's</a></h4>
                                    <p>Hệ thống quản lý dữ liệu Cloud </p>
                                </div>
                            </div>
                        </div>	
                    <!-- end sub menu -->
                    
                    <!--
                        ===================================
                        menu admin
                        ===================================
                    -->
                    <?php
                    }
                    if ( $_SESSION['admin'] >= 2 ) 
                    {
                    ?>
                    <!-- Data bitis -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://vcenter.bitis.vn/" target="_blank"><i class="ion-social-buffer"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://vcenter.bitis.vn/" target="_blank">Biti's Vcenter</a></h4>
                                    <p>Quản lý Vcenter Biti's</p>
                                </div>
                            </div>
                        </div>  
                    <!-- end sub menu --><!-- monitor zabbix -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://monitor.bitisgroup.vn" target="_blank"><i class="ion-ios-pulse-strong"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="http://zabbix.bitis.vn/zabbix" target="_blank">Zabbix server</a></h4>
                                    <p>Zabbix server backend</p>
                                </div>
                            </div>
                        </div>  
                    <!-- end sub menu -->
                    <!-- monitor zabbix -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://monitor.bitisgroup.vn" target="_blank"><i class="ion-monitor"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://monitor.bitisgroup.vn" target="_blank">Monitor APP Biti's</a></h4>
                                    <p>Monitor frontend hệ thống thiết bị Server Biti's</p>
                                </div>
                            </div> 
                        </div>  
                    <!-- end sub menu -->                    
                    <!-- PA vietnam -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="https://support.pavietnam.vn/login.php" target="_blank"><i class="ion-ios-people-outline"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="https://support.pavietnam.vn/login.php" target="_blank">PA Việt Nam</a></h4>
                                    <p>Support PA Việt Nam</p>
                                </div>
                            </div>
                        </div>  
                    <!-- end sub menu --> 
                    <!-- PA vietnam -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="http://temp.bitis.vn" target="_blank"><i class="ion-compass"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="http://temp.bitis.vn" target="_blank">TEMPERATURE & HUMIDITY</a></h4>
                                    <p>Hệ thống cảnh báo nhiệt độ và độ ẩm</p>
                                </div>
                            </div>
                        </div>  
                    <!-- end sub menu -->                   
                    <?php
                }
                elseif ( $_SESSION['admin'] == 1 )
                {
                ?>
                <!-- PA vietnam -->
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="1800ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <a href="admin_rating/usr_rating.php" target="_blank"><i class="ion-ios-people-outline"></i></a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"> <a href="admin_rating/usr_rating.php" target="_blank">List Rating</a></h4>
                                    <p>Danh sách rating người dùng đánh giá hỗ trợ xử lý ticket của nhân viên <?php echo $_SESSION['username']; ?> </p>
                                </div>
                            </div>
                        </div>  
                    <!-- end sub menu -->                    
                    <?php
                    } 
                    ?>                   
                    </div>	

                </div>
            </section> <!-- /#feature -->
            <footer id="footer">
                <div class="container">                    
                    <div class="col-md-12">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>					
                    <div class="col-md-4">
                    </div>                 
                </div>
            </footer> <!-- /#footer -->
                
        </body>
    </html>
    <?php
}
else
{
    header("Location: admin/login.php");
}