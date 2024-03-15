<?php       
        include('../admin/connect.php');
        include('../admin/ketnoi.php');
        $dept = isset($_GET['dept']) ? $_GET['dept'] : '' ; 
    ?> 

<!-- count total ticket -->
<?php
$query_total = "SELECT osticket_db.ost_ticket.ticket_id , osticket_db.ost_ticket.number AS number_id,  osticket_db.ost_ticket_status.state AS status_ticket, osticket_db.ost_ticket__cdata.subject AS subject_ticket, osticket_db.ost_user_email.address AS user_email, osticket_db.ost_staff.firstname AS firstname_staff, osticket_db.ost_staff.lastname AS lastname_staff, osticket_db.ost_staff.email AS email_staff, osticket_db.ost_ticket.created AS ticket_create, osticket_db.ost_department.name AS dept_staff     
        FROM osticket_db.ost_ticket 
        join osticket_db.ost_ticket__cdata on osticket_db.ost_ticket.ticket_id=osticket_db.ost_ticket__cdata.ticket_id 
        join osticket_db.ost_ticket_status on osticket_db.ost_ticket.status_id=osticket_db.ost_ticket_status.id
        join  osticket_db.ost_user_email on osticket_db.ost_ticket.user_id=osticket_db.ost_user_email.user_id
        join  osticket_db.ost_staff on osticket_db.ost_ticket.staff_id=osticket_db.ost_staff.staff_id
        join osticket_db.ost_department on osticket_db.ost_ticket.dept_id=osticket_db.ost_department.id 
        WHERE osticket_db.ost_department.name like '%$dept%' " ;
$result_total = mysqli_query($connect_osticket, $query_total) ;
$rowcount_total = mysqli_num_rows( $result_total );
// $row = mysqli_fetch_array($result_total);
?>

<!-- count total ticket rated -->
<?php
$query_ticket_rated = "SELECT * from rating WHERE ticket_dept like '%$dept%' " ;
$result_ticket_rated = mysqli_query($connect, $query_ticket_rated) ;
$rowcount_ticket_rated = mysqli_num_rows( $result_ticket_rated );
// $row = mysqli_fetch_array($result_ticket_rated);
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
                                <div class="col-xs-6 col-md-3 col-lg-4 no-padding">
                                        <div class="panel panel-teal panel-widget border-right">
                                                <div class="text-muted color-blue">General ticket </div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-blue"></em>
                                                        <div class="large"><?php echo "$rowcount_total";?></div> 
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-blue "><a href="thongke_ticket_chitiet.php"> Xem chi tiết </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-blue "><a href="thongke_ticket_chitiet.php?dept=<?php echo $dept; ?>"> Xem chi tiết </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-4 no-padding">
                                        <div class="panel panel-blue panel-widget border-right">
                                                <div class="text-muted color-teal">Ticket rated</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-teal"></em> 
                                                        <div class="large"><?php echo "$rowcount_ticket_rated";?></div>                                                
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted color-teal "><a href="thongke_ticket_rated_chitiet.php"> <font color="teal"> Xem chi tiết </font></a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-teal "><a href="thongke_ticket_rated_chitiet.php?dept=<?php echo $dept; ?>"> <font color="teal"> Xem chi tiết </font> </a></div>
                                                                <?php
                                                        }
                                                        ?>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-xs-6 col-md-3 col-lg-4 no-padding">
                                        <div class="panel panel-orange panel-widget border-right">
                                                <div class="text-muted color-orange">Ticket NOT Rate</div>
                                                <div class="row no-padding"><em class="fa fa-xl fas fa-braille color-orange"></em>
                                                        <div class="large"><?php 
                                                                $ticket_not_rate = $rowcount_total -  $rowcount_ticket_rated ;

                                                        echo "$ticket_not_rate";?></div>
                                                        <?php
                                                        if (empty($dept) )
                                                        {
                                                        ?>                                                     
                                                        <div class="text-muted"><a href="thongke_ticket_chitiet.php?rate=not_rate"> <font color="orange"> Xem chi tiết </font> </a></div>
                                                        <?php
                                                        }                                                        
                                                        else
                                                        {
                                                                ?>
                                                                <div class="text-muted color-orange "><a href="thongke_ticket_chitiet.php?dept=<?php echo $dept; ?>&rate=rate"> <font color="orange"> Xem chi tiết </font> </a></div>
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
                                <h2 class="page-header">Percent Rate</h2>
                        </div>
                </div><!--/.row-->
                
                <div class="row">
                        <div class="col-xs-6 col-md-6">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-teal" data-percent="<?php 
                                                if( $rowcount_total != 0)
                                                {
                                                $per_rated = $rowcount_ticket_rated * 100 / $rowcount_total;
                                                }
                                                else
                                                {
                                                   $per_rated = 0;     
                                                }
                                                 echo "$per_rated"; 

                                                 ?>" ><span class="percent"><?php echo round($per_rated, 1) ; ?> %</span></div>
                                                <div class="text-muted color-teal">Percent Rated</div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                                <div class="panel panel-default">
                                        <div class="panel-body easypiechart-panel">
                                                <div class="easypiechart" id="easypiechart-orange" data-percent="<?php 
                                                if( $rowcount_total != 0)
                                                {
                                                $per_ticket_not_rate = $ticket_not_rate * 100 / $rowcount_total; 
                                                }
                                                else
                                                {
                                                   $per_ticket_not_rate = 0;     
                                                }
                                                echo "$per_ticket_not_rate";  ?>" ><span class="percent"><?php echo round($per_ticket_not_rate, 1) ; ?> %</span></div>
                                                <div class="text-muted color-orange">Percent NOT Rate</div>
                                        </div>
                                </div>
                        </div>
                        <!-- <div class="col-xs-6 col-md-4">
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
                        </div> -->
                </div><!--/.row-->              

        </div>  <!--/.main-->