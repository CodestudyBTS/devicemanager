<?php   
        session_start();
        include('../admin/connect.php');
        $usr = $_SESSION['email'];
        if (isset($_SESSION['username']))        {    
        
        //$dept = isset($_GET['dept']) ? $_GET['dept'] : '' ;
       // $ticket_rate = isset($_GET['ticket_rate']) ? $_GET['ticket_rate'] : '' ; 
       // if(empty($dept) && empty($ticket_rate) )
        //{
             $query_total = "SELECT * from rating WHERE team_member_email like '%$usr%' " ;   
       // }
       // elseif(empty($ticket_rate))
       // {
       //     $query_total = "SELECT * from rating WHERE ticket_dept like '%$dept%' " ;    
       // }
       // else
       // {
       //         if($ticket_rate == 'good')
        //        {
        //                $query_total = "SELECT * from rating WHERE ticket_dept like '%$dept%' AND (ticket_rate='5' OR ticket_rate='4') " ;
       //         }
       //         elseif($ticket_rate == 'nomal')
       //         {
       //                 $query_total = "SELECT * from rating WHERE ticket_dept like '%$dept%' AND ticket_rate='3' " ;
       //         }
       //         elseif($ticket_rate == 'bad')
       //         {
        //             $query_total = "SELECT * from rating WHERE ticket_dept like '%$dept%' AND (ticket_rate='1' OR ticket_rate='2') " ;     
        //        }
              
      //  }
        
        $result_total = mysqli_query($connect, $query_total) ;
        $data = array();
        //$rowcount_total = mysqli_num_rows( $result_total );
        //$row = mysqli_fetch_array($result_total);
?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Rating ticket</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <!-- Datatable CSS 
        <link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
        -->
        <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href='https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
        <style type="text/css">
            .dt-buttons{
                width: 100%;
            }
        </style>

        <!-- jQuery Library 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        -->
        <!-- Datatable JS 
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> 
        -->    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

</head>
<body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                        <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span></button>
                                <a class="navbar-brand" href="#"><span>Rating Ticket </span>Admin</a>                                
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
                        <li class="active"><a><em class="fa fa-dashboard">&nbsp;</em> Dashboard </a></li>           
                </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
                <div class="row">
                        <ol class="breadcrumb">
                                <li><a href="#">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Charts</li>
                        </ol>
                        <table id='empTable' class="display nowrap">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Ticket_ID</th>
      <th scope="col">Ticket_number</th>
      <th scope="col">Ticket_Subject</th>
      <th scope="col">Ticket create date</th>
      <th scope="col">Email user </th>
      <th scope="col">Ticket Assigned</th>
      <th scope="col">Email Techical</th>
      <th scope="col">Dept</th>
     <th scope="col">Rating</th>
    </tr>
  </thead>
  
  <tbody>
        <?php
        $dem=1;
        while($row = mysqli_fetch_assoc($result_total))
        {

  ?>
    <tr>
      <td><?php echo $dem ; ?></td>
      <td><a href="https://hotro.bitisgroup.vn/scp/tickets.php?id=<?php echo $row['ticket_id'] ; ?>" target="_blank"><?php echo $row['ticket_id'] ; ?> </a></td>
      <td><?php echo $row['number_ticket'] ; ?></td>
      <td><?php echo $row['ticket_subject'] ; ?></td>
      <td>T<?php echo $row['ticket_create_date'] ; ?></td>
      <td><?php echo $row['customer_email'] ; ?></td>
      <td><?php echo $row['ticket_assigned'] ; ?></td>
      <td><?php echo $row['team_member_email'] ; ?></td>
      <td><?php echo $row['ticket_dept'] ; ?></td>
      <td><?php echo $row['ticket_rate'] ; ?></td> 
    </tr> 
    <?php
  $dem++;
}
?>
  </tbody>
  
</table>
                </div><!--/.row-->
                </div>  
<!-- Script -->
        <script>
        $(document).ready(function(){
            var empDataTable = $('#empTable').DataTable({
                dom: 'Blfrtip',                
                buttons: [
                    {
                        extend: 'copy',
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
                ]  
            
            });

        });
        </script>  
        <!--
            ==================================================
            Footer Section Start
            ================================================== -->
            <footer id="footer">
                <div class="container">                    
                    <div class="col-sm-0 col-sm-offset-0 col-lg-12">
                        <p class="copyright">Copyright: <span>System Biti's</span> . Design and Developed by Tiến Phạm</a></p>
                    </div>                                 
                </div>
            </footer> <!-- /#footer -->     
          
</body>

</html>

<?php
}
else
{
    header("Location: ../admin/login.php");
}