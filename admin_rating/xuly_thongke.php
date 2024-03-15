<?php       
        include('../admin/connect.php');
        $dept = isset($_GET['dept']) ? $_GET['dept'] : '' ; 
    ?> 

<!-- count total rating -->
<?php
$query_total = "SELECT * from rating WHERE ticket_dept like '%$dept%' " ;
$result_total = mysqli_query($connect, $query_total) ;
$rowcount_total = mysqli_num_rows( $result_total );
$row = mysqli_fetch_array($result_total);
?>
<!-- count good rating -->
<?php
$query_rating_good = "SELECT * from rating WHERE ticket_dept like '%$dept%' AND (ticket_rate='5' OR ticket_rate='4') " ;
$result_rating_good = mysqli_query($connect, $query_rating_good) ;
$rowcount_rating_good = mysqli_num_rows( $result_rating_good );
?>
<!-- count nomal rating -->
<?php
$query_rating_nomal = "SELECT * from rating WHERE ticket_dept like '%$dept%' AND ticket_rate='3' " ;
$result_rating_nomal = mysqli_query($connect, $query_rating_nomal) ;
$rowcount_rating_nomal = mysqli_num_rows( $result_rating_nomal );
?>
<!-- count bad rating -->
<?php
$query_rating_bad = "SELECT * from rating WHERE ticket_dept like '%$dept%' AND (ticket_rate='2' OR ticket_rate='1') " ;
$result_rating_bad = mysqli_query($connect, $query_rating_bad) ;
$rowcount_rating_bad = mysqli_num_rows( $result_rating_bad );
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
                <div class="row">
                        <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active"><?php
                                 if (empty($dept) )
                                                        {
                                                        echo "General" ;                                                        
                                                        }                                                        
                                                        else
                                                        {
                                                           echo ucwords("$dept") ;    
                                                        }
                                                         ?></li>
                        </ol>
                </div><!--/.row-->
                <div class="row">
                        <div class="col-lg-12">
                                <h2 class="page-header">Summary</h2>                                
                        </div>
                </div><!--/.row-->
                
                <div class="panel panel-container">
                        <div class="row">
                                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">General ticket </div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo "$rowcount_total";?></div> 
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue "><a href="thongke_chitiet.php"> Xem chi tiết </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitiet.php?dept=<?php echo $dept; ?>"> Xem chi tiết </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                                        <div class="panel panel-blue panel-widget border-right">
                                                <div class="text-muted color-teal">Good</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em> 
                                                        <div class="large"><?php echo "$rowcount_rating_good";?></div>                                                
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-teal "><a href="thongke_chitiet.php?ticket_rate=good"> <font color="teal"> Xem chi tiết </font></a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-teal "><a href="thongke_chitiet.php?dept=<?php echo $dept; ?>&ticket_rate=good"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-orange">Nomal</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-orange"></em>
                                                        <div class="large"><?php echo "$rowcount_rating_nomal";?></div>
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted"><a href="thongke_chitiet.php?ticket_rate=nomal"> <font color="orange"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-orange "><a href="thongke_chitiet.php?dept=<?php echo $dept; ?>&ticket_rate=nomal"> <font color="orange"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                                        <div class="panel panel-red panel-widget ">
                                                <div class="text-muted color-red">Bad</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-red"></em>
                                                        <div class="large"><?php echo "$rowcount_rating_bad";?></div>
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue "><a href="thongke_chitiet.php?ticket_rate=bad"> <font color="red"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_chitiet.php?dept=<?php echo $dept; ?>&ticket_rate=bad"> <font color="red"> Xem chi tiết </font> </a></div>
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
                        <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-teal" data-percent="<?php 
                                                if( $rowcount_total != 0)
                                                {
                                                $per_good = $rowcount_rating_good * 100 / $rowcount_total;
                                                }
                                                else
                                                {
                                                   $per_good = 0;     
                                                }
                                                 echo "$per_good"; 

                                                 ?>" ><span class="percent"><?php echo round($per_good, 1) ; ?> %</span></div>
                                                <div class="text-muted color-teal">Good</div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $rowcount_total != 0)
                                                {
                                                $per_nomal = $rowcount_rating_nomal * 100 / $rowcount_total; 
                                                }
                                                else
                                                {
                                                   $per_nomal = 0;     
                                                }
                                                echo "$per_nomal";  ?>" ><span class="percent"><?php echo round($per_nomal, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Nomal</div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-xs-6 col-md-4">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-red" data-percent="<?php 
                                                if( $rowcount_total != 0)
                                                {
                                                $per_bad = $rowcount_rating_bad * 100 / $rowcount_total; 
                                                }
                                                else
                                                {
                                                   $per_bad = 0;     
                                                }
                                                echo "$per_bad";  ?> ?>" ><span class="percent"><?php echo round($per_bad, 1) ; ?> %</span></div>
                                                <div class="text-muted color-red">Bad</div>
                                        </div>
                                </div>
                        </div>
                </div><!--/.row-->              

        </div>  <!--/.main-->