<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))      {    
        
        $username = isset($_GET['username']) ? $_GET['username'] : '' ;   
        $type_mail = isset($_GET['mail']) ? $_GET['mail'] : '' ;
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $domainmail = isset($_GET['domainmail']) ? $_GET['domainmail'] : '' ;
        if ($type_mail == 'office365') 
        {
            $query_total = "SELECT * from mail_office365 WHERE Username  like '%$username%' AND Mail like '%$domainmail%'"  ;
             $result_total = mysqli_query($connect, $query_total) ;       
            $row = mysqli_fetch_array($result_total);   
     
        }
        elseif ($type_mail == 'bitisgroup') {
           $query_total = "SELECT * from mail_bitisgroup WHERE Username  like '%$username%'" ;      
            $result_total = mysqli_query($connect, $query_total) ;       
            $row = mysqli_fetch_array($result_total);            
           }   
           require 'xulyupdatemail.php';               

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
        <div class="container">
            <?php
            if(empty($username) && empty($type_mail))
            {
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Add Information Email Account </h2>
            </div>
            <form action='updatemail.php' method='POST'>
            <div class="panel-body ">
                <div class="form-group col-lg-3">
                  <label for="usr">Username:</label>
                  <input value="" type="text" name="txtUsername" class="form-control" id="usr" placeholder="Enter Username" oninvalid="this.setCustomValidity('Username đang trống')"required >
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Domain Email</label>                  
                  <select name="txtmail" class="form-control" id="sel1">
                    <option value=""><?php echo "Select domain_mail type..." ; ?></option>                    
                      <option value="bitis.com.vn" >bitis.com.vn</option>
                      <option value="bitisgroup.vn">bitisgroup.vn</option> 
                      <option value="hoaanhphat.vn">hoaanhphat.vn</option>                     
                  </select>
                </div>
                <div class="form-group col-lg-6">
                  <label for="birthday">Display Full Email_name</label>
                  <input value="" type="text" name="txttenhienthi" class="form-control" id="birthday" placeholder="Enter Display Full Email_name" oninvalid="this.setCustomValidity('Display Full Email_name')" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="pwd">User_mail Type</label>                  
                  <select name="txttype" class="form-control" id="sel1">
                    <option value=""><?php echo "Select user_mail type..." ; ?></option>                    
                      <option value="Meeting">Meeting</option>
                      <option value="Mail_user" >Mail_user</option>                      
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="confirmation_pwd">License</label>                  
                  <select name="txtlicense" class="form-control" id="sel1">
                    <option value=""><?php echo "Select License mail..." ; ?></option>                    
                      <option value="">No License</option>
                      <option value="Office 365 E1">Office 365 E1</option>
                      <option value="Business Basic" >Business Basic</option>                     
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Location</label>                  
                  <select name="txtdonvi" class="form-control" id="sel1">
                    <option value=""><?php echo "Select Location..." ; ?></option>
                    <option value="tongcty">Tổng Công Ty</option>
                    <option value="tienphong">CN Tiên Phong</option>
                    <option value="dona">CN DONA</option>
                    <option value="cacchinhanh" >Các Chi Nhánh</option>
                    <option value="hoaanhphat" >Hòa Anh Phát</option>                  
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Detail Name Branch</label>
                  <input value="" type="text" name="txtcncuthe" class="form-control" id="address" placeholder="Enter Detail Name Branch ">
                </div>
                <div class="form-group col-lg-9">
                  <label for="address">Note (Option) </label>
                  <input value="" type="text" name="txtnote" class="form-control" id="address" placeholder="Enter Note">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Update Date</label>
                  <input value="" type="date" name="txtdate" class="form-control" id="address">
                </div>
                <div class="col-lg-3">
                <button class="btn btn-primary" name="insert">Insert</button>
              </div>
            </div>
        </form>
        </div>
                <?php

            }
            else{
                if($func == "update")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Update Information Email Account</h2>
            </div>
            <form action='updatemail.php' method='POST'>
            <div class="panel-body">
                <div class="form-group col-lg-3">
                  <label for="usr">Username:</label>
                  <input value="<?php echo $row['Username'] ; ?>" name="txtUsername" type="text" class="form-control" id="usr">
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Domain Email</label>
                  <!--<input value="<?php echo $row['Mail'] ; ?>" name="txtmail" type="text" class="form-control" id="email"> -->
                  <select name="txtmail" class="form-control" id="sel1">
                    <option value="<?php echo $row['Mail'] ; ?>"><?php echo $row['Mail'] ; ?></option>
                    <?php if ($row['Mail'] == "bitis.com.vn") {
                      ?>
                      <option value="bitis.com">bitis.com</option>
                      <option value="bitisgroup.vn">bitisgroup.vn</option>
                      <option value="hoaanhphat.vn">hoaanhphat.vn</option>
                      <?php
                    }
                    elseif ($row['Mail'] == "bitisgroup.vn")
                    {
                      ?>
                      <option value="bitis.com">bitis.com</option>
                      <option value="bitis.com.vn" >bitis.com.vn</option>
                      <option value="hoaanhphat.vn">hoaanhphat.vn</option>
                    <?php
                    }
                    elseif ($row['Mail'] == "hoaanhphat.vn")
                    {
                      ?>
                      <option value="bitis.com">bitis.com</option>
                      <option value="bitis.com.vn" >bitis.com.vn</option>
                      <option value="bitisgroup.vn">bitisgroup.vn</option>
                    <?php
                    }
                    elseif ($row['Mail'] == "bitis.com")
                    {
                      ?>                      
                      <option value="bitis.com.vn" >bitis.com.vn</option>
                      <option value="hoaanhphat.vn">hoaanhphat.vn</option>
                      <option value="bitisgroup.vn">bitisgroup.vn</option>
                    <?php
                    }
                    else
                    {
                      ?>
                      <option value="bitis.com">bitis.com</option>
                      <option value="bitis.com.vn" >bitis.com.vn</option>
                      <option value="bitisgroup.vn">bitisgroup.vn</option>
                      <option value="hoaanhphat.vn">hoaanhphat.vn</option>
                      <?php
                    }
                    ?>                    
                          
                  </select>
                </div>
                <div class="form-group col-lg-6">
                  <label for="birthday">Display Full Email_name</label>
                  <input value="<?php echo $row['TenHienThi'] ; ?>" name="txttenhienthi" type="text" class="form-control" id="birthday">
                </div>
                <div class="form-group col-lg-3">
                  <label for="pwd">User_mail Type</label>
                  <!-- <input value="<?php echo $row['Type'] ; ?>" name="txttype" type="text" class="form-control" id="pwd"> -->
                  <select name="txttype" class="form-control" id="sel1">
                    <option value="<?php echo $row['Type'] ; ?>"><?php echo $row['Type'] ; ?></option>
                    <?php if($row['Type'] == "Mail_user" )
                    {
                      ?>
                      <option value="Meeting">Meeting</option>
                      <?php
                    }
                    else
                    {
                      ?>
                      <option value="Mail_user" >Mail_user</option>
                    <?php
                    }
                    ?>                    
                          
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="confirmation_pwd">License</label>
                  <!-- <input value="<?php echo $row['License'] ; ?>" name="txtlicense" type="text" class="form-control" id="confirmation_pwd"> -->
                  <select name="txtlicense" class="form-control" id="sel1">
                    <option value="<?php echo $row['License'] ; ?>"><?php echo $row['License'] ; ?></option>
                    <?php 
                    if($row['License'] == "" )
                    {
                      ?>
                      <option value="">No License</option>
                      <option value="Office 365 E1">Office 365 E1</option>
                      <option value="Business Basic" >Business Basic</option>
                      <?php
                    }
                    elseif($row['License'] == "Business Basic" )
                    {
                      ?>                      
                      <option value="Office 365 E1">Office 365 E1</option>
                      <option value="">No License</option>
                      <?php
                    }
                    elseif(($row['License'] == "Office 365 E1" ))
                    {
                      ?>                      
                      <option value="Business Basic" >Business Basic</option>
                      <option value="">No License</option>
                    <?php
                    }
                    ?>                    
                          
                  </select>

                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Location</label>
                  <!-- <input value="<?php echo $row['DonVi'] ; ?>" name="txtdonvi" type="text" class="form-control" id="address"> -->
                  <select name="txtdonvi" class="form-control" id="sel1">
                    <option value="<?php echo $row['DonVi'] ; ?>">
                      <?php 
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
                    ?>                      
                    </option>
                    <?php 
                    if($row['DonVi'] == "tongcty" )
                    {
                      ?>
                      <option value="tienphong">CN Tiên Phong</option>
                      <option value="dona">CN DONA</option>
                      <option value="cacchinhanh" >Các Chi Nhánh</option>
                      <option value="hoaanhphat" >Hòa Anh Phát</option>
                      <?php
                    }
                    elseif($row['DonVi'] == "tienphong" )
                    {
                      ?>                      
                      <option value="tongcty">Tổng Công Ty</option>
                      <option value="dona">CN DONA</option>
                      <option value="cacchinhanh" >Các Chi Nhánh</option>
                      <option value="hoaanhphat" >Hòa Anh Phát</option>
                      <?php
                    }
                    elseif($row['DonVi'] == "dona" )
                    {
                      ?>                      
                      <option value="tongcty">Tổng Công Ty</option>
                      <option value="tienphong">CN Tiên Phong</option>
                      <option value="cacchinhanh" >Các Chi Nhánh</option>
                      <option value="hoaanhphat" >Hòa Anh Phát</option>
                      <?php
                    }
                    elseif($row['DonVi'] == "cacchinhanh" )
                    {
                      ?>                      
                      <option value="tongcty">Tổng Công Ty</option>
                      <option value="dona">CN DONA</option>
                      <option value="tienphong" >CN Tiên Phong</option>
                      <option value="hoaanhphat" >Hòa Anh Phát</option>
                      <?php
                    }
                    elseif($row['DonVi'] == "hoaanhphat" )
                    {
                      ?>                      
                      <option value="tongcty">Tổng Công Ty</option>
                      <option value="dona">CN DONA</option>
                      <option value="tienphong" >CN Tiên Phong</option>
                      <option value="cacchinhanh">Các Chi Nhánh</option>
                      <?php
                    }
                    ?>                 
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Detail Name Branch</label>
                  <input value="<?php echo $row['CNcuthe'] ; ?>" name="txtcncuthe" type="text" class="form-control" id="address">
                </div>
                <div class="form-group col-lg-9">
                  <label for="address">Note</label>
                  <input value="<?php echo $row['Note'] ; ?>" name="txtnote" type="text" class="form-control" id="address">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Update Date</label>
                  <input value="<?php echo $row['NgayCapNhat'] ; ?>" name="txtdate" type="date" class="form-control" id="address">
                </div>
                <div class="col-lg-3">
                <button class="btn btn-primary" name="update">Update</button>             
                </div>
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "del") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Delete Information Email Account</h2>
            </div>
            <form action='updatemail.php' method='POST' onSubmit="return confirm('Are you sure to delete?')">
            <div class="panel-body">
                <div class="form-group col-lg-3">
                  <label for="usr">Username:</label>
                  <input style="color: red; font-weight: bold;"  value="<?php echo $row['Username'] ; ?>" name="txtUsername" type="text" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Email:</label>
                  <input value="<?php echo $row['Mail'] ; ?>" name="txtmail" type="text" class="form-control" id="email" readonly>
                </div>
                <div class="form-group col-lg-6">
                  <label for="birthday">TenHienThi</label>
                  <input value="<?php echo $row['TenHienThi'] ; ?>" name="txttenhienthi" type="text" class="form-control" id="birthday" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="pwd">Type</label>
                  <input value="<?php echo $row['Type'] ; ?>" name="txttype" type="text" class="form-control" id="pwd" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="confirmation_pwd">License</label>
                  <input value="<?php echo $row['License'] ; ?>" name="txtlicense" type="text" class="form-control" id="confirmation_pwd" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">DonVi</label>
                  <input value="<?php echo $row['DonVi'] ; ?>" name="txtdonvi" type="text" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">CNcuthe</label>
                  <input value="<?php echo $row['CNcuthe'] ; ?>" name="txtcncuthe" type="text" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-9">
                  <label for="address">Note</label>
                  <input value="<?php echo $row['Note'] ; ?>" name="txtnote" type="text" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">NgayCapNhat</label>
                  <input value="<?php echo $row['NgayCapNhat'] ; ?>" name="txtdate" type="date" class="form-control" id="address" readonly>
                </div>                             
                <div class="col-lg-3">
                <button class="btn btn-primary" name="delete" >Delete</button>
              </div>
        <?php
    }
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