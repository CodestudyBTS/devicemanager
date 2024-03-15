    <?php
        include ('header.php');
        session_start();
        include('../admin/connect.php');
        $id_sv = $_GET['id'];
    ?>    
    <body>
            <section id="feature">
                <div class="container">
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">DASBOARD </h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                           Log file backup detail
                        </p>
                    </div>
                    <div class="row">
                        <?php 
                            $querybkdt = "SELECT * FROM `backup_detail` inner join `backup_server` on backup_detail.id = backup_server.id  WHERE backup_detail.id='$id_sv';" ;
                            if ($result = mysqli_query($connect, $querybkdt)) 
                            {
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    //echo $row['ip_mcc'];
                                    $a = $row [ 'server_status' ];
                                   if ( $a == 0 )
                                {                                                              
                        ?>                           
                                
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">																
                                    <div class="icon-red">
                                        <i class="ion-monitor"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="col-lg-3" >
                                    <h4 class="media-heading"> Server name: <?php echo $row['ten_server'] ; ?></h4>
                                    <h4 class="media-heading"> Server IP: <?php echo $row['ip_server'] ; ?></h4>
                                    <h4 class="media-heading" style="color: #a300ff; font-size: 16px;"> Date: <?php echo $row['date'] ; ?></h4>
                                    </div>
                                    <div class="col-lg-9">
                                    <pre> <font color="000000"><?php echo  $row['detail']; ?> </font></pre>
                                    </div>
                                </div>
							</div>
						</div>
								<?php
								    }                                    
								elseif ( $a == 1 )
								{
								?>
                        
						<div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">
								    <div class="icon-green">
                                        <i class="ion-monitor"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="col-lg-3" >
                                    <h4 class="media-heading"> Server name: <?php echo $row['ten_server'] ; ?></h4>
                                    <h4 class="media-heading"> Server IP: <?php echo $row['ip_server'] ; ?></h4>
                                    <h4 class="media-heading" style="color: #a300ff; font-size: 16px;"> Date: <?php echo $row['date'] ; ?></h4>
                                    </div>
                                    <div class="col-lg-9">
                                    <pre> <font color="000000"><?php echo  $row['detail']; ?> </font></pre>
                                    </div>
							</div> 
						</div>
                  
								<?php
                               }else
                                {
                                ?>
                        
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">
                                    <div class="icon-orange">
                                        <i class="ion-monitor"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="col-lg-3" >
                                    <h4 class="media-heading"> Server name: <?php echo $row['ten_server'] ; ?></h4>
                                    <h4 class="media-heading"> Server IP: <?php echo $row['ip_server'] ; ?></h4>
                                    <h4 class="media-heading" style="color: #a300ff; font-size: 16px;"> Date: <?php echo $row['date'] ; ?></h4>
                                    </div>
                                    <div class="col-lg-9">
                                    <pre> <font color="000000"><?php echo  $row['detail']; ?> </font></pre>
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
                    <div class="col-md-8">
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