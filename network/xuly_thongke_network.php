<?php    
        include('../admin/connect.php');
        $phongban=$_SESSION['staff_location'];
        if($phongban == "cty")
        {
        $deptnetwork = isset($_GET['deptnetwork']) ? $_GET['deptnetwork'] : '' ;
        }
        else
        {
           $deptnetwork=$phongban;     
        }
        
    ?> 
<!-- count total network -->
<?php
$query_total_network = "SELECT * from network where dept_location like '%$deptnetwork%' ";
$result_total_network = mysqli_query($connect, $query_total_network) ;
$rowcount_total_network = mysqli_num_rows( $result_total_network);
$row_network = mysqli_fetch_array($result_total_network);

?>
<!-- count viettel-->
<?php
$query_total_network_Viettel = "SELECT * from network where dept_location like '%$deptnetwork%' AND network_provider like '%viettel%'  ";
$result_total_network_Viettel = mysqli_query($connect, $query_total_network_Viettel) ;
$rowcount_total_network_Viettel = mysqli_num_rows( $result_total_network_Viettel);
$row_network_Viettel= mysqli_fetch_array($result_total_network_Viettel);
?>

<!-- count fpt-->
<?php
$query_total_network_fpt = "SELECT * from network where dept_location like '%$deptnetwork%' AND network_provider like '%FPT%'  ";
$result_total_network_fpt = mysqli_query($connect, $query_total_network_fpt) ;
$rowcount_total_network_fpt = mysqli_num_rows( $result_total_network_fpt);
$row_network_fpt= mysqli_fetch_array($result_total_network_fpt);
?>
<!-- count vnpt-->
<?php
$query_total_network_vnpt = "SELECT * from network where dept_location like '%$deptnetwork%' AND network_provider like '%VNPT%'  ";
$result_total_network_vnpt = mysqli_query($connect, $query_total_network_vnpt) ;
$rowcount_total_network_vnpt = mysqli_num_rows( $result_total_network_vnpt);
$row_network_vnpt= mysqli_fetch_array($result_total_network_vnpt);
?>

<!-- count orther-->
<?php
$query_total_network_minh_tu = "SELECT * from network where dept_location like '%$deptnetwork%' AND network_provider like '%MT%'  ";
$result_total_network_minh_tu = mysqli_query($connect, $query_total_network_minh_tu) ;
$rowcount_total_network_minh_tu = mysqli_num_rows( $result_total_network_minh_tu);
$row_network_minh_tu= mysqli_fetch_array($result_total_network_minh_tu);
?>



<div class="col-sm-10 col-sm-offset-2 col-lg-10 col-lg-offset-2 main">
        <div class="row">
                <ol class="breadcrumb" style="margin-top: 12px;"> 
                        <li><a href="../index.php"> <em class="fa fa-home"></em></a></li>
                        <?php 
                        if(empty($deptnetwork))
                        {
                                ?>
                            <li class="active">Tổng quan</li>
                        <?php    
                        }
                        else
                        {
                        ?>
                         <li class="active"><?php 
                        if( $deptnetwork ==  "CNMB" || $deptnetwork ==  "cnmb")
                        {
                                echo "Chi Nhánh Miền Bắc" ; 
                        }
                        elseif ( $deptnetwork ==  "CNMT" || $deptnetwork ==  "cnmt")
                        {
                                echo "Chi Nhánh Miền Tây" ;
                        }               
                        elseif ( $deptnetwork ==  "CNTN" || $deptnetwork ==  "cntn")
                        {
                                echo "Chi Nhánh Miền Trung - Tây Nguyên" ;
                        }
                        elseif ( $deptnetwork ==  "CNMN" || $deptnetwork ==  "cnmn")
                        {
                        echo "Chi Nhánh Miền Nam" ;
                        }
                        elseif ( $deptnetwork ==  "cty")
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
                                                <div class="text-muted color-blue">Tổng số đường truyền</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_network ; ?></div>
                                                        <?php
                                                        if (empty($deptnetwork) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php"> Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php?deptnetwork=<?php echo $deptnetwork; ?>"> Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">Viettel</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-globe color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_network_Viettel ; ?></div>
                                                        <?php
                                                        if (empty($deptnetwork) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php?networkprovider=viettel">  Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietnetwork.php?deptnetwork=<?php echo $deptnetwork; ?>&networkprovider=viettel">  Xem chi tiết </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                        </div>                                                        
                                        </div>
                                </div>
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">FPT</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-globe color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_network_fpt ; ?></div>
                                                        <?php
                                                        if (empty($deptnetwork) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php?networkprovider=FPT">  Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php?deptnetwork=<?php echo $deptnetwork; ?>&networkprovider=fpt">  Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">VNPT</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-globe color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_network_vnpt ; ?></div>
                                                        <?php
                                                        if (empty($deptnetwork))
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php?networkprovider=vnpt"> Xem chi tiết  </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietnetwork.php?deptnetwork=<?php echo $deptnetwork; ?>&networkprovider=vnpt">  Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>                                                        
                                        </div>
                                </div>
                                </div>  
                                <div class="col-xs-10 col-md-2 col-lg-24 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-blue">Minh Tú</div>
                                                <div class="row no-padding"><em class="fa fa-xl fa-globe color-blue"></em>
                                                        <div class="large"><?php echo $rowcount_total_network_minh_tu ; ?></div>
                                                        <?php
                                                        if (empty($deptnetwork) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue"><a href="thongke_chitietnetwork.php?networkprovider=mt"> Xem chi tiết </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitietnetwork.php?deptnetwork=<?php echo $deptnetwork; ?>&networkprovider=mt"> Xem chi tiết  </a></div>
                                                                <?php
                                                        }
                                                        ?>

                                        </div>
                                </div>
                                </div> 
                                                          
                        </div>

                </div> 
                <div id="chartContainer" style="height: 275px; width: 100%;"></div>
                <button id="exportChart">Xuất đồ thị</button>
                <script type="text/javascript">
                 var viettel = "<?php echo $rowcount_total_network_Viettel ; ?>";
                 var fpt = "<?php echo $rowcount_total_network_fpt ; ?>";
                 var vnpt = "<?php echo $rowcount_total_network_vnpt ; ?>";
                 var mt = "<?php echo $rowcount_total_network_minh_tu ; ?>";       
                window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                title:{
                        text: "Đồ thị thống kê đường truyền internet"              
                },
                data: [              
                {
                        type: "column",
                        dataPoints: [
                                { label: "Viettel",  y: + viettel  },
                                { label: "FPT", y: + fpt  },
                                { label: "VNPT", y: + vnpt  },
                                { label: "Minh Tú", y: + mt  }
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
                <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>     
        </div>  <!--/.main-->