<?php       
        session_start();
        include('../admin/connect.php'); 
        $donvi = isset($_GET['donvi']) ? $_GET['donvi'] : '' ;                        
                            if (isset($_SESSION['username']))
                            {
    ?> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/logo.jpg">
	<title>Office 365 Manager</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<!-- Ionicons Fonts Css -->        
    <link rel="stylesheet" href="css/ionicons.min.css">
	
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
				<a class="navbar-brand" href="../index.php"><span>Office 365 Manager </span>Admin</a>				
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
                        if (empty($donvi) )
                         {
                         ?>                                                     
                        <li class="active"><a href="office365.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li><a href="office365.php?donvi=cty"><em class="fa fa-building">&nbsp;</em> Tổng Công Ty</a></li>
			<li ><a href="office365.php?donvi=tienphong"><em class="fa fa-building">&nbsp;</em>CN Tiên Phong</a></li>
			<li ><a href="office365.php?donvi=dona"><em class="fa fa-building">&nbsp;</em>CN Dona</a></li>
			<li ><a href="office365.php?donvi=hoaanhphat"><em class="fa fa-building">&nbsp;</em>Hòa Anh Phát</a></li>
			<li ><a href="office365.php?donvi=chinhanh"><em class="fa fa-building">&nbsp;</em> Các Chi Nhánh</a></li>			
                        <?php
                        }                                                        
                        else
                        {
                        if($donvi == 'cty')
                        {
                        	?>
                        <li ><a href="office365.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li class="active"><a href="office365.php?donvi=cty"><em class="fa fa-building">&nbsp;</em> Tổng Công Ty</a></li>
			<li ><a href="office365.php?donvi=tienphong"><em class="fa fa-building">&nbsp;</em>CN Tiên Phong</a></li>
			<li ><a href="office365.php?donvi=dona"><em class="fa fa-building">&nbsp;</em>CN Dona</a></li>
			<li ><a href="office365.php?donvi=hoaanhphat"><em class="fa fa-building">&nbsp;</em>Hòa Anh Phát</a></li>
			<li ><a href="office365.php?donvi=chinhanh"><em class="fa fa-building">&nbsp;</em> Các Chi Nhánh</a></li>
			<?php	
                        }
                        elseif ($donvi == 'tienphong') {
                        ?>
                        <li ><a href="office365.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li ><a href="office365.php?donvi=cty"><em class="fa fa-building">&nbsp;</em> Tổng Công Ty</a></li>
			<li class="active"><a href="office365.php?donvi=tienphong"><em class="fa fa-building">&nbsp;</em>CN Tiên Phong</a></li>
			<li ><a href="office365.php?donvi=dona"><em class="fa fa-building">&nbsp;</em>CN Dona</a></li>
			<li ><a href="office365.php?donvi=hoaanhphat"><em class="fa fa-building">&nbsp;</em>Hòa Anh Phát</a></li>
			<li ><a href="office365.php?donvi=chinhanh"><em class="fa fa-building">&nbsp;</em> Các Chi Nhánh</a></li>
			<?php
                        }
                     elseif ($donvi == 'dona') {
                        ?>
                        <li ><a href="office365.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li ><a href="office365.php?donvi=cty"><em class="fa fa-building">&nbsp;</em> Tổng Công Ty</a></li>
			<li ><a href="office365.php?donvi=tienphong"><em class="fa fa-building">&nbsp;</em>CN Tiên Phong</a></li>
			<li class="active"><a href="office365.php?donvi=dona"><em class="fa fa-building">&nbsp;</em>CN Dona</a></li>
			<li ><a href="office365.php?donvi=hoaanhphat"><em class="fa fa-building">&nbsp;</em>Hòa Anh Phát</a></li>
			<li ><a href="office365.php?donvi=chinhanh"><em class="fa fa-building">&nbsp;</em> Các Chi Nhánh</a></li>
			<?php
                        }
                        elseif ($donvi == 'hoaanhphat') {
                        ?>
                        <li ><a href="office365.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li ><a href="office365.php?donvi=cty"><em class="fa fa-building">&nbsp;</em> Tổng Công Ty</a></li>
			<li ><a href="office365.php?donvi=tienphong"><em class="fa fa-building">&nbsp;</em>CN Tiên Phong</a></li>
			<li ><a href="office365.php?donvi=dona"><em class="fa fa-building">&nbsp;</em>CN Dona</a></li>
			<li class="active"><a href="office365.php?donvi=hoaanhphat"><em class="fa fa-building">&nbsp;</em>Hòa Anh Phát</a></li>
			<li ><a href="office365.php?donvi=chinhanh"><em class="fa fa-building">&nbsp;</em> Các Chi Nhánh</a></li>
			<?php
                        }
                        elseif ($donvi == 'chinhanh') {
                        ?>
                        <li ><a href="office365.php"><em class="fa fa-bookmark">&nbsp;</em> Tổng hợp</a></li>
			<li ><a href="office365.php?donvi=cty"><em class="fa fa-building">&nbsp;</em> Tổng Công Ty</a></li>
			<li ><a href="office365.php?donvi=tienphong"><em class="fa fa-building">&nbsp;</em>CN Tiên Phong</a></li>
			<li ><a href="office365.php?donvi=dona"><em class="fa fa-building">&nbsp;</em>CN Dona</a></li>
			<li ><a href="office365.php?donvi=hoaanhphat"><em class="fa fa-building">&nbsp;</em>Hòa Anh Phát</a></li>
			<li class="active"><a href="office365.php?donvi=chinhanh"><em class="fa fa-building">&nbsp;</em> Các Chi Nhánh</a></li>
			<?php
                        }
                }
                         
                         ?>                         
		</ul>
	</div><!--/.sidebar-->
	 
	 <?php
	 	require('xuly_office365.php');

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
<!--
            ==================================================
            Footer Section Start
            ================================================== 
            <footer id="footer">
                <div class="container">                    
                    <div class="col-md-12">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>                                 
                </div>
            </footer> 
            -->
</html>
<?php
}
else
{
    header("Location: ../admin/login.php");
}
