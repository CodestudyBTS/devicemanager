<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']) )        
        {
            if($_SESSION['admin'] >=3)
            {     
             $query_total = "SELECT * from member" ; 
            $result_total = mysqli_query($connect, $query_total) ;
            $data = array();
?> 


<!DOCTYPE html>
<html>
<head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>List Member</title>
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
                                <a class="navbar-brand" href="../index.php"><span>List member</span>Admin</a>                                
                        </div>
                </div><!-- /.container-fluid -->
        </nav>
        <!-- </div> -->
        <div class="col-lg-12">
                <div class="row_list_device">
                        <ol class="breadcrumb">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Danh sách member</li>
                        </ol>
                        <table id='empTable' class="display nowrap custom-tt" style="width:99.5%;">
  <thead>
    <tr>
      <th rowspan="2" colspan="1" scope="col" style="width:25px; text-align: center;">STT</th>
      <th rowspan="2" colspan="1" scope="col" style="width:100px; text-align: center;">Username</th>
      <th rowspan="2" colspan="1"scope="col" style="width:100px; text-align: center;">Tên Hiển Thị</th>
      <th rowspan="2" colspan="1"scope="col" style="width:100px; text-align: center;">Nơi làm việc</th>
      <th rowspan="1" colspan="6"scope="col" style="width:900px; text-align: center;"> Bảng phân quyền</th>
      <th  rowspan="2" colspan="1" scope="col" style="width:25px; text-align: center;">Thời gian đăng nhập</th>
      <?php
      if ($_SESSION['admin'] >= 3) {      
      ?>
      <th  rowspan="2" colspan="1" scope="col" style="width:25px; text-align: center;">Admin </th>
      <?php 
  }
  ?>
    </tr>

       
    <tr>
      
      <th scope="col" style="width:100px; text-align: center;">Admin Global</th>
      <th scope="col" style="width:100px; text-align: center;">Admin Office 365</th>
      <th scope="col" style="width:100px; text-align: center;">Admin Rating</th>
      <th scope="col" style="width:100px; text-align: center;">Admin Ticket</th>
      <th scope="col" style="width:100px; text-align: center;">Admin MMTB CTY</th>
      <th scope="col" style="width:100px; text-align: center;">Admin MMTB CN</th>
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
    <td><?php echo $row['username'] ; ?></td>
    <td><?php echo $row['fullname'] ; ?></td>
    <td><?php echo $row['email'] ; ?></td>
    <td><?php echo $row['admin'] ; ?></td>
    <td><?php echo $row['admin_365'] ; ?></td>
    <td><?php echo $row['admin_rating'] ; ?></td>
    <td><?php echo $row['admin_ticket'] ; ?></td>
    <td><?php echo $row['admin_mmtb'] ; ?></td>
    <td><?php echo $row['admin_cn_mmtb'] ; ?></td>
    <td><?php echo $row['date_login'] ; ?></td>
      <?php
      if ( $_SESSION['admin'] >= 3 ) {      
      ?>
    <td><a href="addmember.php?memberid=<?php echo $row['id']; ?>&func=update-member" target="_blank"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="addmember.php?memberid=<?php echo $row['id']; ?>&func=remove-member" target="_blank"><font size="6" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
      <?php
  }
  ?> 
    </tr> 
    <?php
  $dem++;
}
?>      
</table>
<?php
      if ( $_SESSION['admin'] >= 3 ) {      
      ?>
<div class="col-lg-12"> <a href="addmember.php" class="btn btn-primary">Thêm Member</a></div>
<?php
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