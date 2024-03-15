<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))        {    
        
        $donvi = isset($_GET['donvi']) ? $_GET['donvi'] : '' ;
        $lic = isset($_GET['lic']) ? $_GET['lic'] : '' ; 
        $type_mail = isset($_GET['mail']) ? $_GET['mail'] : '' ;
        $type_mail365 = isset($_GET['typemail']) ? $_GET['typemail'] : '' ;
        if(empty($type_mail) )
        {   
            $type_mail = "office365";
            if(empty($donvi) && empty($lic) )
            {
                if(empty($type_mail365))
                {
             $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat  from mail_office365 WHERE Type like '%Mail_user%'" ; 
             }
             else
             {
                $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat from mail_office365 WHERE Type like '%Meeting%'" ; 
             }
            }
            elseif(empty($lic))
            {
                if(empty($type_mail365))
                {
                    $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat from mail_office365 WHERE donvi like '%$donvi%' AND Type like '%Mail_user%' " ;
             }
             else
             {
                $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat from mail_office365 WHERE donvi like '%$donvi%' AND Type like '%Meeting%' " ;
             }
            }            
            else
            {
                
            $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat from mail_office365 WHERE donvi like '%$donvi%' AND License like '%$lic%' " ;               
              
            }
    }
        else
        {
            $type_mail = "bitisgroup";
            if(empty($donvi))
            {
                $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat from mail_bitisgroup " ;
            }
            else
            {
            $query_total = "SELECT *, DATE_FORMAT(NgayCapNhat, '%d-%m-%Y') as NgayCapNhat from mail_bitisgroup WHERE donvi like '%$donvi%' " ;
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
        <title>Office 365 Manager Detail</title>
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
                                <a class="navbar-brand" href="office365.php"><span>Office 365 Manager Detail </span>Admin</a>                                
                        </div>
                </div><!-- /.container-fluid -->
        </nav>
        <!-- </div> -->
        <div class="col-lg-12">
                <div class="row_list">
                        <ol class="breadcrumb">
                                <li><a href="#">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Charts</li>
                        </ol>
                        <table id='empTable' class="display compact">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Username</th>
      <th scope="col">Domain_Mail</th>
      <th scope="col">Full Name</th>
      <th scope="col">Type_mail</th>
      <th scope="col">License </th>
      <th scope="col">Branch</th>
      <th scope="col">Branch_Detail</th>
      <th scope="col">Note</th>      
      <th scope="col">Date Updated</th>
      <?php
      if ($_SESSION['admin365'] == 2) {      
      ?>
      <th scope="col">Admin </th>
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
      <td > <?php echo $dem ; ?> </td>  
      <td><?php echo $row['Username'] ; ?></td>   
      <td><?php echo $row['Mail'] ; ?></td>
      <td><?php echo $row['TenHienThi'] ; ?></td>
      <td><?php echo $row['Type'] ; ?></td>
      <td><?php echo $row['License'] ; ?></td>
      <td><?php 
                    if($row['DonVi'] == "tongcty")
                    {
                      echo "Tổng Công Ty";
                    }
                    elseif($row['DonVi'] == "tienphong")
                    {
                      echo "CN Tiên Phong";
                    }
                    elseif($row['DonVi'] == "dona")
                    {
                      echo "CN DONA";
                    }
                    elseif($row['DonVi'] == "cacchinhanh")
                    {
                      echo "Các Chi Nhánh";
                    }
                    elseif($row['DonVi'] == "hoaanhphat")
                    {
                      echo "Hòa Anh Phát";
                    }
                    ?> </td>
      <td><?php echo $row['CNcuthe'] ; ?></td>
      <td><?php echo $row['Note'] ; ?></td>
      <td><?php echo $row['NgayCapNhat'] ; ?></td>
      <?php
      if ( $_SESSION['admin365'] == 2 ) {      
      ?>
      <td><a href="updatemail.php?mail=<?php echo $type_mail; ?>&username=<?php echo $row['Username']?>&domainmail=<?php echo $row['Mail'] ; ?>&func=update" target="_blank"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a><a href="updatemail.php?mail=<?php echo $type_mail; ?>&username=<?php echo $row['Username'] ; ?>&domainmail=<?php echo $row['Mail'] ; ?>&func=del" target="_blank"><font size="6" color="red"><i class="fa fa-trash-o"> </i> </font></a></td>  
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
      if ( $_SESSION['admin365'] == 2 ) {      
      ?>
<div> <a href="updatemail.php" class="btn btn-primary">Thêm</a></div>
<?php
  }
  ?>   
                </div><!--/.row-->
                </div>  
<!-- Script -->
        <script>
        $(document).ready(function(){
            var empDataTable = $('#empTable').DataTable({                        
                dom: 'Blfrtip',                
                buttons: [
                    {
                        extend: 'copyHtml5',
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                                columns: ':visible',
                                
                           // columns: [0,1] // Column index which needs to export
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
    header("Location: ../admin/login.php");
}