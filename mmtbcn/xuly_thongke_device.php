<?php    
        include('../admin/connect.php');
        $phongban=$_SESSION['staff_location'];
        if($phongban == "cty")
        {
        $deptdevice = isset($_GET['deptdevice']) ? $_GET['deptdevice'] : '' ;
        }
        else
        {
           $deptdevice=$phongban;     
        }
       
    ?> 
<!-- count total device -->
<?php
$query_total_device = "SELECT * from cn_device where dept_location like '%$deptdevice%' ";
$result_total_device = mysqli_query($connect, $query_total_device) ;
$rowcount_total_device = mysqli_num_rows( $result_total_device);
$row_device = mysqli_fetch_array($result_total_device);

?>
<!-- count pc-->
<?php
$query_total_device_pc = "SELECT * from cn_device where dept_location like '%$deptdevice%' AND device_type like '%PC%'  ";
$result_total_device_pc = mysqli_query($connect, $query_total_device_pc) ;
$rowcount_total_device_pc = mysqli_num_rows( $result_total_device_pc);
$row_device_pc= mysqli_fetch_array($result_total_device_pc);
?>

<!-- count laptop-->
<?php
$query_total_device_laptop = "SELECT * from cn_device where dept_location like '%$deptdevice%' AND device_type like '%LT%'  ";
$result_total_device_laptop = mysqli_query($connect, $query_total_device_laptop) ;
$rowcount_total_device_laptop = mysqli_num_rows( $result_total_device_laptop);
$row_device_laptop= mysqli_fetch_array($result_total_device_laptop);
?>
<!-- count prt-->
<?php
$query_total_device_prt = "SELECT * from cn_device where dept_location like '%$deptdevice%' AND device_type like '%prt%'  ";
$result_total_device_prt = mysqli_query($connect, $query_total_device_prt) ;
$rowcount_total_device_prt = mysqli_num_rows( $result_total_device_prt);
$row_device_prt= mysqli_fetch_array($result_total_device_prt);
?>

!-- count orther-->
<?php
$query_total_device_orther_device = "SELECT * from cn_device where dept_location like '%$deptdevice%' AND device_type like '%DV%'  ";
$result_total_device_orther_device = mysqli_query($connect, $query_total_device_orther_device) ;
$rowcount_total_device_orther_device = mysqli_num_rows( $result_total_device_orther_device);
$row_device_orther_device= mysqli_fetch_array($result_total_device_orther_device);
?>
!-- count thanh lý-->
<?php
$query_total_device_thanhly = "SELECT * from cn_thanhly_device";
$result_total_device_thanhly = mysqli_query($connect, $query_total_device_thanhly) ;
$rowcount_total_device_thanhly = mysqli_num_rows( $result_total_device_thanhly);
$row_device_thanhly= mysqli_fetch_array($result_total_device_thanhly);
?>


<div class="col-sm-10 col-sm-offset-2 col-lg-10 col-lg-offset-2 main">
        <div class="row">
                <ol class="breadcrumb" style="margin-top: 12px;"> 
                        <li><a href="../index.php"> <em class="fa fa-home"></em></a></li>
                         <li class="active">Thiết bị</li>
                 </ol>
         </div><!--/.row-->
        <div class="row">
                <div class="col-sm-12 ">
                        <h2 class="page-header">Thống kê thiết bị</h2>
                </div>
        </div><!--/.row--> 
                <div class="panel panel-container">
                        <div class="row">
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">Tổng số thiết bị</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_device ; ?></div>
                                                        <?php
                                                        if (empty($deptdevice) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietdevice.php"> Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue"><a href="thongke_chitietdevice.php?deptdevice=<?php echo $deptdevice; ?>"> Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">Personal Computer (PC)</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-desktop color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_device_pc ; ?></div>
                                                        <?php
                                                        if (empty($deptdevice) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietdevice.php?devicetype=PC">  Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietdevice.php?deptdevice=<?php echo $deptdevice; ?>&devicetype=PC">  Xem chi tiết </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">Laptop</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-laptop color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_device_laptop ; ?></div>
                                                        <?php
                                                        if (empty($deptdevice) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietdevice.php?devicetype=lt">  Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue"><a href="thongke_chitietdevice.php?deptdevice=<?php echo $deptdevice; ?>&devicetype=lt">  Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">Printer</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-print color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_device_prt ; ?></div>
                                                        <?php
                                                        if (empty($deptdevice))
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietdevice.php?devicetype=prt"> Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietdevice.php?deptdevice=<?php echo $deptdevice; ?>&devicetype=prt">  Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">Thiết bị khác</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-tablet color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_device_orther_device ; ?></div>
                                                        <?php
                                                        if (empty($deptdevice) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietdevice.php?devicetype=dv"> Xem chi tiết </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietdevice.php?deptdevice=<?php echo $deptdevice; ?>&devicetype=dv"> Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>

                                        </div>
                                </div>
                                </div> 
                                                          
                        </div>

                </div> 
                <!--/.row-->
                        <div class="row">
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
                                                        <div class="large"><?php echo $rowcount_total_device_thanhly ; ?></div>                                                  
                                                        <div class="text-muted color-red"><a href="thongke_linhkien_thanhly.php?deptdevice=<?php echo $deptdevice; ?>"> Xem chi tiết </a></div>
                                                        
                                                </div>
                                        </div> 
                                </div>
                                </div>
                                </div>
                        </div><!--/.row-->

        </div>  <!--/.main-->