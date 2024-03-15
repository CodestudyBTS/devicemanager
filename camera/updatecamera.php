<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))
        {
         $staff_location=$_SESSION['staff_location'];
        if($_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3 || $_SESSION['admin_mmtb'] >= 2)      
        {    
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $camera_id = isset($_GET['cameraid']) ? $_GET['cameraid'] : '' ;
        $dept_camera = isset($_GET['deptcamera']) ? $_GET['deptcamera'] : '' ;
        $date_tl=date('Y-m-d');
        //Get data category_detail
        $query_camera_ud = "SELECT * from camera 
                            join network_dept on camera.cam_dept_location=network_dept.network_dept 
                            join camera_provider on camera.ten_thuonghieu=camera_provider.camera_provider 
                            join cn_phongban on camera.cam_dept_name=cn_phongban.dept_name 
                            join camera_disk on camera.camera_disk=camera_disk.camera_disk
                            WHERE camera_id='$camera_id'";
        $result_camera_ud= mysqli_query($connect, $query_camera_ud) ; 
        $row_camera_ud = mysqli_fetch_array($result_camera_ud);
        if(empty($row_camera_ud['ten_thuonghieu']))
        {
            $camera_provider=null;
        }
        else
        {
            $camera_provider=$row_camera_ud['ten_thuonghieu'];
        }
        if(empty($row_camera_ud['cam_dept_location']))
        {
            $camera_location=null;
        }
        else
        {
            $camera_location=$row_camera_ud['cam_dept_location'];
        }
         if(empty($row_camera_ud['cam_dept_name']))
        {
            $camera_dept_name=null;
        }
        else
        {
            $camera_dept_name=$row_camera_ud['cam_dept_name'];
        }
        if(empty($row_camera_ud['camera_disk']))
        {
            $camera_disk=null;
        }
        else
        {
            $camera_disk=$row_camera_ud['camera_disk'];
        }
         //Get data camera dept
         if($staff_location == "cty") 
         {
          $query_camera_dept = "SELECT * from network_dept where network_dept like '%$dept_camera%' ORDER BY network_dept" ;
          $query_camera_dept_name = "SELECT * from cn_phongban where dept_location like '%$dept_camera%' ORDER BY dept_location" ;
          $query_camera_ud_dept_name = "SELECT * from cn_phongban where dept_name <> '$camera_dept_name' ORDER BY dept_location";
         }
         else
         {
          $query_camera_dept = "SELECT * from network_dept where network_dept = '$staff_location' " ;
          $query_camera_dept_name = "SELECT * from cn_phongban where dept_location = '$staff_location'" ;
          $query_camera_ud_dept_name = "SELECT * from cn_phongban where dept_location = '$staff_location'  and dept_name <> '$camera_dept_name'" ;
         }
        $result_camera_dept= mysqli_query($connect, $query_camera_dept) ;
        $result_camera_dept_name= mysqli_query($connect, $query_camera_dept_name) ; 
        $result_camera_ud_dept_name= mysqli_query($connect, $query_camera_ud_dept_name) ; 
        //get data camera provider
        $query_camera_add_provider = "SELECT * from camera_provider" ;
        $result_camera_add_provider= mysqli_query($connect, $query_camera_add_provider) ; 
        
        //get thông tin nhà cung cấp
        $query_camera_ud_provider = "SELECT * FROM camera_provider WHERE camera_provider <> '$camera_provider'";
        $result_camera_ud_provider= mysqli_query($connect, $query_camera_ud_provider) ; 
        //get thông tin nhà location
        $query_camera_ud_dept = "SELECT * FROM network_dept WHERE network_dept <> '$camera_location'";
        $result_camera_ud_dept= mysqli_query($connect, $query_camera_ud_dept) ;
        //get thông tin dung lượng ổ cứng
        $query_camera_disk = "SELECT * FROM camera_disk WHERE camera_disk <> '$camera_disk'";
        $result_camera_disk= mysqli_query($connect, $query_camera_disk) ; 
           require 'xulyupdatecamera.php';               

?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <?php
        if(empty($func) ||  $func == "add-camera")
        {
            echo "<title>Thêm camera</title>";
        }
        elseif($func == "update-camera")
        {
            echo "<title>Cập nhật camera</title>";
        }
        elseif($func == "remove-camera")
        {
            echo "<title>Xóa camera</title>";
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
            if(empty($func) ||  $func == "add-camera")
            {
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm hệ thống camera </h2>
            </div>
            <form action='updatecamera.php' method='POST'>
            <div class="panel-body">
                <div class="form-group col-lg-2">
                  <label for="email">Đơn vị sử dụng (*)</label>                  
                   <select name="txtnotephongban" class="js-example-basic-multiple form-control" id="txtnotephongban" oninvalid="this.setCustomValidity('Đơn vị sử dụng không để trống')" oninput="setCustomValidity('')" required >
                    <option value=""><?php echo "Chọn đơn vị sử dụng" ; ?></option>
                    <?php 
                     while($row_camera_dept_name = mysqli_fetch_assoc($result_camera_dept_name))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_dept_name['dept_name'] ; ?>"><?php echo $row_camera_dept_name['Note_phongban'] ; ?></option>
                    <?php
                    }
                    ?>            
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc (*)</label>                  
                  <select name="txtlocation" class="js-example-basic-multiple form-control" id="txtlocation" oninvalid="this.setCustomValidity('Nơi làm việc không để trống')" oninput="setCustomValidity('')" required >
                    <?php
                    if($dept_camera == null || $dept_camera =="cty")
                    {
                    ?>
                    <option value=""><?php echo "Chọn nơi làm việc" ; ?></option>
                    <?php 
                    }
                     while($row_camera_dept = mysqli_fetch_assoc($result_camera_dept))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_dept['network_dept'] ; ?>"><?php echo $row_camera_dept['network_dept_detail'] ; ?></option>
                    <?php
                    }
                    ?>            
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên đầu ghi (*)</label>
                  <input value="" type="text" name="txtdaughiname" class="form-control" id="usr" placeholder="Điền thông tin đầu ghi" oninvalid="this.setCustomValidity('Tên đầu ghi không để trống')" oninput="setCustomValidity('')"required >
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên camera (*)</label>
                  <input value="" type="text" name="txtcameraname" class="form-control" id="usr" placeholder="Điền thông tin camera" oninvalid="this.setCustomValidity('Tên camera không để trống')" oninput="setCustomValidity('')" required >
                </div>
                 <div class="form-group col-lg-2">
                  <label for="usr">Số lượng camera</label>
                  <select name="txtslcamera" class="js-example-basic-multiple form-control" id="txtslcamera">
                    <option value=""><?php echo "Chọn số lượng camera" ; ?></option>                                 
                      <option value="1">1 cái</option>
                      <option value="2">2 cái</option>
                      <option value="3">3 cái</option>
                      <option value="4">4 cái</option> 
                      <option value="5">5 cái</option> 
                      <option value="6">6 cái</option> 
                      <option value="7">7 cái</option> 
                      <option value="8">8 cái</option>                                                 
                      <option value="9">9 cái</option> 
                      <option value="10">10 cái</option> 
                      <option value="11">11 cái</option> 
                      <option value="12">12 cái</option> 
                  </select>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Thương hiệu (*)</label>
                  <select name="txtcameraprovider" class="js-example-basic-multiple form-control" id="txtcameraprovider" oninvalid="this.setCustomValidity('Thương hiệu không để trống')" oninput="setCustomValidity('')" required >
                    <option value=""><?php echo "Chọn thương hiệu camera" ; ?></option>
                       <?php 
                     while($row_camera_add_provider = mysqli_fetch_assoc($result_camera_add_provider))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_add_provider['camera_provider'] ; ?>"><?php echo $row_camera_add_provider['camera_provider_detail'] ; ?></option>
                    <?php
                    }
                    ?>                                                
                  </select>
              </div>
              <div class="form-group col-lg-2">
                  <label for="usr">Dung lượng lưu trữ (*)</label>
                  <select name="txtcameradisk" class="js-example-basic-multiple form-control" id="txtcameradisk" oninvalid="this.setCustomValidity('Dung lượng không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn dung lượng lưu trữ" ; ?></option>
                       <?php 
                     while($row_camera_disk = mysqli_fetch_assoc($result_camera_disk))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_disk['camera_disk'] ; ?>"><?php echo $row_camera_disk['camera_disk_detail'] ; ?></option>
                    <?php
                    }
                    ?>                                                
                  </select>
              </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Username</label>
                  <input value="" type="text" name="txtcamerausr" class="form-control" id="usr" placeholder="Điền tên đăng nhập camera">
                </div>

                <div class="form-group col-lg-2">
                  <label for="email">Password</label>                  
                  <input value="" type="password" name="txtcamerapass" class="form-control" id="usr" placeholder="Điền pasword camera">
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Domain/IP</label>                  
                  <input value="" type="text" name="txtcameradomain" class="form-control" id="usr" placeholder="Điền thông tin domain/ip">
                </div>
                <div class="form-group col-lg-1">
                  <label for="email">Port media</label>                  
                  <input value="" type="text" name="txtportmedia" class="form-control" id="address" placeholder="Port media">
                </div>
                <div class="form-group col-lg-1">
                  <label for="email">Port web</label>                  
                   <input value="" type="text" name="txtportweb" class="form-control" id="address" placeholder="Port web">
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Ngày cập nhật</label>                  
                  <input value="" type="date" name="txtupdatedate" class="form-control" id="address" placeholder="Nhập ngày cập nhật">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="insert" style="background-color: #30a5ff;">Thêm hệ thống</button>
                </div>
            </div>
        </form>
        </div>
                <?php

            }
                elseif($func == "update-camera")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Cập nhật hệ thống camera</h2>
            </div>
            <form action='updatecamera.php' method='POST'>
            <div class="panel-body">
                <input value="<?php echo $row_camera_ud['camera_id'] ; ?>" name="txtcamera_id" type="hidden" class="form-control" id="usr">
                <!-- Get old đơn vị sử dụng-->                                 
                <input value="<?php echo $row_camera_ud['cam_dept_name'] ;?>" type="hidden" name="txtnotephongban_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Đơn vị sử dụng</label>                  
                   <select name="txtnotephongban" class="js-example-basic-multiple form-control" id="txtnotephongban" oninvalid="this.setCustomValidity('Đơn vị sử dụng không để trống')" oninput="setCustomValidity('')" required >
                    <option value="<?php echo $row_camera_ud['cam_dept_name'] ;?>"><?php echo $row_camera_ud['Note_phongban'] ;?></option>
                    <?php 
                     while($row_camera_ud_dept_name = mysqli_fetch_assoc($result_camera_ud_dept_name))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_ud_dept_name['dept_name'] ; ?>"><?php echo $row_camera_ud_dept_name['Note_phongban'] ; ?></option>
                    <?php
                    }
                    ?>            
                  </select>
                </div>
                <!-- Get old địa điểm làm việc-->                                 
                <input value="<?php echo $row_camera_ud['cam_dept_location'] ;?>" type="hidden" name="txtlocation_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc (*)</label>                  
                  <select name="txtlocation" class="js-example-basic-multiple form-control" id="txtlocation" oninvalid="this.setCustomValidity('Nơi làm việc không để trống')" oninput="setCustomValidity('')" required >
                    <option value="<?php echo $row_camera_ud['cam_dept_location'] ;?>"><?php echo $row_camera_ud['network_dept_detail'] ;?></option>
                    <?php 
                     while($row_camera_ud_dept = mysqli_fetch_assoc($result_camera_ud_dept))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_ud_dept['network_dept'] ; ?>"><?php echo $row_camera_ud_dept['network_dept_detail'] ; ?></option>
                    <?php
                    }
                    ?>            
                  </select>
                </div>
                <!-- Get old tên đầu ghi-->                                 
                  <input value="<?php echo $row_camera_ud['ten_daughi'] ;?>" type="hidden" name="txtdaughiname_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Tên đầu ghi (*)</label>
                  <input  value="<?php echo $row_camera_ud['ten_daughi'] ; ?>" type="text" name="txtdaughiname" class="form-control" id="usr" placeholder="Điền thông tin đầu ghi" oninvalid="this.setCustomValidity('Tên đầu ghi không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <!-- Get old tên camera-->                                 
                  <input value="<?php echo $row_camera_ud['ten_camera'] ;?>" type="hidden" name="txtcameraname_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Tên camera (*)</label>
                  <input value="<?php echo $row_camera_ud['ten_camera'] ; ?>" type="text" name="txtcameraname" class="form-control" id="usr" placeholder="Điền thông tin camera" oninvalid="this.setCustomValidity('Tên camera không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <!-- Get old số lượng camera-->                                 
                <input value="<?php echo $row_camera_ud['sl_camera'] ;?>" type="hidden" name="txtslcamera_old" class="form-control" id="address">
                 <div class="form-group col-lg-2">
                  <label for="usr">Số lượng camera</label>
                  <select name="txtslcamera" class="js-example-basic-multiple form-control" id="txtslcamera">
                    <option value="<?php echo $row_camera_ud['sl_camera'] ;?>"><?php echo $row_camera_ud['sl_camera']." cái" ; ?></option>                                 
                      <option value="1">1 cái</option>
                      <option value="2">2 cái</option>
                      <option value="3">3 cái</option>
                      <option value="4">4 cái</option> 
                      <option value="5">5 cái</option> 
                      <option value="6">6 cái</option> 
                      <option value="7">7 cái</option> 
                      <option value="8">8 cái</option>                                                 
                      <option value="9">9 cái</option> 
                      <option value="10">10 cái</option> 
                      <option value="11">11 cái</option> 
                      <option value="12">12 cái</option> 
                  </select>
                </div>
                <!-- Get old thương hiệu camera-->                                 
                <input value="<?php echo $row_camera_ud['ten_thuonghieu'] ;?>" type="hidden" name="txtcameraprovider_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Thương hiệu(*)</label>
                  <select name="txtcameraprovider" class="js-example-basic-multiple form-control" id="txtcameraprovider" oninvalid="this.setCustomValidity('Thương hiệu không để trống')" oninput="setCustomValidity('')" required >
                    <option value="<?php echo $row_camera_ud['ten_thuonghieu'] ;?>"><?php echo $row_camera_ud['ten_thuonghieu'] ;?></option>
                       <?php 
                     while($row_camera_ud_provider = mysqli_fetch_assoc($result_camera_ud_provider))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_ud_provider['camera_provider'] ; ?>"><?php echo $row_camera_ud_provider['camera_provider_detail'] ; ?></option>
                    <?php
                    }
                    ?>                                                
                  </select>
              </div>
              <!-- Get old dung lượng camera-->                                 
                <input value="<?php echo $row_camera_ud['camera_disk'] ;?>" type="hidden" name="txtcameradisk_old" class="form-control" id="address">
              <div class="form-group col-lg-2">
                  <label for="usr">Dung lượng lưu trữ(*)</label>
                  <select name="txtcameradisk" class="js-example-basic-multiple form-control" id="txtcameradisk" oninvalid="this.setCustomValidity('Dung lượng lưu trữ không để trống')" oninput="setCustomValidity('')" required >
                    <option value="<?php echo $row_camera_ud['camera_disk'] ;?>"><?php echo $row_camera_ud['camera_disk_detail'] ;?></option>
                       <?php 
                     while($row_camera_disk = mysqli_fetch_assoc($result_camera_disk))
                    {   
                    ?>                                  
                      <option value="<?php echo $row_camera_disk['camera_disk'] ; ?>"><?php echo $row_camera_disk['camera_disk_detail'] ; ?></option>
                    <?php
                    }
                    ?>                                                
                  </select>
              </div>
              <!-- Get old username-->                                 
                <input value="<?php echo $row_camera_ud['username_cam'] ;?>" type="hidden" name="txtcamerausr_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="usr">Username</label>
                  <input value="<?php echo $row_camera_ud['username_cam'] ;?>" type="text" name="txtcamerausr" class="form-control" id="usr" placeholder="Điền tên đăng nhập camera">
                </div>
                <!-- Get old pasword-->                                 
                <input value="<?php echo $row_camera_ud['password_cam'] ;?>" type="hidden" name="txtcamerapass_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Password</label>                  
                  <input value="<?php echo $row_camera_ud['password_cam'] ;?>" type="password" name="txtcamerapass" class="form-control" id="usr" placeholder="Điền pasword camera">
                </div>
                <!-- Get old domain/ip-->                                 
                <input value="<?php echo $row_camera_ud['domain_cam'] ;?>" type="hidden" name="txtcameradomain_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Domain/IP</label>                  
                  <input value="<?php echo $row_camera_ud['domain_cam'] ;?>" type="text" name="txtcameradomain" class="form-control" id="usr" placeholder="Điền thông tin domain/ip">
                </div>
                <!-- Get old port media-->                                 
                <input value="<?php echo $row_camera_ud['port_media'] ;?>" type="hidden" name="txtportmedia_old" class="form-control" id="address">
                <div class="form-group col-lg-1">
                  <label for="email">Port media</label>                  
                  <input value="<?php echo $row_camera_ud['port_media'] ;?>" type="text" name="txtportmedia" class="form-control" id="address" placeholder="Port media">
                </div>
                <!-- Get old port web-->                                 
                <input value="<?php echo $row_camera_ud['port_http'] ;?>" type="hidden" name="txtportweb_old" class="form-control" id="address">
                <div class="form-group col-lg-1">
                  <label for="email">Port web</label>                  
                   <input value="<?php echo $row_camera_ud['port_http'] ;?>" type="text" name="txtportweb" class="form-control" id="address" placeholder="Port web">
                </div>
                <!-- Get old update date-->                                 
                <input value="<?php echo $row_camera_ud['update_date'] ;?>" type="hidden" name="txtupdatedate_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Ngày cập nhật</label>                  
                  <input value="<?php echo $row_camera_ud['update_date'] ;?>" type="date" name="txtupdatedate" class="form-control" id="address" placeholder="Nhập ngày cập nhật">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="update" style="background-color: #30a5ff;">Cập nhật thông tin</button>
                </div>             
                
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "remove-camera") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thanh lý đường truyền mạng</h2>
            </div>
            <form action='updatecamera.php' method='POST' onSubmit="return confirm('Bạn muốn thanh lý hệ thống camera của đơn vi <?php echo $row_camera_ud['Note_phongban'] ;?> này không?')">
            <div class="panel-body">
                <input value="<?php echo $row_camera_ud['camera_id'] ; ?>" name="txtcamera_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-2">
                  <label for="email">Đơn vị sử dụng</label>                  
                   <input style="color: red; font-weight: bold;" value="<?php echo $row_camera_ud['Note_phongban'] ;?>" type="text" name="txtnotephongban" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Nơi làm việc (*)</label>                  
                   <input value="<?php echo $row_camera_ud['network_dept_detail'] ;?>" type="text" name="txtlocation" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên đầu ghi (*)</label>
                  <input  value="<?php echo $row_camera_ud['ten_daughi'] ; ?>" type="text" name="txtdaughiname" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên camera (*)</label>
                  <input value="<?php echo $row_camera_ud['ten_camera'] ; ?>" type="text" name="txtcameraname" class="form-control" id="usr" readonly>
                </div>
                 <div class="form-group col-lg-2">
                  <label for="usr">Số lượng camera</label>
                  <input value="<?php echo $row_camera_ud['sl_camera'] ;?>" type="text" name="txtslcamera" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Thương hiệu</label>
                  <input value="<?php echo $row_camera_ud['ten_thuonghieu'] ;?>" type="text" name="txtcameraprovider" class="form-control" id="address" readonly>
              </div>
              <div class="form-group col-lg-2">
                  <label for="usr">Dung lượng lưu trữ</label>
                  <input value="<?php echo $row_camera_ud['camera_disk'] ;?>" type="text" name="txtcameradisk" class="form-control" id="address" readonly>
              </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Username</label>
                  <input value="<?php echo $row_camera_ud['username_cam'] ;?>" type="text" name="txtcamerausr" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Password</label>                  
                  <input value="<?php echo $row_camera_ud['password_cam'] ;?>" type="password" name="txtcamerapass" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Domain/IP</label>                  
                  <input value="<?php echo $row_camera_ud['domain_cam'] ;?>" type="text" name="txtcameradomain" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Port media</label>                  
                  <input value="<?php echo $row_camera_ud['port_media'] ;?>" type="text" name="txtportmedia" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Port web</label>                  
                   <input value="<?php echo $row_camera_ud['port_http'] ;?>" type="text" name="txtportweb" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Ngày cập nhật</label>                  
                  <input value="<?php echo $row_camera_ud['update_date'] ;?>" type="date" name="txtupdatedate" class="form-control" id="address" readonly>
                </div>
                <div class="col-lg-12">                           
                <button class="btn btn-primary" name="delete" >Thanh lý hệ thống</button>
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