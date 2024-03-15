<?php       
        session_start();
        include('../admin/connect.php');                        
        if (isset($_SESSION['username']))
        {
        $phongban=$_SESSION['staff_location'];
        if($phongban == "cty")
        {
        	 $query_dept = "SELECT * FROM network_dept" ;
        }	
        else
        {
        	$query_dept = "SELECT * FROM network_dept WHERE network_dept like '%$phongban%'"  ;
        }
        $result_dept = mysqli_query($connect, $query_dept) ; 
    ?> 

<!DOCTYPE html>
<html> 
<head>
	<<meta charset="utf-8">
        <meta name="viewport" content="width=network-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Thống kê đường truyền internet</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">        
        <!-- <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'> -->
        <!-- <link href='https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'> -->
        <style type="text/css">
            .dt-buttons{
                width: 100%;
            }
        </style>   
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
        <!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
        <!-- <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script> -->
        <link href="DataTables/datatables.min.css" rel="stylesheet"/>
 
        <script src="DataTables/datatables.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="../index.php"><span>Category Component </span>Admin <?php echo $_SESSION['staff_location'] ; ?></a>
				
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
		<!-- <h4 style="  background-color: #00f3ff5e;color: #8b00ff;margin-bottom: -15px;height: 54px;padding-top: 16px;font-size: 25px;"> Danh mục thiết bị </h4>		 -->
		<ul class="nav menu">
		<?php 
			while($row_dept = mysqli_fetch_assoc($result_dept))				
        {
        	?>
        	<li><a href="thongke_network.php?deptnetwork=<?php echo $row_dept['network_dept'] ; ?>"><em class="fa fa-building">&nbsp;</em> 
        		<?php 
        		echo $row_dept['network_dept_detail'] ;
        	?>
        	</a></li>
        	<?php
        }
        ?>
        <!-- <li class="active"><a href="thongke_category.php"><em class="fa fa-dashboard">&nbsp;</em> Thêm Danh Mục</a></li> -->
		</ul>
		
        
	</div><!--/.sidebar-->
	 
	 <?php
	 	require('xuly_thongke_network.php');

	 ?>
	  

	<!-- <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script> -->
	
</body>
</html>
<?php
}
else
{
    header("Location: ../admin/login.php");
}
