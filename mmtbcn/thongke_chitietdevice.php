<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']) )        
        {
            if($_SESSION['admin_cn_mmtb'] >=2 || $_SESSION['admin'] >= 3)
            {     
       $devicetype = isset($_GET['devicetype']) ? $_GET['devicetype'] : '' ;
        $deptdevice = isset($_GET['deptdevice']) ? $_GET['deptdevice'] : '' ;
        
            if(empty($deptdevice))
            {
                if(empty($devicetype))
                {
             $query_total = "SELECT *, DATE_FORMAT(device_update_date, '%d-%m-%Y') as devive_update_date from cn_device ORDER BY device_type_id ASC" ; 
             }
             else
             {
                $query_total = "SELECT *, DATE_FORMAT(device_update_date, '%d-%m-%Y') as devive_update_date  from cn_device WHERE device_type like '%$devicetype%' ORDER BY device_type_id ASC" ; 
             }
            }            
            else
            {                 
                if(empty($devicetype))
                {
                $query_total = "SELECT *, DATE_FORMAT(device_update_date, '%d-%m-%Y') as devive_update_date from cn_device WHERE dept_location = '$deptdevice' ORDER BY device_type_id ASC" ; 
             }
                else
             {
                $query_total = "SELECT *, DATE_FORMAT(device_update_date, '%d-%m-%Y') as device_update_date  from cn_device  WHERE dept_location = '$deptdevice' AND device_type like '%$devicetype%' ORDER BY device_type_id ASC" ; 
             }               
              
            }
        
        $result_total = mysqli_query($connect, $query_total) ;
        $data = array();
?> 


<!DOCTYPE html>
<html>
<head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Danh sách thiết bị</title>
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
                                <a class="navbar-brand" href="thongke_device.php"><span>Device list Detail </span>Admin</a>                                
                        </div>
                </div><!-- /.container-fluid -->
        </nav>
        <!-- </div> -->
        <div class="col-lg-12">
                <div class="row_list_device">
                        <!-- <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Danh sách thiết bị</li>
                        </ol> -->
                        <table id='empTable' class="display wrap custom-tt" style="width:99.5%;">
  <thead>
    <tr>
      <th rowspan="2" colspan="1" scope="col" style="width:25px; text-align: center;">STT</th>
      <th rowspan="2" colspan="1" scope="col" style="width:50px; text-align: center;">Mã Tài Sản</th>
      <th rowspan="2" colspan="1"scope="col" style="width:50px; text-align: center;">Mã thiết bị</th>
      <th rowspan="1" colspan="9"scope="col" style="width:600px; text-align: center;"> Cấu hình thiết bị</th>
      <th  rowspan="2" colspan="1" scope="col" style="width:100px; text-align: center;">Phòng ban</th>
      <th  rowspan="2" colspan="1" scope="col" style="width:150px; text-align: center;">Nhân sự sử dụng</th>
      <th  rowspan="2" colspan="1" scope="col" style="width:150px; text-align: center;">Note</th>      
      <th  rowspan="2" colspan="1" scope="col" style="width:100px; text-align: center;">Ngày cập nhật</th>
      <?php
      if ($_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 2) {      
      ?>
      <th  rowspan="2" colspan="1" scope="col" style="width:25px; text-align: center;">Admin </th>
      <?php 
  }
  ?>
    </tr>

       
    <tr>
      
      <th scope="col" style="width:50px; text-align: center;">Main</th>
      <th scope="col" style="width:50px; text-align: center;">CPU</th>
      <th scope="col" style="width:50px; text-align: center;">RAM</th>
      <th scope="col" style="width:50px; text-align: center;">VGA</th>
      <th scope="col" style="width:50px; text-align: center;">Nguồn</th>
      <th scope="col" style="width:50px; text-align: center;">Hard Disk1</th>
      <th scope="col" style="width:50px;text-align: center;">Hard Disk2</th>
      <th scope="col" style="width:50px;text-align: center;">Màn hình</th>
      <th scope="col" style="width:50px; text-align: center;">Case</th>
    
    </tr>
  </thead>
  
  <tbody>
        <?php
        $dem=1;
        while($row = mysqli_fetch_assoc($result_total))
        {

  ?>
   <?php
        if($row['device_type'] == "PC" || $row['device_type'] == "LT")
        {
            ?>
    <tr> 
       
            <td style="text-align: center;" > <?php echo $dem ; ?> </td>  
      <td><?php echo $row['sap_id'] ; ?></td>  
      <td><?php echo $row['device_name'] ; ?></td>
      <td><?php echo $row['device_main'] ; ?></td>
      <td><?php echo $row['device_cpu'] ; ?></td>
      <td><?php echo $row['device_ram'] ; ?></td>
      <td><?php echo $row['device_vga'] ; ?></td>
      <td><?php echo $row['device_psu'] ; ?></td>
      <td><?php echo $row['device_disk1'] ; ?></td>
      <td><?php echo $row['device_disk2'] ; ?></td>
      <td><?php echo $row['device_monitor'] ; ?></td>
      <td><?php echo $row['device_case'] ; ?></td>
      <td><?php echo $row['dept_name'] ; ?></td>
      <td><?php echo $row['user_name'] ; ?></td>
      <td><?php echo $row['Note'] ; ?></td>
      <td><?php
                $getupdated = $row['device_update_date'];
                $dateupdated = new DateTime($getupdated);
                $today = new DateTime();
                $days = $today->diff($dateupdated)->days;
                if ($days > 1525) {
                echo '<font font-size="14px" color="red">' . $dateupdated->format('d-m-Y') . '</font>';
                } 
                elseif ($days > 1095) {
                echo '<font font-size="14px" color="orange">' . $dateupdated->format('d-m-Y') . '</font>';
                } 
                else {
                       echo '<font font-size="14px" color="green">' . $dateupdated->format('d-m-Y') . '</font>';
                        }
            ?>
                </td>
      <?php
      if ( $_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3) {      
      ?>
      <td style="text-align: center;"><a href="updatedevice.php?deviceid=<?php echo $row['device_name']; ?>&func=update-device&deptdevice=<?php echo $deptdevice; ?>"><font size="5" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatedevice.php?deviceid=<?php echo $row['device_name']; ?>&func=remove-device&deptdevice=<?php echo $deptdevice; ?>"><font size="5" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
      <?php
  }
  ?> 
    </tr> 
    <?php
  $dem++;
}
else
{
  ?>
  <tr>
  <td style="text-align: center;" > <?php echo $dem ; ?> </td>  
      <td><?php echo $row['sap_id'] ; ?></td>  
      <td><?php echo $row['device_name'] ; ?></td>
      <td colspan="9" style="text-align: center;"><?php echo $row['device_orther_name'] ; ?></td>
      <td hidden></td>
      <td hidden></td>
      <td hidden></td>
      <td hidden></td>
      <td hidden></td>
      <td hidden></td>
      <td hidden></td>
      <td hidden></td>
      <td><?php echo $row['dept_name'] ; ?></td>
      <td><?php echo $row['user_name'] ; ?></td>
      <td><?php echo $row['Note'] ; ?></td>      
      <td><?php
                $getupdated = $row['device_update_date'];
                $dateupdated = new DateTime($getupdated);
                $today = new DateTime();
                $days = $today->diff($dateupdated)->days;
                if ($days > 1525) {
                echo '<font font-size="14px" color="red">' . $dateupdated->format('d-m-Y') . '</font>';
                } 
                elseif ($days > 1095) {
                echo '<font font-size="14px" color="orange">' . $dateupdated->format('d-m-Y') . '</font>';
                } 
                else {
                       echo '< font font-size="14px" color="green">' . $dateupdated->format('d-m-Y') . '</font>';
                        }
            ?>
                </td>
      <?php
      if ( $_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 2) {      
      ?>
      <td style="text-align: center;"><a href="updatedevice.php?deviceid=<?php echo $row['device_name']; ?>&func=update-device&deptdevice=<?php echo $deptdevice; ?>" ><font size="5" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatedevice.php?deviceid=<?php echo $row['device_name']; ?>&func=remove-device&deptdevice=<?php echo $deptdevice; ?>"><font size="5" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
      <?php
  }
  ?> 
    
    </tr> 
    <?php
  $dem++;
}  
}
?>

        
</table>
<?php
      if ($_SESSION['admin_cn_mmtb'] >= 2  || $_SESSION['admin'] >= 3) 
      {
            if(!empty($deptdevice))
            {      
            ?>
            <div class="col-lg-1"> <a href="updatedevice.php?deptdevice=<?php echo $deptdevice ?>" class="btn btn-primary">Thêm</a></div>
            <?php
            }
        }
  ?>  
                </div><!--/.row-->
                </div>  
<!-- Script -->
        <script>
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
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                                 //columns: ':visible',
                                
                         columns: [0,1,2,3,4,5,6,7,8,9,10,11,13,15] , // Column index which needs to export
                         }
                    },
                    {
                        extend: 'csv',
                    },
                    {
                        extend: 'excel',
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