<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']) )        
        {
            if($_SESSION['admin_cn_mmtb'] >=2 || $_SESSION['admin'] >= 3  || $_SESSION['admin_mmtb'] >= 2)
            {     
       $cameraprovider = isset($_GET['cameraprovider']) ? $_GET['cameraprovider'] : '' ;
        $deptcamera = isset($_GET['deptcamera']) ? $_GET['deptcamera'] : '' ;
        
            if(empty($deptcamera))
                $donvi="all-network";
            {
                if(empty($cameraprovider))
                {
             $query_total = "SELECT *,DATE_FORMAT(camera.update_date, '%d-%m-%Y') as update_date from camera join network_dept on camera.cam_dept_location=network_dept.network_dept join camera_provider on camera.ten_thuonghieu=camera_provider.camera_provider join cn_phongban on camera.cam_dept_name=cn_phongban.dept_name ORDER BY camera.cam_dept_location ASC" ; 
             }
             else
             {
                $query_total = "SELECT *,DATE_FORMAT(camera.update_date, '%d-%m-%Y') as update_date from camera join network_dept on camera.cam_dept_location=network_dept.network_dept join camera_provider on camera.ten_thuonghieu=camera_provider.camera_provider join cn_phongban on camera.cam_dept_name=cn_phongban.dept_name WHERE camera.ten_thuonghieu like '%$cameraprovider%' ORDER BY camera.cam_dept_location ASC" ; 
             }
            }            
            else
            {   
                $donvi=$deptcamera;              
                if(empty($cameraprovider))
                {
                $query_total = "SELECT *,DATE_FORMAT(camera.update_date, '%d-%m-%Y') as update_date from camera join network_dept on camera.cam_dept_location=network_dept.network_dept join camera_provider on camera.ten_thuonghieu=camera_provider.camera_provider join cn_phongban on camera.cam_dept_name=cn_phongban.dept_name WHERE camera.cam_dept_location = '$deptcamera' ORDER BY camera.cam_dept_location ASC" ; 
             }
                else
             {
                $query_total = "SELECT **,DATE_FORMAT(camera.update_date, '%d-%m-%Y') as update_date from camera join network_dept on camera.cam_dept_location=network_dept.network_dept join camera_provider on camera.ten_thuonghieu=camera_provider.camera_provider join cn_phongban on camera.cam_dept_name=cn_phongban.dept_name WHERE camera.cam_dept_location = '$deptcamera' AND camera.ten_thuonghieu like '%$cameraprovider%' ORDER BY camera.cam_dept_location ASC" ; 
             }               
              
            }
        
        $result_total = mysqli_query($connect, $query_total) ;
        $data = array();
?> 


<!DOCTYPE html>
<html>
<head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=camera-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Danh sách hệ thống camera</title>
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
        <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script> -->
        <link href="DataTables/datatables.min.css" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css"> -->
 
        <script src="DataTables/datatables.min.js"></script>
</head>
<body>
    <!-- <div class="col-lg-12"> -->
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span></button>
                                <a class="navbar-brand" href="thongke_camera.php"><span>camera List Detail </span>Admin</a>                                
                        </div>
                </div><!-- /.container-fluid -->
        </nav>
        <!-- </div> -->
        <div class="col-lg-12">
                <div class="row_list_camera">
                        <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Danh sách hệ thống camera</li>
                        </ol>
                        <table id='empTable' class="display wrap custom-tt" style="width:99.5%;">
  <thead>
    <tr>
      <th  style="width:25px; text-align: center;">STT</th>
      <th  style="width:100px; text-align: center;">Tên đầu ghi</th>
      <th  style="width:100px; text-align: center;">Tên camera</th>
      <th  style="width:50px; text-align: center;">Số lượng</th>
      <th  style="width:50px; text-align: center;">Tên thương hiệu</th>
      <th  style="width:50px; text-align: center;">Dung lượng lưu trữ</th>
      <th  style="width:100px; text-align: center;">Username</th>
      <th  style="width:100px; text-align: center;">Password</th>
      <th  style="width:150px; text-align: center;">Domain/IP</th>
      <th  style="width:100px; text-align: center;">Đơn vị sử dụng</th>
      <th  style="width:100px; text-align: center;">Địa điểm làm việc</th>  
      <th  style="width:50px; text-align: center;">Port media</th>
      <th  style="width:50px; text-align: center;">Port http</th>
      <th  style="width:70px; text-align: center;">Ngày cập nhật</th>
      <?php
      if ($_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3  || $_SESSION['admin_mmtb'] >= 2) {      
      ?>
      <th style="width:25px; text-align: center;">Admin </th>
      <?php 
  }
  ?>
    </tr>
  </thead>
  
  <tbody>
        <?php
        $dem=1;
        while($row = mysqli_fetch_assoc($result_total))
        {

  ?>
    <tr> 
    <td style="text-align: center;" > <?php echo $dem ; ?> </td>  
    <td><?php echo $row['ten_daughi'] ; ?></td>  
     <td><?php echo $row['ten_camera'] ; ?></td>
     <td><?php echo $row['sl_camera']." cái" ; ?></td>
     <td><?php echo $row['ten_thuonghieu'] ; ?></td>
     <td><?php echo $row['camera_disk'] ; ?></td>
     <td><?php echo $row['username_cam'] ; ?></td>
     <td><?php echo $row['password_cam'] ; ?></td>
     <td><?php echo $row['domain_cam'] ; ?></td>
     <td><?php echo $row['Note_phongban'] ; ?></td>
     <td><?php echo $row['network_dept_detail'] ; ?></td>
     <td><?php echo $row['port_media'] ; ?></td>
     <td><?php echo $row['port_http'] ; ?></td>
     <td><?php echo $row['update_date'] ; ?></td>
      <?php
      if ( $_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3 || $_SESSION['admin_mmtb'] >= 2) { 
      if($deptcamera != null)
      {     
      ?>

      <td><a href="updatecamera.php?cameraid=<?php echo $row['camera_id']; ?>&func=update-camera&deptcamera=<?php echo $row['dept_location']; ?>" target="_blank"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatecamera.php?cameraid=<?php echo $row['camera_id']; ?>&func=remove-camera&deptcamera=<?php echo$row['dept_location']; ?>" target="_blank"><font size="6" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
      <?php
        }
        else
        {
        ?>
        <td><a href="updatecamera.php?cameraid=<?php echo $row['camera_id']; ?>&func=update-camera" target="_blank"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatecamera.php?cameraid=<?php echo $row['camera_id']; ?>&func=remove-camera" target="_blank"><font size="6" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
        <?php 
        }
    }
        ?> 
    </tr> 
    <?php
  $dem++;
}
?> 
</tbody>       
</table>
<?php
      if ($_SESSION['admin_cn_mmtb'] >= 2  || $_SESSION['admin'] >= 3 || $_SESSION['admin_mmtb'] >= 2 ) 
      {
            if($deptcamera != null)
            {      
            ?>
            <div class="col-lg-1"> <a href="updatecamera.php?deptcamera=<?php echo $deptcamera; ?>" class="btn btn-primary">Thêm</a></div>
            <?php
            }
            else
            {
                ?>
                <div class="col-lg-1"> <a href="updatecamera.php" class="btn btn-primary">Thêm</a></div>
                <?php 
            }
        }
  ?>  
                </div><!--/.row-->
                </div>  
<!-- Script -->
        <script>
            var donvi = "<?php echo $donvi; ?>";
        $(document).ready(function(){

            var empDataTable = $('#empTable').DataTable({                   
                dom: 'CBlfrtip',   
                oLanguage: {
                    "sSearch": "Tìm kiếm:"
                },
                language: {
                    "lengthMenu": "Hiển thị _MENU_ dòng trên trang",
                    "zeroRecords": "Không có dữ liệu",
                    "info": "Hiển thị trang _PAGE_ trên _PAGES_ trang",
                    "infoEmpty": "Hiển thị trang _PAGES_ trên _PAGES_ trang",
                    'paginate': {
                        'previous': "Trang trước",
                        'next': "Trang sau"
                    }
                },             
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Xuất dữ liệu hệ thống camera đơn vị ' + donvi ,
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Xuất dữ liệu hệ thống camera đơn vị ' + donvi ,
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                                 //columns: ':visible',
                                
                         columns: [0,1,2,3,4,5,6,7,8,9,10,11,13,15] , // Column index which needs to export
                         }
                    },
                    {
                        extend: 'csv',
                        title: 'Xuất dữ liệu hệ thống camera đơn vị ' + donvi ,
                    },
                    {
                        extend: 'excel',
                        title: 'Xuất dữ liệu hệ thống camera đơn vị ' + donvi ,
                    }         
                ] ,                 
            lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
            });


        });
        </script>          
          
</body>

</html>

<?php
    }
    else
    {
        header("Location: ../index.php");
    }
}
else
{
    header("Location: ../admin/login.php");
}