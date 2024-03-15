<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))        {     
       
            $query_total = "SELECT *, DATE_FORMAT(update_date, '%d-%m-%Y') as update_date from thanhly_device " ;      
            $result_total = mysqli_query($connect, $query_total) ;
            $data = array();
?> 


<!DOCTYPE html>
<html>
<head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Danh sách linh kiện thanh lý</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">        
        <style type="text/css">
            .dt-buttons{
                width: 100%;
            }
        </style>   
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
        <link href="DataTables/datatables.min.css" rel="stylesheet">
 
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
                <div class="row_list">
                        <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Danh sách linh kiện thanh lý</li>
                        </ol>
                        <table id='empTable' class="display nowrap custom-tt">
  <thead>
    <tr>
      <th scope="col " style="width:25px; text-align:center;">STT</th>
      <th scope="col" style="text-align:center;">Tên linh kiện</th>
      <th scope="col" style="text-align:center;">Tên thiết bị</th>
      <th scope="col" style="text-align:center;">Danh mục</th>
      <th scope="col" style="text-align:center;">Mã Tài sản</th>
      <th scope="col" style="text-align:center;">Ghi chú</th>      
      <th scope="col" style="width:150px; text-align:center;">Ngày cập nhật</th>      
    </tr>
  </thead>
  
  <tbody>
        <?php
        $dem=1;
        while($row = mysqli_fetch_assoc($result_total))
        {

  ?>
    <tr>
      <td > <?php echo $dem ; ?> </td>    
      <td><?php echo $row['component_name'] ; ?></td>
      <td><?php echo $row['device_name'] ; ?></td>
      <td><?php echo $row['category'] ; ?></td>
      <td><?php echo $row['sap_id'] ; ?></td>
      <td><?php echo $row['Note'] ; ?></td>
      <td><?php echo $row['update_date'] ; ?></td>
      
    </tr> 
    <?php
  $dem++;
}
?>
  
</table>
                </div><!--/.row-->
                </div>  
<!-- Script -->
        <script>
        $(document).ready(function(){
            var empDataTable = $('#empTable').DataTable({                        
                dom: 'Blfrtip',   
                oLanguage: {
                    "sSearch": "Tìm kiếm:"
                },
                language: {
                    "lengthMenu": "Hiển thị _MENU_ dòng trên trang",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "info": "Hiển thị trang _PAGE_ trên _PAGES_ trang",
                    "infoEmpty": "Không có kết quản khả dụng",
                    'paginate': {
                        'previous': "Trang trước",
                        'next': "Trang sau"
                    }
                },             
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Danh sách linh kện thanh lý',
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Danh sách linh kện thanh lý',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                                columns: ':visible',
                                
                           // columns: [0,1] // Column index which needs to export
                        }
                    },
                    {
                        extend: 'csv',
                        title: 'Danh sách linh kện thanh lý',
                    },
                    {
                        extend: 'excel',
                        title: 'Danh sách linh kện thanh lý',
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
    header("Location: ../admin/login.php");
}