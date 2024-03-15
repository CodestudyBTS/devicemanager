<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))
        {
        if($_SESSION['admin_member'] >= 2 || $_SESSION['admin'] >= 3)      
        {    
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $member_id = isset($_GET['memberid']) ? $_GET['memberid'] : '' ;
        $date_tl=date('Y-m-d');
        // Get data category 
        // $query_location = "SELECT * from phongban " ;
        // $result_dept= mysqli_query($connect, $query_dept) ; 
        // $row_dept = mysqli_fetch_array($result_dept);

        //Get data category_detail
        $query_member_ud = "SELECT * from member WHERE id='$member_id'";
        $result_member_ud= mysqli_query($connect, $query_member_ud) ; 
        $row_member_ud = mysqli_fetch_array($result_member_ud);
           require 'xulyaddmember.php';               

?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <?php
        if(empty($func) ||  $func == "add-member")
        {
            echo "<title>Thêm member</title>";
        }
        elseif($func == "update-member")
        {
            echo "<title>Cập nhật member</title>";
        }
        elseif($func == "remove-member")
        {
            echo "<title>Xóa member</title>";
        }
        ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        
        
        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href='https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>
        <link href="css/main.css" rel="stylesheet">
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
            if(empty($func) ||  $func == "add-member")
            {
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm Thành Viên </h2>
            </div>
            <form action='addmember.php' method='POST'>
            <div class="panel-body">
                <div class="form-group col-lg-2">
                  <label for="usr">Username (*) </label>
                  <input value="" type="text" name="txtusr" class="form-control" id="usr" placeholder="Điền username" oninvalid="this.setCustomValidity('Username không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Password (*) </label>
                  <input value="" type="password" name="txtpass" class="form-control" id="usr" placeholder="Điền username" oninvalid="this.setCustomValidity('Password không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên hiển thị (*) </label>
                  <input value="" type="text" name="txtdisplayname" class="form-control" id="usr" placeholder="Điền tên hiển thị" oninvalid="this.setCustomValidity('Tên hiển thị không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <div class="form-group col-lg-1">
                  <label for="email">Giới tính (*)</label>                  
                  <select name="txtsex" class="form-control" id="txtsex">
                    <option value=""><?php echo "Chọn giới tính" ; ?></option>                                   
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="usr">Email (*) </label>
                  <input value="" type="text" name="txtemail" class="form-control" id="usr" placeholder="Điền email">
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc (*)</label>                  
                  <select name="txtlocation" class="form-control" id="txtlocation">
                    <option value=""><?php echo "Chọn nơi làm việc" ; ?></option>                                   
                      <option value="cty">Tổng công ty</option>
                      <option value="CNMN">Chi Nhánh Miền Nam</option>
                      <option value="CNMB">Chi Nhánh Miền Bắc</option>
                      <option value="CNMT">Chi Nhánh Miền Tây</option>
                      <option value="CNTN">Chi Nhánh Miền Trung - Tây Nguyên</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Global Admin</label>                  
                  <select name="txtadmin" class="form-control" id="txtadmin">
                    <option value=""><?php echo "Chọn mục phân quyền" ; ?></option>                                   
                    <option value="3">Super Admin</option>
                    <option value="2">System Admin</option>
                    <option value="1">Helpdesk</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Admin 365</label>                  
                  <select name="txtadmin_365" class="form-control" id="txtadmin_365">
                    <option value=""><?php echo "Chọn mục phân quyền office 365" ; ?></option>                                   
                    <option value="2">Admin 365</option>
                    <option value="1">View </option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Admin Rating</label>                  
                  <select name="txtadmin_rating" class="form-control" id="txtadmin_rating">
                    <option value=""><?php echo "Chọn mục phân quyền rating" ; ?></option>                                   
                    <option value="2">Admin Rating</option>
                    <option value="1">View </option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Admin Ticket</label>                  
                  <select name="txtadmin_ticket" class="form-control" id="txtadmin_ticket">
                    <option value=""><?php echo "Chọn mục phân quyền ticket" ; ?></option>                                   
                    <option value="2">Admin Ticket</option>
                    <option value="1">View </option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Admin MMTB Cty</label>                  
                  <select name="txtadmin_mmtb" class="form-control" id="txtadmin_mmtb">
                    <option value=""><?php echo "Chọn mục phân quyền mmtb cty" ; ?></option>                                   
                    <option value="2">Admin MMTB</option>
                    <option value="1">View MMTB</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Admin MMTB CN</label>                  
                  <select name="txtadmin_mmtb_cn" class="form-control" id="txtadmin_mmtb_cn">
                    <option value=""><?php echo "Chọn mục phân quyền mmtb cn" ; ?></option>                                   
                    <option value="2">Admin MMTB</option>
                    <option value="1">View MMTB</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="insert" style="background-color: #30a5ff;">Thêm thành viên</button>
                </div>
            </div>
        </form>
        </div>
                <?php

            }
                elseif($func == "update-member")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Cập nhật thành viên</h2>
            </div>
            <form action='addmember.php' method='POST'>
            <div class="panel-body">
                <input value="<?php echo $row_member_ud['id'] ; ?>" name="txtmember_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-2">
                  <label for="usr">Username (*) </label>
                  <input style="color: red; font-weight: bold;" value="<?php echo $row_member_ud['username'] ; ?>" type="text" name="txtusr" class="form-control" id="usr" readonly >
                </div>
                <!-- Get old pass -->                                 
                  <input value="<?php echo $row_member_ud['password'] ?>" type="hidden" name="txtpass_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Password (*) </label>
                  <input value="<?php echo $row_member_ud['password'] ; ?>" type="password" name="txtpass" class="form-control" id="usr" placeholder="Điền pasword" oninvalid="this.setCustomValidity('Username không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <!-- Get old tên hiển thị -->                                 
                <input value="<?php echo $row_member_ud['fullname'] ?>" type="hidden" name="txtdisplayname_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Tên hiển thị (*) </label>
                  <input value="<?php echo $row_member_ud['fullname'] ; ?>" type="text" name="txtdisplayname" class="form-control" id="usr" placeholder="Điền tên hiển thị" >
                </div>
                <!-- Get old giới tính -->                                 
                <input value="<?php echo $row_member_ud['sex'] ?>" type="hidden" name="txtsex_old" class="form-control" id="address">
                <div class="form-group col-lg-1">
                  <label for="email">Giới tính (*)</label>                  
                  <select name="txtsex" class="form-control" id="txtsex">
                    <option value="<?php echo $row_member_ud['sex'] ; ?>"><?php echo $row_member_ud['sex'] ; ?></option>                            
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>                 
                  </select>
                </div>
                <!-- Get old email -->                                 
                <input value="<?php echo $row_member_ud['email'] ?>" type="hidden" name="txtemail_old" class="form-control" id="address">
                <div class="form-group col-lg-3">
                  <label for="usr">Email (*) </label>
                  <input value="<?php echo $row_member_ud['email'] ; ?>" type="text" name="txtemail" class="form-control" id="usr" placeholder="Điền email" >
                </div>
                <!-- Get old location -->                                 
                <input value="<?php echo $row_member_ud['location'] ?>" type="hidden" name="txtlocation_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc (*)</label>                  
                  <select name="txtlocation" class="form-control" id="txtlocation">
                    <option value="<?php echo $row_member_ud['location'] ; ?>"><?php 
                    if( $row_member_ud['location'] == "cty")
                    {
                      echo "Tổng công ty" ;

                    }
                    elseif( $row_member_ud['location'] == "CNMB" || $row_member_ud['location'] == "cnmb")
                    {
                      echo "Chi Nhánh Miền Bắc" ;
                    }
                    elseif( $row_member_ud['location'] == "CNMN" || $row_member_ud['location'] == "cnmn")
                    {
                      echo "Chi Nhánh Miền Nam" ;
                    }
                    elseif( $row_member_ud['location'] == "CNMT" || $row_member_ud['location'] == "cnmt")
                    {
                      echo "Chi Nhánh Miền Tây" ;
                    }
                    elseif( $row_member_ud['location'] == "CNTN" || $row_member_ud['location'] == "cntn")
                    {
                      echo "Chi Nhánh Miền Trung - Tây Nguyên" ;
                    }
                  ?></option>                         
                  <option value="cty">Tổng công ty</option>
                    <option value="CNMN">Chi Nhánh Miền Nam</option>
                    <option value="CNMB">Chi Nhánh Miền Bắc</option>
                    <option value="CNMT">Chi Nhánh Miền Tây</option>
                    <option value="CNTN">Chi Nhánh Miền Trung - Tây Nguyên</option>                 
                  </select>
                </div>
                <!-- Get old admin -->                                 
                <input value="<?php echo $row_member_ud['admin'] ?>" type="hidden" name="txtadmin_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Global Admin</label>                  
                  <select name="txtadmin" class="form-control" id="txtadmin">
                    <option value="<?php echo $row_member_ud['admin'] ; ?>"><?php 
                      if( $row_member_ud['admin'] == 0)
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin'] == 1)
                    {
                      echo "Helpdesk" ;
                    }
                    elseif( $row_member_ud['admin'] == 2)
                    {
                      echo "System Admin" ;
                    }
                    elseif( $row_member_ud['admin'] == 3)
                    {
                      echo "Super Admin" ;
                    }
                      ?>
                      </option>                                   
                    <option value="3">Super Admin</option>
                    <option value="2">System Admin</option>
                    <option value="1">Helpdesk</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <!-- Get old admin 365 -->                                 
                <input value="<?php echo $row_member_ud['admin_365'] ?>" type="hidden" name="txtadmin_365_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Admin 365</label>                  
                  <select name="txtadmin_365" class="form-control" id="txtadmin_365">
                    <option value="<?php echo $row_member_ud['admin_365'] ; ?>"><?php 
                      if( $row_member_ud['admin_365'] == 0)
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_365'] == 1)
                    {
                      echo "View" ;
                    }
                    elseif( $row_member_ud['admin_365'] == 2)
                    {
                      echo "Admin 365" ;
                    }
                      ?></option>                                   
                    <option value="2">Admin 365</option>
                    <option value="1">View</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <!-- Get old admin rating -->                                 
                <input value="<?php echo $row_member_ud['admin_rating'] ?>" type="hidden" name="txtadmin_rating_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Admin Rating</label>                  
                  <select name="txtadmin_rating" class="form-control" id="txtadmin_rating">
                    <option value="<?php echo $row_member_ud['admin_rating'] ; ?>"><?php 
                      if( $row_member_ud['admin_rating'] == 0)
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_rating'] == 1)
                    {
                      echo "View" ;
                    }
                    elseif( $row_member_ud['admin_rating'] == 2)
                    {
                      echo "Admin Rating" ;
                    }
                      ?></option>                                   
                    <option value="2">Admin Rating</option>
                    <option value="1">View </option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <!-- Get old admin ticket -->                                 
                <input value="<?php echo $row_member_ud['admin_ticket'] ?>" type="hidden" name="txtadmin_ticket_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Admin Ticket</label>                  
                  <select name="txtadmin_ticket" class="form-control" id="txtadmin_ticket">
                    <option value="<?php echo $row_member_ud['admin_ticket'] ; ?>"><?php 
                      if( $row_member_ud['admin_ticket'] == 0)
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_ticket'] == 1)
                    {
                      echo "View" ;
                    }
                    elseif( $row_member_ud['admin_ticket'] == 2)
                    {
                      echo "Admin Ticket" ;
                    }
                      ?></option>                                   
                    <option value="2">Admin Ticket</option>
                    <option value="1">View </option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <!-- Get old admin mmtb cty -->                                 
                <input value="<?php echo $row_member_ud['admin_mmtb'] ?>" type="hidden" name="txtadmin_mmtb_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Admin MMTB Cty</label>                  
                  <select name="txtadmin_mmtb" class="form-control" id="txtadmin_mmtb">
                    <option value="<?php echo $row_member_ud['admin_mmtb'] ; ?>"><?php 
                      if( $row_member_ud['admin_mmtb'] == 0)
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_mmtb'] == 1)
                    {
                      echo "View MMTB" ;
                    }
                    elseif( $row_member_ud['admin_mmtb'] == 2)
                    {
                      echo "Admin MMTB" ;
                    }
                      ?></option>                                   
                    <option value="2">Admin MMTB</option>
                    <option value="1">View MMTB</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <!-- Get old admin mmtb cn -->                                 
                <input value="<?php echo $row_member_ud['admin_cn_mmtb'] ?>" type="hidden" name="txtadmin_mmtb_cn_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Admin MMTB CN</label>                  
                  <select name="txtadmin_mmtb_cn" class="form-control" id="txtadmin_mmtb_cn">
                    <option value="<?php echo $row_member_ud['admin_cn_mmtb'] ; ?>"><?php 
                      if( $row_member_ud['admin_cn_mmtb'] == 0)
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_cn_mmtb'] == 1)
                    {
                      echo "View MMTB" ;
                    }
                    elseif( $row_member_ud['admin_cn_mmtb'] == 2)
                    {
                      echo "Admin MMTB" ;
                    }
                      ?></option>                                   
                    <option value="2">Admin MMTB</option>
                    <option value="1">View MMTB</option>
                    <option value="0">Không phân quyền</option>                 
                  </select>
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="update" style="background-color: #30a5ff;">Sửa thành viên</button>
                </div>             
                
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "remove-member") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Xóa phòng ban</h2>
            </div>
            <form action='addmember.php' method='POST' onSubmit="return confirm('Bạn muốn xóa không?')">
            <div class="panel-body">
                <input value="<?php echo $row_member_ud['id'] ; ?>" name="txtmember_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-2">
                  <label for="usr">Username (*) </label>
                  <input style="color: red; font-weight: bold;" value="<?php echo $row_member_ud['username'] ; ?>" type="text" name="txtusr" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Password (*) </label>
                  <input value="<?php echo $row_member_ud['password'] ; ?>" type="password" name="txtpass" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên hiển thị (*) </label>
                  <input value="<?php echo $row_member_ud['fullname'] ; ?>" type="text" name="txtdisplayname" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-1">
                  <label for="usr">Giới tính (*) </label>
                  <input value="<?php echo $row_member_ud['sex'] ; ?>" type="text" name="txtsex" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="usr">Email (*) </label>
                  <input value="<?php echo $row_member_ud['email'] ; ?>" type="text" name="txtemail" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Nơi làm việc (*) </label>
                  <input value="<?php 
                    if( $row_member_ud['location'] == "cty")
                    {
                      echo "Tổng công ty" ;

                    }
                    elseif( $row_member_ud['location'] == "CNMB" || $row_member_ud['location'] == "cnmb")
                    {
                      echo "Chi Nhánh Miền Bắc" ;
                    }
                    elseif( $row_member_ud['location'] == "CNMN" || $row_member_ud['location'] == "cnmn")
                    {
                      echo "Chi Nhánh Miền Nam" ;
                    }
                    elseif( $row_member_ud['location'] == "CNMT" || $row_member_ud['location'] == "cnmt")
                    {
                      echo "Chi Nhánh Miền Tây" ;
                    }
                    elseif( $row_member_ud['location'] == "CNTN" || $row_member_ud['location'] == "cntn")
                    {
                      echo "Chi Nhánh Miền Trung - Tây Nguyên" ;
                    }
                  ?>" type="text" name="txtlocation" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Global Admin</label>
                  <input value="<?php 
                      if( $row_member_ud['admin'] == "0")
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin'] == "1")
                    {
                      echo "Helpdesk" ;
                    }
                    elseif( $row_member_ud['admin'] == "2")
                    {
                      echo "System Admin" ;
                    }
                    elseif( $row_member_ud['admin'] == "3")
                    {
                      echo "Super Admin" ;
                    }
                      ?>" type="text" name="txtadmin" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Admin 365</label>
                  <input value="<?php 
                      if( $row_member_ud['admin_365'] == "0")
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_365'] == "1")
                    {
                      echo "View" ;
                    }
                    elseif( $row_member_ud['admin_365'] == "2")
                    {
                      echo "Admin 365" ;
                    }
                      ?>" type="text" name="txtadmin_365" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Admin Rating</label>
                  <input value=" <?php 
                      if( $row_member_ud['admin_rating'] == "0")
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_rating'] == "1")
                    {
                      echo "View" ;
                    }
                    elseif( $row_member_ud['admin_rating'] == "2")
                    {
                      echo "Admin Rating" ;
                    }
                      ?>" type="text" name="txtadmin_rating" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Admin Ticket</label>
                  <input value="<?php 
                      if( $row_member_ud['admin_ticket'] == "0")
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_ticket'] == "1")
                    {
                      echo "View" ;
                    }
                    elseif( $row_member_ud['admin_ticket'] == "2")
                    {
                      echo "Admin Ticket" ;
                    }
                      ?>" type="text" name="txtadmin_ticket" class="form-control" id="usr" readonly>
                </div>
              <div class="form-group col-lg-2">
                  <label for="usr">Admin MMTB Cty</label>
                  <input value="<?php 
                      if( $row_member_ud['admin_mmtb'] == "0")
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_mmtb'] == "1")
                    {
                      echo "View MMTB" ;
                    }
                    elseif( $row_member_ud['admin_mmtb'] == "2")
                    {
                      echo "Admin MMTB" ;
                    }
                      ?>" type="text" name="txtadmin_mmtb" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Admin MMTB CN</label>
                  <input value="<?php 
                      if( $row_member_ud['admin_cn_mmtb'] == "0")
                    {
                      echo "Không phân quyền" ;

                    }
                    elseif( $row_member_ud['admin_cn_mmtb'] == "1")
                    {
                      echo "View MMTB" ;
                    }
                    elseif( $row_member_ud['admin_cn_mmtb'] == "2")
                    {
                      echo "Admin MMTB" ;
                    }
                      ?>" type="text" name="txtadmin_mmtb_cn" class="form-control" id="usr" readonly>
                </div>
                <div class="col-lg-12">                           
                <button class="btn btn-primary" name="delete" >Xóa thành viên</button>
                </div>
        <?php
    }

    ?>
    </div>        
          
</body>

</html>

<?php
}
}
else
{
    header("Location: ../admin/login.php");
}