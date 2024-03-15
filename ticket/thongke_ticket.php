<?php       
        session_start();
        include('../admin/connect.php'); 
        include('../admin/ketnoi.php');
        $dept = isset($_GET['dept']) ? $_GET['dept'] : '' ;                        
                            if (isset($_SESSION['username']))
                            {
    ?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/logo.jpg">
	<title>Analysis Ticket</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="../index.php"><span>Analysis Ticket </span>Admin</a>
				
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="image/avatar.jpg" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php 
							echo $_SESSION['username'] ;	
							?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<?php
                        if (empty($dept) )
                         {
                         ?>                                                     
                        <li class="active"><a href="thongke_ticket.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li><a href="thongke_ticket.php?dept=support"><em class="fa fa-building">&nbsp;</em> Support</a></li>
			<li ><a href="thongke_ticket.php?dept=erp"><em class="fa fa-building">&nbsp;</em> ERP & SAP</a></li>
			<li><a href="thongke_ticket.php?dept=software"><em class="fa fa-building">&nbsp;</em> Develop</a></li>
			<li><a href="thongke_ticket.php?dept=hr"><em class="fa fa-building">&nbsp;</em> HR</a></li>
                        <?php
                        }                                                        
                        else
                        {
                        if($dept == 'support')
                        {
                        	?>
                        <li><a href="thongke_ticket.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li class="active"><a href="thongke_ticket.php?dept=support"><em class="fa fa-building">&nbsp;</em> Support</a></li>
			<li ><a href="thongke_ticket.php?dept=erp"><em class="fa fa-building">&nbsp;</em> ERP & SAP</a></li>
			<li><a href="thongke_ticket.php?dept=software"><em class="fa fa-building">&nbsp;</em> Develop</a></li>
			<li><a href="thongke_ticket.php?dept=hr"><em class="fa fa-building">&nbsp;</em> HR</a></li>
			<?php	
                        }
                        elseif ($dept == 'erp') {
                        ?>
                        <li><a href="thongke_ticket.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li><a href="thongke_ticket.php?dept=support"><em class="fa fa-building">&nbsp;</em> Support</a></li>
			<li class="active"><a href="thongke_ticket.php?dept=erp"><em class="fa fa-building">&nbsp;</em> ERP & SAP</a></li>
			<li><a href="thongke_ticket.php?dept=software"><em class="fa fa-building">&nbsp;</em> Develop</a></li>
			<li><a href="thongke_ticket.php?dept=hr"><em class="fa fa-building">&nbsp;</em> HR</a></li>
			<?php
                        }
                        elseif ($dept == 'software') {
                        	?>
                        <li><a href="thongke_ticket.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li><a href="thongke_ticket.php?dept=support"><em class="fa fa-building">&nbsp;</em> Support</a></li>
			<li><a href="thongke_ticket.php?dept=erp"><em class="fa fa-building">&nbsp;</em> ERP & SAP</a></li>
			<li class="active"><a href="thongke_ticket.php?dept=software"><em class="fa fa-building">&nbsp;</em> Develop</a></li>
			<li><a href="thongke_ticket.php?dept=hr"><em class="fa fa-building">&nbsp;</em> HR</a></li>
			<?php
                        }
                        elseif ($dept == 'hr') {
                        	?>
                        <li><a href="thongke_ticket.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li><a href="thongke_ticket.php?dept=support"><em class="fa fa-building">&nbsp;</em> Support</a></li>
			<li><a href="thongke_ticket.php?dept=erp"><em class="fa fa-building">&nbsp;</em> ERP & SAP</a></li>
			<li><a href="thongke_ticket.php?dept=software"><em class="fa fa-building">&nbsp;</em> Develop</a></li>
			<li class="active"><a href="thongke_ticket.php?dept=hr"><em class="fa fa-building">&nbsp;</em> HR</a></li>
			<?php
		}
                }
                         
                         ?>
                         <!--                                                                  
			<li class="active"><a href="thongke_ticket.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li><a href="thongke_ticket.php?dept=support"><em class="fa fa-building">&nbsp;</em> Support</a></li>
			<li ><a href="thongke_ticket.php?dept=erp"><em class="fa fa-building">&nbsp;</em> ERP & SAP</a></li>
			<li><a href="thongke_ticket.php?dept=software"><em class="fa fa-building">&nbsp;</em> Develop</a></li>
			-->			
		</ul>
	</div><!--/.sidebar-->
	 
	 <?php
	 	require('xuly_thongke_ticket.php');

	 ?>
	  

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
<?php
}
else
{
    header("Location: ../admin/login.php");
}
