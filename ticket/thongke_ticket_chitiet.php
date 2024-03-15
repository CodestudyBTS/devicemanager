<?php   
        session_start();
        include('../admin/ketnoi.php');
        $dept = isset($_GET['dept']) ? $_GET['dept'] : '' ;
        $rate = isset($_GET['rate']) ? $_GET['rate'] : '' ;
        $toyear = date("Y");
        if (isset($_SESSION['username']))       {           
//              $query_total = "SELECT osticket_db.ost_ticket.ticket_id , osticket_db.ost_ticket.number ,  osticket_db.ost_ticket_status.state , osticket_db.ost_ticket__cdata.subject , osticket_db.ost_user_email.address , osticket_db.ost_staff.firstname , osticket_db.ost_staff.lastname , osticket_db.ost_staff.email, osticket_db.ost_ticket.created      FROM osticket_db.ost_ticket 
// join osticket_db.ost_ticket__cdata on osticket_db.ost_ticket.ticket_id=osticket_db.ost_ticket__cdata.ticket_id 
// join osticket_db.ost_ticket_status on osticket_db.ost_ticket.status_id=osticket_db.ost_ticket_status.id
// join  osticket_db.ost_user_email on osticket_db.ost_ticket.user_id=osticket_db.ost_user_email.user_id
// join  osticket_db.ost_staff on osticket_db.ost_ticket.staff_id=osticket_db.ost_staff.staff_id ;" ;           
//         $result_total = mysqli_query($connect_osticket, $query_total) ;
        // $data = array();
?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Analysis Ticket Detail</title>
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
                                <a class="navbar-brand" href="thongke_ticket.php"><span>Analysis Ticket Detail </span>Admin</a>                                
                        </div>
                </div><!-- /.container-fluid -->
        </nav>
        <div class="col-lg-12">
                <div class="row">
                        <ol class="breadcrumb">
                                <li><a href="#">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active">Charts</li>
                        </ol>
                        <table id='empTable' class="display">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Ticket_ID</th>
      <th scope="col">Ticket_number</th>
      <th scope="col">Ticket_Status</th>
      <th scope="col">Ticket_Subject</th>
       <th scope="col">Ticket create date</th> 
      <th scope="col">Email user </th>
      <th scope="col">Ticket Assigned</th>
       <!-- <th scope="col">Ticket Assigned</th> -->
      <th scope="col">Email Techical</th>
       <th scope="col">Dept</th>
     <!-- <th scope="col">Rating</th>  -->
    </tr>
  </thead>
  
  
  
</table>
                </div><!--/.row-->
                </div> 
<!-- Script -->
        <script>
            var dept = "<?php echo $dept; ?>";
            var rate = "<?php echo $rate; ?>";
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
            [25, 50, 100, -1],
            [25, 50, 100, 'All'],
        ],
    processing: true,
    serverSide: true,
    ajax: {

      url: 'get_value_data_json.php?func_listdata=' + "get_total_ticket" + '&dept=' + dept + '&rate=' + rate ,
      // url: 'get_value_data_json.php?func_listdata=' + "get_total_ticket" + '&tech_mail=' + mail ,
      type: "POST",

    },
    columns: [        
    {
        data: null,
        render: function (data, type, full, meta) {
                        return meta.row + 1;
                    }
    },
      { data: null,
        render: function(data, type, row) {
          var link = '<a href="https://hotro.bitisgroup.vn/scp/tickets.php?id=' + data.ticket_id + '"> ' + data.ticket_id + '</a>';
        return link;
        }
    },
      { data: "number_id" },
      { data: "status_ticket" },
      { data: "subject_ticket" },
      { data: "ticket_create" },
      { data: "user_email" },
      {  data: null,
        render: function(data, type, row) {
          return data.lastname_staff + ' , ' + data.firstname_staff ;
        }
       },
      { data: "email_staff" },
      { data: "dept_staff" },
    ],  
      
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