    <?php
        include ('header.php');
        session_start();
        include('../admin/connect.php');
    ?>    
    <body>
            <section id="feature">
                <div class="container">
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">DASHBOARD </h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            Quản lý kết nối máy chấm công
                        </p>
                    </div>
                    <div class="row">
                        <?php 
                            $querymcc = "SELECT * FROM `mcc`;" ;
                            if ($result = mysqli_query($connect, $querymcc)) 
                            {
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    //echo $row['ip_mcc'];
                                    $a = $row [ 'status' ];
                                    if ( $a == 0 )
                                {                                                              
                        ?>                           
                                
                        <div class="col-md-3 col-lg-3 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">																
                                    <div class="icon-red">
                                        <i class="ion-android-calendar"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">Tên MCC: <?php echo $row['ten_mcc']  ; ?></h5>
                                    <h5 class="media-heading">IP MCC: <?php echo $row['ip_mcc'] ; ?></h5>
                                    <h5 class="media-heading">Vị trí MCC: <?php echo $row['mcc_vitri'] ; ?></h5>
                                    <h5 class="media-heading">Checking day: <?php echo $row['check_day'] ; ?></h5>
                                    <img src="images/1234.png" height="50" width="50">
                                </div>
							</div>
						</div>
								<?php
								    }                                    
								else
								{
								?>
						<div class="col-md-3 col-lg-3 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">
								    <div class="icon-green">
                                        <i class="ion-android-calendar"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading">Tên MCC: <?php echo $row['ten_mcc']  ; ?></h5>
                                    <h5 class="media-heading">IP MCC: <?php echo $row['ip_mcc'] ; ?></h5>
                                    <h5 class="media-heading">Vị trí MCC: <?php echo $row['mcc_vitri'] ; ?></h5>
                                    <h5 class="media-heading">Checking day: <?php echo $row['check_day'] ; ?></h5>
                                    <img src="images/123.png" height="50" width="50">
                                </div>
							</div> 
						</div>
								<?php
                                }
								 }
                                } else
                                //Hiện thông báo khi không thành công
                                echo 'Không thành công. Lỗi' . mysqli_error($connect);
                                //ngắt kết nối
                                mysqli_close($connect);
                        ?>  				                                               
                       
                    </div>
                </div>
            </section> <!-- /#feature -->
                            
            <!--
            ==================================================
            Portfolio Section Start
            ================================================== -->
			
            <!--
            ==================================================
            Footer Section Start
            ================================================== -->
            <footer id="footer">
                <div class="container">
                    <div class="col-md-12">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>
                    <div class="col-md-4">
                        <!-- Social Media 
                        <ul class="social">
                            <li>
                                <a href="http://wwww.fb.com/themefisher" class="Facebook">
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://wwww.twitter.com/themefisher" class="Twitter">
                                    <i class="ion-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="Linkedin">
                                    <i class="ion-social-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="http://wwww.fb.com/themefisher" class="Google Plus">
                                    <i class="ion-social-googleplus"></i>
                                </a>
                            </li>
                        </ul>
                        -->
                    </div>
                </div>
            </footer> <!-- /#footer -->
                
        </body>