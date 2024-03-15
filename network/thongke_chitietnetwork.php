<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']) )        
        {
            if($_SESSION['admin_cn_mmtb'] >=2 || $_SESSION['admin'] >= 3  || $_SESSION['admin_mmtb'] >= 2)
            {     
       $networkprovider = isset($_GET['networkprovider']) ? $_GET['networkprovider'] : '' ;
        $deptnetwork = isset($_GET['deptnetwork']) ? $_GET['deptnetwork'] : '' ;
        
            if(empty($deptnetwork))
            {
                $donvi="all phòng ban";
                if(empty($networkprovider))
                {
             $query_total = "SELECT *,network.network_provider as network_network_provider,network.dept_name as network_dept_name, network.dept_location as network_dept_location, DATE_FORMAT(start_date, '%d-%m-%Y') as start_date, DATE_FORMAT(end_date, '%d-%m-%Y') as end_date from network join network_dept on network.dept_location=network_dept.network_dept join network_provider on network.network_provider=network_provider.network_provider join cn_phongban on network.dept_name=cn_phongban.dept_name ORDER BY network.dept_location ASC" ; 
             }
             else
             {
                $query_total = "SELECT *,network.network_provider as network_network_provider,network.dept_name as network_dept_name, network.dept_location as network_dept_location, DATE_FORMAT(start_date, '%d-%m-%Y') as start_date, DATE_FORMAT(end_date, '%d-%m-%Y') as end_date  from network join network_dept on network.dept_location=network_dept.network_dept join network_provider on network.network_provider=network_provider.network_provider join cn_phongban on network.dept_name=cn_phongban.dept_name WHERE network.network_provider like '%$networkprovider%' ORDER BY network.dept_location ASC" ; 
             }
            }            
            else
            {   
                $donvi=$deptnetwork;              
                if(empty($networkprovider))
                {
                $query_total = "SELECT *,network.network_provider as network_network_provider,network.dept_name as network_dept_name, network.dept_location as network_dept_location, DATE_FORMAT(start_date, '%d-%m-%Y') as start_date, DATE_FORMAT(end_date, '%d-%m-%Y') as end_date from network join network_dept on network.dept_location=network_dept.network_dept join network_provider on network.network_provider=network_provider.network_provider join cn_phongban on network.dept_name=cn_phongban.dept_name WHERE network.dept_location = '$deptnetwork' ORDER BY network.dept_location ASC" ; 
             }
                else
             {
                $query_total = "SELECT *,network.network_provider as network_network_provider,network.dept_name as network_dept_name, network.dept_location as network_dept_location, DATE_FORMAT(start_date, '%d-%m-%Y') as start_date, DATE_FORMAT(end_date, '%d-%m-%Y') as end_date  from network join network_dept on network.dept_location=network_dept.network_dept join network_provider on network.network_provider=network_provider.network_provider  join cn_phongban on network.dept_name=cn_phongban.dept_name WHERE network.dept_location = '$deptnetwork' AND network.network_provider like '%$networkprovider%' ORDER BY network.dept_location ASC" ; 
             }               
              
            }
        
        $result_total = mysqli_query($connect, $query_total) ;
        $data = array();
?> 


<!DOCTYPE html>
<html>
<head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=network-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Danh sách đường truyền</title>
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
                                <a class="navbar-brand" href="thongke_network.php"><span>Network List Detail </span>Admin</a>                                
                        </div>
                </div><!-- /.container-fluid -->
        </nav>
        <!-- </div> -->
        <div class="col-lg-12">
                <div class="row_list_network">
                        <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Danh sách network</li>
                        </ol>
                        <table id='empTable' class="display wrap custom-tt" style="width:99.5%;">
  <thead>
    <tr>
      <th  style="width:25px; text-align: center;">STT</th>
      <th  style="width:70px; text-align: center;">Tên đường truyền</th>
      <th  style="width:50px; text-align: center;">Tên gói cước</th>
      <th  style="width:70px; text-align: center;">Username</th>
      <th  style="width:50px; text-align: center;">Password</th>
      <th  style="width:50px; text-align: center;">Nhà cung cấp</th>
      <th  style="width:70px; text-align: center;">Đơn vị sử dụng</th>
      <th  style="width:70px; text-align: center;">Địa điểm làm việc</th>  
      <th  style="width:50px; text-align: center;">Ngày bắt đầu</th>
      <th  style="width:50px; text-align: center;">Ngày kết thúc</th>
      <th  style="width:50px; text-align: center;">Thời gian gia hạn (tháng)</th>
      <th  style="width:80px; text-align: center;">Giá tiền</th>
      <th  style="width:100px; text-align: center;">Ghi chú</th>
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
    <td><?php echo $row['network_name'] ; ?></td>  
     <td><?php echo $row['network_type'] ; ?></td>
     <td><?php echo $row['network_usr'] ; ?></td>
     <td><?php echo $row['network_pass'] ; ?></td>
     <td><?php echo $row['network_provider_detail'] ; ?></td>
     <td><?php echo $row['Note_phongban'] ; ?></td>
     <td><?php echo $row['network_dept_detail'] ; ?></td>
     <td><?php echo $row['start_date'] ; ?></td>
     <td><?php 
         $getupdated = $row['end_date'];
         $dateupdated = new DateTime($getupdated);
         $today = new DateTime();
         $days = $dateupdated->diff($today)->days;
         if ($days < 45) {
         echo '<font font-size="14px" color="red" >' . $dateupdated->format('d-m-Y') . '</font>';
         } 
         elseif ($days < 90) {
         echo '<font font-size="14px" color="orange">' . $dateupdated->format('d-m-Y') . '</font>';
         } 
         else {
                echo '<font font-size="14px" color="green">' . $dateupdated->format('d-m-Y') . '</font>';
                 }
     ?>
     </td>
     <td><?php echo $row['duration'] ; ?></td>
     <td><?php 
         $tiente=$row['network_price'] ; 
         //Định dạng dấu phân cách tiền tệ và phần thập phân
         $formatted_tiente = number_format($tiente, 0, '.', ',');
         // Đơn vị tiền tệ
        $donvitiente = 'VND';
        // Hiển thị số tiền với dấu phân cách hàng nghìn, ký tự tiền tệ
        $hienthitiente = $formatted_tiente . ' ' . $donvitiente;
        // Hiển thị số tiền đã được định dạng
        echo $hienthitiente; 
    ?></td>
        <td><?php echo $row['network_note'] ; ?></td>
      <?php
      if ( $_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3 || $_SESSION['admin_mmtb'] >= 2) { 
      if($deptnetwork != null)
      {     
      ?>

      <td><a href="updatenetwork.php?networkid=<?php echo $row['network_id']; ?>&func=update-network&deptnetwork=<?php echo $row['dept_location']; ?>" target="_blank"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatenetwork.php?networkid=<?php echo $row['network_id']; ?>&func=remove-network&deptnetwork=<?php echo$row['dept_location']; ?>" target="_blank"><font size="6" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
      <?php
        }
        else
        {
        ?>
        <td><a href="updatenetwork.php?networkid=<?php echo $row['network_id']; ?>&func=update-network" target="_blank"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatenetwork.php?networkid=<?php echo $row['network_id']; ?>&func=remove-network" target="_blank"><font size="6" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
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
            if($deptnetwork != null)
            {      
            ?>
            <div class="col-lg-1"> <a href="updatenetwork.php?deptnetwork=<?php echo $deptnetwork; ?>" class="btn btn-primary">Thêm</a></div>
            <?php
            }
            else
            {
                ?>
                <div class="col-lg-1"> <a href="updatenetwork.php" class="btn btn-primary">Thêm</a></div>
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
                        title: 'Xuất dữ liệu network đơn vị ' + donvi ,
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Xuất dữ liệu network đơn vị ' + donvi ,
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                                 //columns: ':visible',
                                
                         columns: [0,1,2,3,4,5,6,7,8,9,10,11,13,15] , // Column index which needs to export
                         }
                    },
                    {
                        extend: 'csv',
                        title: 'Xuất dữ liệu network đơn vị ' + donvi ,
                    },
                    {
                        extend: 'excel',
                        title: 'Xuất dữ liệu network đơn vị ' + donvi ,
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