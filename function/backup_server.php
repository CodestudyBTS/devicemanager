    <?php
        include ('header.php');
        session_start();
        include('../admin/connect.php');
    ?>   
  <html>
  <body>  
            <section id="feature">
                <div class="container">
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">DASBOARD </h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            Quản lý Backup application 
                        </p>
                    </div>
                    <div class="row">
                        <?php 
                            $querysv = "SELECT * FROM `backup_server`;" ;
                            if ($result = mysqli_query($connect, $querysv)) 
                            {
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    //echo $row['ip_mcc'];
                                    $a = $row [ 'server_status' ];
                                    if ( $a == 0 )
                                {                                                              
                        ?>                           
                                
                        <div class="col-md-4 col-lg-3 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">																
                                    <div class="icon-red">
                                        <i class="ion-monitor"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"> Server name: <?php echo $row['ten_server'] ; ?></h5>
                                    <h5 class="media-heading"> Server IP: <?php echo $row['ip_server']  ; ?></h5>                                    
                                    <h5 class="media-heading" style="color: #a300ff; font-size: 14px;"> Backup date: <?php echo $row['date'] ; ?></h5>
                                    <h5 class="media-heading" style="color: #a300ff; font-size: 14px;"> Backup Duration: <?php echo $row['duration'] ; ?></h5>
                                    <p><a href="detail_backup.php?id=<?php echo $row['id']; ?>"><font color="0000FF"  >Xem chi tiết </font></a></p>
                                </div>
							</div>
						</div>
								<?php
								    }                                    
								elseif ( $a == 1 )
								{
								?>
						<div class="col-md-1 col-lg-3 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">
								    <div class="icon-green">
                                        <i class="ion-monitor"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"> Server name: <?php echo $row['ten_server'] ; ?></h5>
                                    <h5 class="media-heading"> Server IP: <?php echo $row['ip_server']  ; ?></h5>
                                    <h5 class="media-heading" style="color: #a300ff; font-size: 14px;"> Backup date: <?php echo $row['date'] ; ?></h5>
                                    <h5 class="media-heading" style="color: #a300ff; font-size: 14px;"> Backup Duration: <?php echo $row['duration'] ; ?></h5>
                                    <p><a href="detail_backup.php?id=<?php echo $row['id']; ?>"><font color="0000FF">Xem chi tiết </font></a></p>

                                </div>
							</div> 
						</div>
								<?php
                                }
                                else
                                {
                                ?>
                        <div class="col-md-1 col-lg-3 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">
                                    <div class="icon-orange">
                                        <i class="ion-monitor"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="media-heading"> Server name: <?php echo $row['ten_server'] ; ?></h5>
                                    <h5 class="media-heading"> Server IP: <?php echo $row['ip_server']  ; ?></h5>
                                    <h5 class="media-heading" style="color: #a300ff; font-size: 14px;"> Backup date: <?php echo $row['date'] ; ?></h5>
                                    <h5 class="media-heading" style="color: #a300ff; font-size: 14px;"> Backup Duration: <?php echo "Processing" ; ?></h5>
                                    <p><a href="detail_backup.php?id=<?php echo $row['id']; ?>"><font color="0000FF" ">Xem chi tiết </font></a></p>
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
        </html>