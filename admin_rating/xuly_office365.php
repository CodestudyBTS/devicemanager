<?php       
        include('../admin/connect.php');
        $donvi = isset($_GET['donvi']) ? $_GET['donvi'] : '' ; 
    ?> 
<!-- count total rating -->
<?php
$query_total_lic = "SELECT * from license_office365 ";
$result_total_lic = mysqli_query($connect, $query_total_lic) ;
$row_lic = mysqli_fetch_array($result_total_lic);
?>
<!-- count bitisgroup -->
<?php
$query_total_bitisgroup = "SELECT * from mail_bitisgroup WHERE DonVi like '%$donvi%' ";
$result_total_bitisgroup = mysqli_query($connect, $query_total_bitisgroup) ;
$rowcount_total_bitisgroup = mysqli_num_rows( $result_total_bitisgroup );
$row_bitisgroup = mysqli_fetch_array($result_total_bitisgroup);
?>
<!-- count License using Mail_user -->
<?php
$query_total = "SELECT * from mail_office365 WHERE DonVi like '%$donvi%' AND Type like '%Mail_user%' " ;
$result_total = mysqli_query($connect, $query_total) ;
$rowcount_total = mysqli_num_rows( $result_total );
$row = mysqli_fetch_array($result_total);
?>
<!-- count License using meeting -->
<?php
$query_total_meeting = "SELECT * from mail_office365 WHERE DonVi like '%$donvi%' AND Type like '%Meeting%' " ;
$result_total_meeting = mysqli_query($connect, $query_total_meeting) ;
$rowcount_total_meeting = mysqli_num_rows( $result_total_meeting );
$row_meeting = mysqli_fetch_array($result_total_meeting);
?>
<!-- count License E1 -->
<?php
$query_lic_e1 = "SELECT * from mail_office365 WHERE DonVi like '%$donvi%' AND License like '%E1%' " ;
$result_lic_e1 = mysqli_query($connect, $query_lic_e1) ;
$rowcount_lic_e1 = mysqli_num_rows( $result_lic_e1 );
?>
<!-- count License Basic -->
<?php
$query_lic_basic = "SELECT * from mail_office365 WHERE DonVi like '%$donvi%' AND License like '%Basic%' " ;
$result_lic_basic = mysqli_query($connect, $query_lic_basic) ;
$rowcount_lic_basic = mysqli_num_rows( $result_lic_basic );
?>

<div class="col-sm-10 col-sm-offset-2 col-lg-10 col-lg-offset-2 main">
                <div class="row">
                        <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Charts</li>
                        </ol>
                </div><!--/.row-->
                <div class="row">
                        <div class="col-sm-12 ">
                                <h2 class="page-header">Summary</h2>
                        </div>
                </div><!--/.row-->
                
                <div class="panel panel-container">
                        <div class="row">
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">Tổng License</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $row_lic['TongLicense'] ; ?></div>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">License E1</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $row_lic['E1'] ; ?></div>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">License Basic</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $row_lic['Basic'] ; ?></div>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">License Plan 2</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $row_lic['Plan2'] ; ?></div>                                                        
                                        </div>
                                </div>
                                </div> 
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">License Archiving</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $row_lic['Archiving'] ; ?></div>                                                        
                                        </div>
                                </div>
                                </div>                              
                        </div><!--/.row-->
                </div>
                <div class="row">
                        <div class="col-lg-12">
                                <h2 class="page-header">License Using</h2>
                        </div>
                </div><!--/.row-->
                
                <div class="panel panel-container">
                        <div class="row">
                                <!-- tổng định bien license -->
                                <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-teal">Tổng License <?php echo $donvi; ?> phân bổ </div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em>
                                                        <div class="large"><?php 
                                                        if(empty($donvi))
                                                        {
                                                           echo $row_lic['TongLicense'] ;
                                                           $using = $row_lic['TongLicense'] ;     
                                                        }
                                                        elseif ($donvi == 'cty') {
                                                                echo $row_lic['PPCty'] ;
                                                                $using = $row_lic['PPCty'] ;       
                                                        }
                                                        elseif ($donvi == 'tienphong') {
                                                                echo $row_lic['PPTienPhong'] ;
                                                                $using = $row_lic['PPTienPhong'] ;
                                                        }
                                                        elseif ($donvi == 'dona') {
                                                                echo $row_lic['PPdona'] ;
                                                                $using = $row_lic['PPdona'] ; 
                                                        }
                                                        elseif ($donvi == 'hoaanhphat') {
                                                                echo $row_lic['PPHap'] ;
                                                                $using = $row_lic['PPHap'] ; 
                                                        }
                                                        elseif ($donvi == 'chinhanh') {
                                                                echo $row_lic['PPchinhanh'] ;
                                                                $using = $row_lic['PPchinhanh'] ;
                                                        }                                                       

                                                ?></div> 
                                                        
                                                </div>
                                        </div>
                                </div>

                                <!-- -->
                                <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-teal">Tổng License sử dụng </div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em>
                                                        <div class="large"><?php echo "$rowcount_total";?></div> 
                                                        <?php
                                                        if (empty($donvi) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-teal "><a href="thongke_chitietmail.php"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-teal "><a href="thongke_chitietmail.php?donvi=<?php echo $donvi; ?>"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                                        <div class="panel panel-blue panel-widget border-right">
                                                <div class="text-muted color-teal">License E1</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em> 
                                                        <div class="large"><?php echo "$rowcount_lic_e1";?></div>                                                
                                                        <?php
                                                        if (empty($donvi) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-teal "><a href="thongke_chitietmail.php?lic=e1"> <font color="teal"> Xem chi tiết </font></a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-teal "><a href="thongke_chitietmail.php?donvi=<?php echo $donvi; ?>&lic=e1"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-teal">License Basic</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em>
                                                        <div class="large"><?php echo "$rowcount_lic_basic";?></div>
                                                        <?php
                                                        if (empty($donvi) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted"><a href="thongke_chitietmail.php?lic=basic"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-orange "><a href="thongke_chitietmail.php?donvi=<?php echo $donvi; ?>&lic=basic"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div> 
                                <!-- Meeting -->
                                <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-teal">Room Meeting</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em>
                                                        <div class="large"><?php echo "$rowcount_total_meeting";?></div>
                                                        <?php
                                                        if (empty($donvi) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted"><a href="thongke_chitietmail.php?typemail=meeting"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-orange "><a href="thongke_chitietmail.php?typemail=meeting&donvi=<?php echo $donvi; ?>"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>   
                                <!-- mail bitisgroup -->
                                <div class="col-xs-6 col-md-2 col-lg-2 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-teal">Mail bitisgroup</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em>
                                                        <div class="large"><?php echo "$rowcount_total_bitisgroup";?></div>
                                                        <?php
                                                        if (empty($donvi) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted"><a href="thongke_chitietmail.php?mail=bitisgroup"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-orange "><a href="thongke_chitietmail.php?mail=bitisgroup&donvi=<?php echo $donvi; ?>"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>  


                        </div><!--/.row-->
                </div>
                <div class="row">
                        <div class="col-lg-12">
                                <h2 class="page-header">Summary rate</h2>
                        </div>
                </div><!--/.row-->
                
                <div class="row">
                        <?php 
                                                        if(empty($donvi))
                                                        {
                                                                ?>                                                            
                                                           <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $row_lic['TongLicense'] != 0)
                                                {
                                                $per_use= $rowcount_total * 100 / $row_lic['TongLicense'];
                                                }
                                                else
                                                {
                                                   $per_use = 0;     
                                                }
                                                 echo "$per_use"; 

                                                 ?>" ><span class="percent"><?php echo round($per_use, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Rate</div>
                                        </div>
                                </div>
                        </div>   
                        <?php
                                                        }
                                                        elseif ($donvi == 'cty') {                                                                
                                                         ?>                                                            
                                                           <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $row_lic['PPCty'] != 0)
                                                {
                                                $per_use= $rowcount_total * 100 / $row_lic['PPCty'];
                                                }
                                                else
                                                {
                                                   $per_use = 0;     
                                                }
                                                 echo "$per_use"; 

                                                 ?>" ><span class="percent"><?php echo round($per_use, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Rate</div>
                                        </div>
                                </div>
                        </div>   
                        <?php       
                                                        }
                                                        elseif ($donvi == 'tienphong') {                                                   
                                                                ?>                                                            
                                                           <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $row_lic['PPTienPhong'] != 0)
                                                {
                                                $per_use= $rowcount_total * 100 /$row_lic['PPTienPhong'];
                                                }
                                                else
                                                {
                                                   $per_use = 0;     
                                                }
                                                 echo "$per_use"; 

                                                 ?>" ><span class="percent"><?php echo round($per_use, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Rate</div>
                                        </div>
                                </div>
                        </div>   
                        <?php  
                                                        }
                                                        elseif ($donvi == 'dona') {
                                                                ?>                                                            
                                                           <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $row_lic['PPdona'] != 0)
                                                {
                                                $per_use= $rowcount_total * 100 /$row_lic['PPdona'];
                                                }
                                                else
                                                {
                                                   $per_use = 0;     
                                                }
                                                 echo "$per_use"; 

                                                 ?>" ><span class="percent"><?php echo round($per_use, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Rate</div>
                                        </div>
                                </div>
                        </div>   
                        <?php  
                                                        }
                                                        elseif ($donvi == 'hoaanhphat') {
                                                                ?>                                                            
                                                           <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $row_lic['PPHap'] != 0)
                                                {
                                                $per_use= $rowcount_total * 100 /$row_lic['PPHap'];
                                                }
                                                else
                                                {
                                                   $per_use = 0;     
                                                }
                                                 echo "$per_use"; 

                                                 ?>" ><span class="percent"><?php echo round($per_use, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Rate</div>
                                        </div>
                                </div>
                        </div>   
                        <?php  
                                                        }
                                                        elseif ($donvi == 'chinhanh') {
                                                                ?>                                                            
                                                           <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                 <div class="text-muted color-teal">Rate</div>
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $row_lic['PPchinhanh'] != 0)
                                                {
                                                $per_use= $rowcount_total * 100 /$row_lic['PPchinhanh'];
                                                }
                                                else
                                                {
                                                   $per_use = 0;     
                                                }
                                                 echo "$per_use"; 

                                                 ?>" ><span class="percent"><?php echo round($per_use, 1) ; ?> %</span></div>
                                                 <div class="text-muted color-orange">Rate</div>
                                               
                                        </div>
                                </div>
                        </div>   
                        <?php
                                                        }                                                       

                                                ?>
                <button id="exportChart">Export chart</button>                                                         
                <div id="chartContainer" style="height:150px; width: 65%;"> </div>
                     
                </div><!--/.row-->              
                
                <script type="text/javascript">
                 var using = "<?php echo $rowcount_total ; ?>"; 
                 var total = "<?php echo $using ; ?>";     
                 var e1 = "<?php echo $rowcount_lic_e1 ; ?>";
                 var basic = "<?php echo $rowcount_lic_basic ; ?>";
                 var metting = "<?php echo $rowcount_total_meeting ; ?>";
                 var btgroup = "<?php echo $rowcount_total_bitisgroup ; ?>";       
                window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                title:{
                        text: "Đồ thị thống kê Mail"              
                },
                data: [              
                {
                        type: "column",
                        dataPoints: [
                                { label: "Tổng License phân bổ",  y: + total  },
                                { label: "Tổng License sử dụng", y: + using  },
                                { label: "License E1", y: + e1  },
                                { label: "License Basic", y: + basic  },
                                { label: "Room Meeting", y: + metting  },
                                { label: "Mail Bitisgroup", y: + btgroup  },
                        ]
                }
                ]
        });
  
        chart.render();
        document.getElementById("exportChart").addEventListener("click",function(){
        chart.exportChart({format: "jpg"});
    });  
}
</script>
                <script type="text/javascript" src="canvasjs/canvasjs.min.js"></script> 
        </div>  <!--/.main-->