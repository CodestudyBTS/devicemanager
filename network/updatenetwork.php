                                                              <?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))
        {
         $staff_location=$_SESSION['staff_location'];
        if($_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3 || $_SESSION['admin_mmtb'] >= 2)      
        {    
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $network_id = isset($_GET['networkid']) ? $_GET['networkid'] : '' ;
        $dept_network = isset($_GET['deptnetwork']) ? $_GET['deptnetwork'] : '' ;
        $date_tl=date('Y-m-d');
        //Get data category_detail
        $query_network_ud = "SELECT * , network.dept_name as network_dept_name, network.dept_location as network_dept_location from network join network_dept on network.dept_location=network_dept.network_dept join network_provider on network.network_provider=network_provider.network_provider join cn_phongban on network.dept_name=cn_phongban.dept_name WHERE network_id='$network_id'";
        $result_network_ud= mysqli_query($connect, $query_network_ud) ; 
        $row_network_ud = mysqli_fetch_array($result_network_ud);
        if(empty($row_network_ud['network_provider']))
        {
            $network_provider=null;
        }
        else
        {
            $network_provider=$row_network_ud['network_provider'];
        }
        if(empty($row_network_ud['dept_location']))
        {
            $network_location=null;
        }
        else
        {
            $network_location=$row_network_ud['dept_location'];
        }
        if(empty($row_network_ud['duration']))
        {
            $network_duration=null;
        }
        else
        {
            $network_duration=$row_network_ud['duration'];
        }
         if(empty($row_network_ud['network_dept_name']))
        {
            $network_dept_name=null;
        }
        else
        {
            $network_dept_name=$row_network_ud['network_dept_name'];
        }
         //Get data network dept
         if($staff_location == "cty") 
         {
          $query_network_dept = "SELECT * from network_dept where network_dept like '%$dept_network%' ORDER BY network_dept" ;
          $query_network_dept_name = "SELECT * from cn_phongban where dept_location like '%$dept_network%' ORDER BY dept_location" ;
          $query_network_ud_dept_name = "SELECT * from cn_phongban where dept_name <> '$network_dept_name' ORDER BY dept_location";
         }
         else
         {
          $query_network_dept = "SELECT * from network_dept where network_dept = '$staff_location' " ;
          $query_network_dept_name = "SELECT * from cn_phongban where dept_location = '$staff_location'" ;
          $query_network_ud_dept_name = "SELECT * from cn_phongban where dept_location = '$staff_location'  and dept_name <> '$network_dept_name'" ;
         }
        $result_network_dept= mysqli_query($connect, $query_network_dept) ;
        $result_network_dept_name= mysqli_query($connect, $query_network_dept_name) ; 
        $result_network_ud_dept_name= mysqli_query($connect, $query_network_ud_dept_name) ; 
        //get data network provider
        $query_network_add_provider = "SELECT * from network_provider" ;
        $result_network_add_provider= mysqli_query($connect, $query_network_add_provider) ; 
        
        //get thông tin nhà cung cấp
        $query_network_ud_provider = "SELECT * FROM network_provider WHERE network_provider <> '$network_provider'";
        $result_network_ud_provider= mysqli_query($connect, $query_network_ud_provider) ; 
        //get thông tin nhà location
        $query_network_ud_dept = "SELECT * FROM network_dept WHERE network_dept <> '$network_location'";
        $result_network_ud_dept= mysqli_query($connect, $query_network_ud_dept) ; 
        //get thời gian gia hạn
        $query_network_duration = "SELECT * FROM network_duration WHERE network_duration <> '$network_duration'";
        $result_network_duration= mysqli_query($connect, $query_network_duration) ; 
           require 'xulyupdatenetwork.php';               

?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <?php
        if(empty($func) ||  $func == "add-network")
        {
            echo "<title>Thêm network</title>";
        }
        elseif($func == "update-network")
        {
            echo "<title>Cập nhật network</title>";
        }
        elseif($func == "remove-network")
        {
            echo "<title>Xóa network</title>";
        }
        ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            if(empty($func) ||  $func == "add-network")
            {
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm đường truyền mạng </h2>
            </div>
            <form action='updatenetwork.php' method='POST'>
            <div class="panel-body">
                <div class="form-group col-lg-3">
                  <label for="usr">Tên đường truyền (*)</label>
                  <input value="" type="text" name="txtnetworkname" class="form-control" id="usr" placeholder="Điền thông tin đường truyền" oninvalid="this.setCustomValidity('Tên đường truyền không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Gói cước (*)</label>
                  <input value="" type="text" name="txtnetworktype" class="form-control" id="usr" placeholder="Điền thông tin gói cước" oninvalid="this.setCustomValidity('Gói cước không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="usr">Username</label>
                  <input value="" type="text" name="txtnetworkusr" class="form-control" id="usr" placeholder="Điền tên đăng nhập đường truyền">
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Password</label>                  
                  <input value="" type="password" name="txtnetworkpass" class="form-control" id="usr" placeholder="Điền pasword đường truyền">
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Đơn vị cung cấp(*)</label>
                  <select name="txtnetworkprovider" class="js-example-basic-multiple form-control" id="txtnetworkprovidert" oninvalid="this.setCustomValidity('Đơn vị cung cấp không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn đơn vị cung cấp" ; ?></option>
                       <?php 
                     while($row_network_add_provider = mysqli_fetch_assoc($result_network_add_provider))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_network_add_provider['network_provider'] ; ?>"><?php echo $row_network_add_provider['network_provider_detail'] ; ?></option>
                    <?php
                    }
                    ?>                                                
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Đơn vị sử dụng(*)</label>                  
                   <select name="txtnotephongban" class="js-example-basic-multiple form-control" id="txtnotephongban" oninvalid="this.setCustomValidity('Đơn vị sử dụng không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn đơn vị sử dụng" ; ?></option>
                    <?php 
                     while($row_network_dept_name = mysqli_fetch_assoc($result_network_dept_name))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_network_dept_name['dept_name'] ; ?>"><?php echo $row_network_dept_name['Note_phongban'] ; ?></option>
                    <?php
                    }
                    ?>            
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc (*)</label>                  
                  <select name="txtlocation" class="js-example-basic-multiple form-control" id="txtlocation" oninvalid="this.setCustomValidity('Nơi làm việc không để trống')" oninput="setCustomValidity('')" required>
                    <?php
                    if($dept_network == null || $dept_network =="cty")
                    {
                    ?>
                    <option value=""><?php echo "Chọn nơi làm việc" ; ?></option>
                    <?php 
                    }
                     while($row_network_dept = mysqli_fetch_assoc($result_network_dept))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_network_dept['network_dept'] ; ?>"><?php echo $row_network_dept['network_dept_detail'] ; ?></option>
                    <?php
                    }
                    ?>            
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Ngày bắt đầu</label>                  
                  <input value="" type="date" name="txtstartdate" class="form-control" id="address">
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Ngày kết thúc</label>                  
                   <input value="" type="date" name="txtenddate" class="form-control" id="address">
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Thời hạn(*)</label>                  
                  <select name="txtduration" class="js-example-basic-multiple form-control" id="txtduration" oninvalid="this.setCustomValidity('Thời gian đăng ký/gia hạn không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn thời gian đăng ký(gia hạn)" ; ?></option>  
                    <?php                                  
                     while($row_network_duration = mysqli_fetch_assoc($result_network_duration))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_network_duration['network_duration'] ; ?>"><?php echo $row_network_duration['network_duration_detail'] ; ?></option>
                    <?php
                    }
                    ?>             
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Giá tiền(VND)</label>                  
                  <input value="" type="text" name="txtnetworkprice" class="form-control" id="address" placeholder="Điền giá tiền đăng ký hoặc gia hạn">
                </div>
                <div class="form-group col-lg-12">
                  <label for="email">Ghi chú</label>                  
                  <input value="" type="text" name="txtnetworknote" class="form-control" id="address" placeholder="Điền giá tiền đăng ký hoặc gia hạn">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="insert" style="background-color: #30a5ff;">Thêm đường truyền</button>
                </div>
            </div>
        </form>
        </div>
                <?php

            }
                elseif($func == "update-network")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Cập nhật đường truyền mạng</h2>
            </div>
            <form action='updatenetwork.php' method='POST'>
            <div class="panel-body">
                <input value="<?php echo $row_network_ud['network_id'] ; ?>" name="txtnetwork_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-3">
                  <label for="usr">Tên đường truyền(*) </label>
                  <input style="color: red; font-weight: bold;" value="<?php echo $row_network_ud['network_name'] ; ?>" type="text" name="txtnetworkname" class="form-control" id="usr" readonly >
                </div>
                <!-- Get old gói cước đường truyền -->                                 
                  <input value="<?php echo $row_network_ud['network_type'] ;?>" type="hidden" name="txtnetworktype_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Gói cước (*) </label>
                  <input value="<?php echo $row_network_ud['network_type'] ; ?>" type="text" name="txtnetworktype" class="form-control" id="usr" placeholder="Điền thông tin gói cước đường truyền" oninvalid="this.setCustomValidity('Tên gói cước không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <!-- Get old thông tin tên đường truyền -->                                 
                <input value="<?php echo $row_network_ud['network_usr'] ; ?>" type="hidden" name="txtnetworkusr_old" class="form-control" id="address">
                <div class="form-group col-lg-3">
                  <label for="usr">Username</label>
                  <input value="<?php echo $row_network_ud['network_usr'] ; ?>" type="text" name="txtnetworkusr" class="form-control" id="usr" placeholder="Điền thông tin đăng nhập đường truyền">
                </div>
                <!-- Get old thông tin pasword đường truyền -->                                 
                <input value="<?php echo $row_network_ud['network_pass'] ; ?>" type="hidden" name="txtnetworkpass_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Password</label>                  
                  <input value="<?php echo $row_network_ud['network_pass'] ; ?>" type="password" name="txtnetworkpass" class="form-control" id="usr" placeholder="Điền pasword đường truyền">
                </div>
                <!-- Get old nhà cung cấp đường truyền -->                                 
                <input value="<?php echo $row_network_ud['network_provider'] ; ?>" type="hidden" name="txtnetworkprovider_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Đơn vị cung cấp(*)</label>
                   <select name="txtnetworkprovider" class="js-example-basic-multiple form-control" id="txtnetworkprovider" oninvalid="this.setCustomValidity('Đơn vị cung cấp không để trống')" oninput="setCustomValidity('')" required>
                    <option value="<?php echo $row_network_ud['network_provider']; ?>"><?php  echo $row_network_ud['network_provider_detail']; ?></option>
                    <?php
                    while($row_network_ud_provider = mysqli_fetch_assoc($result_network_ud_provider))
                    {   
                    ?>                
                      <option value="<?php echo $row_network_ud_provider['network_provider'] ; ?>"><?php echo $row_network_ud_provider['network_provider_detail'] ; ?>
                      </option>
                      <?php 
                      } 
                      ?>                  
                  </select>
                </div>
                <!-- Get old phòng ban -->                                 
                <input value="<?php echo $row_network_ud['dept_name'] ; ?>" type="hidden" name="txtnotephongban_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Đơn vị sử dụng(*)</label>                  
                   <select name="txtnotephongban" class="js-example-basic-multiple form-control" id="txtnotephongban" oninvalid="this.setCustomValidity('Đơn vị sử dụng không để trống')" oninput="setCustomValidity('')" required>
                    <option value="<?php echo $row_network_ud['dept_name']; ?>"><?php  echo $row_network_ud['Note_phongban']; ?></option>
                    <?php 
                     while($row_network_ud_dept_name = mysqli_fetch_assoc($result_network_ud_dept_name))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_network_ud_dept_name['dept_name'] ; ?>"><?php echo $row_network_ud_dept_name['Note_phongban'] ; ?></option>
                    <?php
                    }
                    ?>                              
                  </select>
                </div>
                <!-- Get old location -->                                 
                <input value="<?php echo $row_network_ud['network_dept_location'] ; ?>" type="hidden" name="txtlocation_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc(*)</label>                  
                  <select name="txtlocation" class="js-example-basic-multiple form-control" id="txtlocation" oninvalid="this.setCustomValidity('Nơi làm việc không để trống')" oninput="setCustomValidity('')" required>
                    <option value="<?php echo $row_network_ud['network_dept_location']; ?>"><?php  echo $row_network_ud['network_dept_detail']; ?></option>
                    <?php 
                    if($staff_location == "cty")
                    {
                     while($row_network_ud_dept = mysqli_fetch_assoc($result_network_ud_dept))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_network_ud_dept['network_dept'] ; ?>"><?php echo $row_network_ud_dept['network_dept_detail'] ; ?></option>
                    <?php
                    }
                  }
                    ?>                              
                  </select>
                </div>
                <!-- Get old start date -->                                 
                <input value="<?php echo $row_network_ud['start_date'] ; ?>" type="hidden" name="txtstartdate_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Ngày bắt đầu</label>                  
                  <input value="<?php echo $row_network_ud['start_date'] ; ?>" type="date" name="txtstartdate" class="form-control" id="address">
                </div>
                <!-- Get old end date -->                                 
                <input value="<?php echo $row_network_ud['end_date'] ; ?>" type="hidden" name="txtenddate_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Ngày kết thúc</label>                  
                  <input value="<?php echo $row_network_ud['end_date'] ; ?>" type="date" name="txtenddate" class="form-control" id="address">
                </div>
                <!-- Get old duration -->                                 
                <input value="<?php echo $row_network_ud['duration'] ; ?>" type="hidden" name="txtduration_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Thời hạn</label>                  
                  <select name="txtduration" class="js-example-basic-multiple form-control" id="txtduration">
                  <option value="<?php echo $row_network_ud['duration'] ; ?>"><?php echo $row_network_ud['duration'] ; ?> </option> 
                    <?php
                    while($row_network_duration = mysqli_fetch_assoc($result_network_duration))
                    {   
                    ?>                
                      <option value="<?php echo $row_network_duration['network_duration'] ; ?>"><?php echo $row_network_duration['network_duration_detail'] ; ?></option>
                      <?php 
                      } 
                      ?>                                              
                  </select>
                </div>
                <!-- Get old end date -->                                 
                <input value="<?php echo $row_network_ud['network_price'] ; ?>" type="hidden" name="txtnetworkprice_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Giá tiền(VND)</label>                  
                  <input value="<?php echo $row_network_ud['network_price'] ; ?>" type="text" name="txtnetworkprice" class="form-control" id="address">
                </div>
                <!-- Get old note -->                                 
                <input value="<?php echo $row_network_ud['network_note'] ; ?>" type="hidden" name="txtnetworknote_old" class="form-control" id="address">
                <div class="form-group col-lg-12">
                  <label for="email">Ghi chú</label>                  
                  <input value="<?php echo $row_network_ud['network_note'] ; ?>" type="text" name="txtnetworknote" class="form-control" id="address">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="update" style="background-color: #30a5ff;">Cập nhật đường truyền</button>
                </div>             
                
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "remove-network") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thanh lý đường truyền mạng</h2>
            </div>
            <form action='updatenetwork.php' method='POST' onSubmit="return confirm('Bạn muốn thanh lý đường truyền này không?')">
            <div class="panel-body">
                <input value="<?php echo $row_network_ud['network_id'] ; ?>" name="txtnetwork_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-3">
                  <label for="usr">Tên đường truyền</label>
                  <input style="color: red; font-weight: bold;" value="<?php echo $row_network_ud['network_name'] ; ?>" type="text" name="txtnetworkname" class="form-control" id="usr" readonly >
                </div>
                <!-- Get old gói cước đường truyền -->                                 
                  <input value="<?php echo $row_network_ud['network_type'] ; ?>" type="hidden" name="txtnetworktype_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Gói cước</label>
                  <input value="<?php echo $row_network_ud['network_type'] ; ?>" type="text" name="txtnetworktype" class="form-control" id="usr" placeholder="Điền thông tin gói cước đường truyền" oninvalid="this.setCustomValidity('Tên gói cước không để trống')" readonly >
                </div>
                <!-- Get old thông tin tên đường truyền -->                                 
                <input value="<?php echo $row_network_ud['network_usr'] ; ?>" type="hidden" name="txtnetworkusr_old" class="form-control" id="address">
                <div class="form-group col-lg-3">
                  <label for="usr">Username</label>
                  <input value="<?php echo $row_network_ud['network_usr'] ; ?>" type="text" name="txtnetworkusr" class="form-control" id="usr" placeholder="Điền thông tin đăng nhập đường truyền" readonly>
                </div>
                <!-- Get old thông tin pasword đường truyền -->                                 
                <input value="<?php echo $row_network_ud['network_pass'] ; ?>" type="hidden" name="txtnetworkpass_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Password</label>                  
                  <input value="<?php echo $row_network_ud['network_pass'] ; ?>" type="password" name="txtnetworkpass" class="form-control" id="usr" placeholder="Điền pasword đường truyền" readonly>
                </div>
                <!-- Get old nhà cung cấp đường truyền -->                                 
                <input value="<?php echo $row_network_ud['network_provider'] ; ?>" type="hidden" name="txtnetworkprovider_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Đơn vị cung cấp</label>
                   <input value="<?php  echo $row_network_ud['network_provider_detail'] ; ?>" type="text" name="txtnetworkprovider" class="form-control" id="usr" placeholder="Điền pasword đường truyền" readonly>
                </div>
                <!-- Get old phòng ban -->                                 
                <input value="<?php echo $row_network_ud['dept_name'] ; ?>" type="hidden" name="txtnotephongban_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Đơn vị sử dụng</label>                  
                   <input value="<?php echo $row_network_ud['Note_phongban'] ; ?>" type="text" name="txtnotephongban" class="form-control" id="address" readonly>
                </div>  
                <!-- Get old location -->                                 
                <input value="<?php echo $row_network_ud['network_dept_location'] ; ?>" type="hidden" name="txtlocation_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc</label>
                  <input value="<?php  echo $row_network_ud['network_dept_detail'] ; ?>" type="text" name="txtlocation" class="form-control" id="usr" placeholder="Điền pasword đường truyền" readonly>
                </div>                
                <!-- Get old start date -->                                 
                <input value="<?php echo $row_network_ud['start_date'] ; ?>" type="hidden" name="txtstartdate_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Ngày bắt đầu</label>                  
                  <input value="<?php echo $row_network_ud['start_date'] ; ?>" type="date" name="txtstartdate" class="form-control" id="address" readonly>
                </div>
                <!-- Get old end date -->                                 
                <input value="<?php echo $row_network_ud['end_date'] ; ?>" type="hidden" name="txtenddate_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Ngày kết thúc</label>                  
                  <input value="<?php echo $row_network_ud['end_date'] ; ?>" type="date" name="txtenddate" class="form-control" id="address" readonly>
                </div>
                <!-- Get old duration -->                                 
                <input value="<?php echo $row_network_ud['duration'] ; ?>" type="hidden" name="txtduration_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Thời hạn</label>                  
                  <input value="<?php echo $row_network_ud['duration'] ; ?>" type="text" name="txtduration" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Giá tiền(VND)</label>                  
                  <input value="<?php echo $row_network_ud['network_price'] ; ?>" type="text" name="txtnetworkprice" class="form-control" id="address" readonly>
                </div>
                 <div class="form-group col-lg-12">
                  <label for="email">Ghi chú</label>                  
                  <input value="<?php echo $row_network_ud['network_note'] ; ?>" type="text" name="txtnetworknote" class="form-control" id="address" readonly>
                </div>
                <div class="col-lg-12">                           
                <button class="btn btn-primary" name="delete" >Thanh lý đường truyền</button>
                </div>
        <?php
    }

    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
      <script>
                $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
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