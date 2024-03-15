<?php    
        include('../admin/connect.php');
        $phongban=$_SESSION['staff_location'];
        if($phongban == "cty")
        {
        $deptcamera = isset($_GET['deptcamera']) ? $_GET['deptcamera'] : '' ;
        }
        else
        {
           $deptcamera=$phongban;     
        }
    ?> 
<!-- count total camera -->
<?php
$query_total_camera = "SELECT * from camera where cam_dept_location like '%$deptcamera%' ";
$result_total_camera = mysqli_query($connect, $query_total_camera) ;
$rowcount_total_camera = mysqli_num_rows( $result_total_camera);
$row_camera = mysqli_fetch_array($result_total_camera);

?>
<!-- count HIKVISION-->
<?php
$query_total_camera_hik = "SELECT * from camera where cam_dept_location like '%$deptcamera%' AND ten_thuonghieu like '%HIKVISION%'  ";
$result_total_camera_hik = mysqli_query($connect, $query_total_camera_hik) ;
$rowcount_total_camera_hik = mysqli_num_rows( $result_total_camera_hik);
$row_camera_hik= mysqli_fetch_array($result_total_camera_hik);
?>

<!-- count KBVISION-->
<?php
$query_total_camera_kb = "SELECT * from camera where cam_dept_location like '%$deptcamera%' AND ten_thuonghieu like '%KBVISION%'  ";
$result_total_camera_kb = mysqli_query($connect, $query_total_camera_kb) ;
$rowcount_total_camera_kb = mysqli_num_rows( $result_total_camera_kb);
$row_camera_kb= mysqli_fetch_array($result_total_camera_kb);
?>
<!-- count DAHUA-->
<?php
$query_total_camera_dahua = "SELECT * from camera where cam_dept_location like '%$deptcamera%' AND ten_thuonghieu like '%DAHUA%'  ";
$result_total_camera_dahua = mysqli_query($connect, $query_total_camera_dahua) ;
$rowcount_total_camera_dahua = mysqli_num_rows( $result_total_camera_dahua);
$row_camera_dahua= mysqli_fetch_array($result_total_camera_dahua);
?>

<!-- count CMS-->
<?php
$query_total_camera_cms = "SELECT * from camera where cam_dept_location like '%$deptcamera%' AND ten_thuonghieu like '%CMS%'  ";
$result_total_camera_cms = mysqli_query($connect, $query_total_camera_cms) ;
$rowcount_total_camera_cms = mysqli_num_rows( $result_total_camera_cms);
$row_camera_cms= mysqli_fetch_array($result_total_camera_cms);
?>



<div class="col-sm-10 col-sm-offset-2 col-lg-10 col-lg-offset-2 main">
        <div class="row">
                <ol class="breadcrumb" style="margin-top: 12px;"> 
                        <li><a href="../index.php"> <em class="fa fa-home"></em></a></li>
                        <?php 
                        if(empty($deptcamera))
                        {
                                ?>
                            <li class="active">Tổng quan</li>
                        <?php    
                        }
                        else
                        {
                        ?>
                         <li class="active"><?php 
                        if( $deptcamera ==  "CNMB" || $deptcamera ==  "cnmb")
                        {
                                echo "Chi Nhánh Miền Bắc" ; 
                        }
                        elseif ( $deptcamera ==  "CNMT" || $deptcamera ==  "cnmt")
                        {
                                echo "Chi Nhánh Miền Tây" ;
                        }               
                        elseif ( $deptcamera ==  "CNTN" || $deptcamera ==  "cntn")
                        {
                                echo "Chi Nhánh Miền Trung - Tây Nguyên" ;
                        }
                        elseif ( $deptcamera ==  "CNMN" || $deptcamera ==  "cnmn")
                        {
                        echo "Chi Nhánh Miền Nam" ;
                        }
                        elseif ( $deptcamera ==  "cty")
                        {
                        echo "Tổng công ty" ;
                        }
                        elseif ( $deptnetwork ==  "CNTP" || $deptnetwork ==  "cntp")
                        {
                        echo "Chi Nhánh Tiên Phong" ;
                        }
                        ?></li>
                        <?php 
                        }
                        ?>
                 </ol>
         </div><!--/.row-->
                <div class="panel panel-container">
                        <div class="row">
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">Tổng số hệ thống camera</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_camera ; ?></div>
                                                        <?php
                                                        if (empty($deptcamera) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietcamera.php"> Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue"><a href="thongke_chitietcamera.php?deptcamera=<?php echo $deptcamera; ?>"> Xem chi tiết  </a></div>
                                                                <?php
         
                                                        }
                                                        ?>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">HIKVISION</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa fa-camera color-teal"></em>
                                                        <div class="large"><?php echo $rowcount_total_camera_hik ; ?></div>
                                                        <?php
                                                        if (empty($deptcamera) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietcamera.php?cameraprovider=hik">  Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietcamera.php?deptcamera=<?php echo $deptcamera; ?>&cameraprovider=hik">  Xem chi tiết </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">KBVISION</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa fa-camera color-teal"></em>
                                                        <div class="large"><?php echo $rowcount_total_camera_kb ; ?></div>
                                                        <?php
                                                        if (empty($deptcamera) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietcamera.php?cameraprovider=kb">  Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue"><a href="thongke_chitietcamera.php?deptcamera=<?php echo $deptcamera; ?>&cameraprovider=kb">  Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">DAHUA</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa fa-camera color-teal"></em>
                                                        <div class="large"><?php echo $rowcount_total_camera_dahua ; ?></div>
                                                        <?php
                                                        if (empty($deptcamera))
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietcamera.php?cameraprovider=dahua"> Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietcamera.php?deptcamera=<?php echo $deptcamera; ?>&cameraprovider=dahua">  Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">CMS</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-camera color-teal"></em>
                                                        <div class="large"><?php echo $rowcount_total_camera_cms ; ?></div>
                                                        <?php
                                                        if (empty($deptcamera) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietcamera.php?cameraprovider=cms"> Xem chi tiết </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietcamera.php?deptcamera=<?php echo $deptcamera; ?>&cameraprovider=cms"> Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>

                                        </div>
                                </div>
                                </div> 
                                                          
                        </div>

                </div> 
                <!--/.row-->
                        <!-- <div class="row">
                        <div class="col-lg-12">
                                <h2 class="page-header">Linh kiện thanh lý</h2>                                
                        </div>
                        </div>
                        <div class="row">
                                <div class="col-xs-6 col-md-3">
                                <div class="panel panel-default">
                                <div class="panel-body easypiechart-panel">                                                                              
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-red">Linh kiện thanh lý</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-red"></em>
                                                        <div class="large"><?php echo $rowcount_total_camera_thanhly ; ?></div>                                                  
                                                        <div class="text-muted color-red"><a href="thongke_linhkien_thanhly.php"> Xem chi tiết </a></div>
                                                        
                                                </div>
                                        </div> 
                                </div>
                                </div>
                                </div>
                        </div> --><!--/.row-->

        </div>  <!--/.main-->