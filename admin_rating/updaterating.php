<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))      {    
        $ticket_id = isset($_GET['ticket_id']) ? $_GET['ticket_id'] : '' ;        
        $query_total = "SELECT * from rating WHERE ticket_id = '$ticket_id' ";
        $result_total = mysqli_query($connect, $query_total) ;       
        $row = mysqli_fetch_array($result_total); 
        $ticket_dept = str_replace(' ', '', $row['ticket_dept']);
        require 'xulyupdaterating.php'; 
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <title>Edit user</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href='https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
        <style type="text/css">
            .dt-buttons{
                width: 100%;
            }
        </style>         
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

</head>
<body>   
        <div class="container">
          <?php
          if(empty($ticket_id))
          {
            header("Location: thongke.php");
          }              
          else
                {
             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Update Rating</h2>
            </div>
            <form action='updaterating.php' method='POST'>
            <div class="panel-body">
                <div class="form-group">
                  <label for="usr">Ticket ID:</label>
                  <input value="<?php echo $row['ticket_id'] ; ?>" name="txtticketid" type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                  <label for="usr">Ticket Number:</label>
                  <input value="<?php echo $row['number_ticket'] ; ?>" name="txtnumberticket" type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                  <label for="usr">Ticket Subject:</label>
                  <input value="<?php echo $row['ticket_subject'] ; ?>" name="txtticketsubject" type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                  <label for="usr">Ticket Assigned:</label>
                  <input value="<?php echo $row['ticket_assigned'] ; ?>" name="txtticketassigned" type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                  <label for="usr">Email Techical:</label>
                  <input value="<?php echo $row['team_member_email'] ; ?>" name="txtteammemberemail" type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                  <label for="email">Dept</label>                  
                  <select name="txtdept" class="form-control" id="sel1">
                    <option value="<?php echo $ticket_dept ; ?>"><?php echo $row['ticket_dept'] ; ?></option>
                    <?php
                    if ($ticket_dept == 'Support') 
                    {
                      ?>                    
                      <option value="ERP SAP">ERP SAP</option> 
                      <option value="Software NMSG">Software NMSG</option> 
                      <option value="HR ">HR</option>
                      <option value="DONA">DONA</option> 
                      <option value="BAOTIEN">BẢO TIÊN</option>
                      <?php
                    }
                    elseif ($ticket_dept == 'ERPSAP') 
                    {
                      ?>                     
                      <option value="Support">Support</option> 
                      <option value="Software NMSG">Software NMSG</option> 
                      <option value="HR ">HR</option>
                      <option value="DONA">DONA</option> 
                      <option value="BAOTIEN">BẢO TIÊN</option>
                      <?php
                    }
                    elseif ($ticket_dept == 'SoftwareNMSG') 
                    {
                      ?>                     
                      <option value="Support">Support</option> 
                      <option value="ERP SAP">ERP SAP</option> 
                      <option value="HR ">HR</option>
                      <option value="DONA">DONA</option> 
                      <option value="BAOTIEN">BẢO TIÊN</option>
                      <?php
                    }
                    elseif ($ticket_dept == 'HR') 
                    {
                      ?>                     
                      <option value="Support">Support</option> 
                      <option value="ERP SAP">ERP SAP</option> 
                      <option value="Software NMSG">Software NMSG</option>
                      <option value="DONA">DONA</option> 
                      <option value="BAOTIEN">BẢO TIÊN</option>
                      <?php
                    }
                    elseif ($ticket_dept == 'DONA') 
                    {
                      ?>                     
                      <option value="Support">Support</option> 
                      <option value="ERP SAP">ERP SAP</option> 
                      <option value="Software NMSG">Software NMSG</option>
                      <option value="HR ">HR</option>
                      <option value="BAOTIEN">BẢO TIÊN</option>
                      <?php
                    }
                    elseif ($ticket_dept == 'BAOTIEN') 
                    {
                      ?>                     
                      <option value="Support">Support</option> 
                      <option value="ERP SAP">ERP SAP</option> 
                      <option value="Software NMSG">Software NMSG</option>
                      <option value="HR ">HR</option>
                      <option value="DONA">DONA</option>
                      <?php
                    }

                      ?>                   
                  </select>
                </div>


                 <!-- Get old main -->                                 
                  <input value="<?php echo $row['ticket_rate']?>" type="hidden" name="txtrating_old" class="form-control" id="address">
                <div class="form-group">
                  <label for="email">Rating Number</label>                  
                  <select name="txtrating" class="form-control" id="sel1">
                    <option value="<?php echo $row['ticket_rate'] ; ?>"><?php echo $row['ticket_rate']." sao" ; ?></option>
                    <?php
                    if ($row['ticket_rate'] == 1) 
                    {
                      ?>                     
                                                          
                      <!-- <option value="1">1 sao</option> -->
                      <option value="2">2 sao</option> 
                      <option value="3">3 sao</option> 
                      <option value="4">4 sao</option>
                      <option value="5">5 sao</option> 
                      <?php
                    }
                    elseif ($row['ticket_rate'] == 2) 
                    {
                      ?>                     
                                                          
                      <option value="1">1 sao</option>
                      <!-- <option value="2">2 sao</option>  -->
                      <option value="3">3 sao</option> 
                      <option value="4">4 sao</option>
                      <option value="5">5 sao</option> 
                      <?php
                    }
                    elseif ($row['ticket_rate'] == 3) 
                    {
                      ?>                     
                                                          
                      <option value="1">1 sao</option>
                      <option value="2">2 sao</option> 
                      <!-- <option value="3">3 sao</option> --> 
                      <option value="4">4 sao</option>
                      <option value="5">5 sao</option> 
                      <?php
                    }
                    elseif ($row['ticket_rate'] == 4) 
                    {
                      ?>                     
                                                          
                      <option value="1">1 sao</option>
                      <option value="2">2 sao</option> 
                      <option value="3">3 sao</option> 
                      <!-- <option value="4">4 sao</option> -->
                      <option value="5">5 sao</option> 
                      <?php
                    }
                    elseif ($row['ticket_rate'] == 5) 
                    {
                      ?>                     
                                                          
                      <option value="1">1 sao</option>
                      <option value="2">2 sao</option> 
                      <option value="3">3 sao</option> 
                      <option value="4">4 sao</option>
                      <!-- <option value="5">5 sao</option>  -->
                      <?php
                    }

                      ?>                   
                  </select>
                </div>
                <button class="btn btn-primary" name="updaterating">Update</button>
            </div>   
        </form>
        </div>
        <?php
      }
      ?>
    </div>        
          
</body>

</html>

<?php
}
else
{
    header("Location: ../admin/login.php");
}
?>