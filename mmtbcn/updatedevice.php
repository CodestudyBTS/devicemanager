<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))      {  
        if($_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3)
        {  
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        // $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $madevice = isset($_GET['deviceid']) ? $_GET['deviceid'] : '' ;
        $date_tl=date('Y-m-d');
        $phongban=isset($_GET['deptdevice']) ? $_GET['deptdevice'] : '' ;
        $toyear = getdate();
        $prefix = $toyear['year'];
        $query_device_total = "SELECT max(device_id) as max_id  from cn_device WHERE device_id like '$prefix%' AND dept_location like '$phongban' " ;
        $result_device_total= mysqli_query($connect, $query_device_total) ;  
        // $rowcount_device_total = mysqli_num_rows($result_device_total); 
        $row_device = mysqli_fetch_array($result_device_total);
        $curent_id=$row_device['max_id'];

        // Get data category 
        $query_device = "SELECT * from cn_device WHERE device_name like '$madevice' AND dept_location like '$phongban'" ;
        $result_device= mysqli_query($connect, $query_device) ; 
        $row_device_ud = mysqli_fetch_array($result_device);
        if(empty($row_device_ud['dept_name']))
        {
            $dept_device=null;
        }
        else
        {
            $dept_device=$row_device_ud['dept_name'];
        } 
        //main
        if(empty($row_device_ud['device_main']))
        {
            $main_device=null;
        }
        else
        { 
            $main_device=$row_device_ud['device_main'];
        } 
        //cpu  
        if(empty($row_device_ud['device_cpu']))
        {
            $cpu_device=null;
        }
        else
        {
            $cpu_device=$row_device_ud['device_cpu'];
        }
        //ram
        if(empty($row_device_ud['device_ram']))
        {
            $ram_device=null;
        }
        else
        {
            $ram_device=$row_device_ud['device_ram'];
        } 
        // psu
        if(empty($row_device_ud['device_psu']))
        {
            $psu_device=null;
        }
        else
        {
            $psu_device=$row_device_ud['device_psu'];
        }
        //disk1
        if(empty($row_device_ud['device_disk1']))
        {
            $disk1_device=null;
        }
        else
        {
            $disk1_device=$row_device_ud['device_disk1'];
        }
        //disk2
        if(empty($row_device_ud['device_disk2']))
        {
            $disk2_device=null;
        }
        else
        {
            $disk2_device=$row_device_ud['device_disk2'];
        }
        //monitor
        if(empty($row_device_ud['device_monitor']))
        {
            $monitor_device=null;
        }
        else
        {
            $monitor_device=$row_device_ud['device_monitor'];
        }
        //case
        if(empty($row_device_ud['device_case']))
        {
            $case_device=null;
        }
        else
        {
            $case_device=$row_device_ud['device_case'];
        }
        //vga
        if(empty($row_device_ud['device_vga']))
        {
            $vga_device=null;
        }
        else
        {
            $vga_device=$row_device_ud['device_vga'];
        }


         // Get data mainboard in device 
        $query_main = "SELECT * from category_detail WHERE category_id ='5' AND category_detail_name <> '$main_device'" ;
        $result_main= mysqli_query($connect, $query_main) ;
        // Get data cpu in device 
        $query_cpu = "SELECT * from category_detail WHERE category_id ='1' AND category_detail_name <> '$cpu_device'" ;
        $result_cpu= mysqli_query($connect, $query_cpu) ;
        // Get data ram in device 
        $query_ram = "SELECT * from category_detail WHERE category_id ='2'  AND category_detail_name <> '$ram_device'" ;
        $result_ram= mysqli_query($connect, $query_ram) ;
        // Get data psu in device 
        $query_psu = "SELECT * from category_detail WHERE category_id ='7' AND category_detail_name <> '$psu_device'" ;
        $result_psu= mysqli_query($connect, $query_psu) ;
        // Get data disk1 in device 
        $query_disk1 = "SELECT * from category_detail WHERE category_id ='6' AND category_detail_name <> '$disk1_device'" ;
        $result_disk1= mysqli_query($connect, $query_disk1) ;
        // Get data disk1 in device 
        $query_disk2 = "SELECT * from category_detail WHERE category_id ='6' AND category_detail_name <> '$disk2_device'" ;
        $result_disk2= mysqli_query($connect, $query_disk2) ;
        // Get data monitor in device 
        $query_monitor = "SELECT * from category_detail WHERE category_id ='4' AND category_detail_name <> '$monitor_device'" ;
        $result_monitor= mysqli_query($connect, $query_monitor) ;
        // Get data monitor in device 
        $query_case = "SELECT * from category_detail WHERE category_id ='3' AND category_detail_name <> '$case_device'" ;
        $result_case= mysqli_query($connect, $query_case) ;
        // Get data monitor in device 
        $query_vga = "SELECT * from category_detail WHERE category_id ='8' AND category_detail_name <> '$vga_device'" ;
        $result_vga= mysqli_query($connect, $query_vga) ;
        // Get data dept 
        $query_dept = "SELECT * from cn_phongban where dept_location = '$phongban' AND dept_name <> '$dept_device' " ;
        $result_dept= mysqli_query($connect, $query_dept) ; 

           require 'xulyupdatedevice.php';               

?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <?php
        if(empty($func) ||  $func == "add-device")
        {
            echo "<title>Thêm thiết bị</title>";
        }
        elseif($func == "update-device")
        {
            echo "<title>Cập nhật thiết bị</title>";
        }
        elseif($func == "remove-device")
        {
            echo "<title>Thanh lý thiết bị</title>";
        }
        ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet"> 
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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet">
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
            if(empty($func) ||  $func == "add-device")
            {
                
                function generateDeviceCode($a,$b)
                {
                    $a = substr($a, 4);
                    $counter = intval($a) + 1 ;                        
                    $deviceCode = $b . str_pad($counter, 3, '0', STR_PAD_LEFT);
                    return $deviceCode;
                }
                $mathietbi = generateDeviceCode($curent_id,$prefix);
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm thiết bị mới</h2>
                <!-- <h2 class="text-center"><?php echo $rowcount_device_total; echo  $prefix;?> </h2> -->

            </div>
            <form action='updatedevice.php' method='POST'>
            <div class="panel-body">
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686" >Thông tin định danh</label>    
                </div>
                <div class="form-group col-lg-2">
                  <label for="address">Mã Tài Sản</label>
                  <input value="" type="text" name="txtsapid" class="form-control" id="address" placeholder="Nhập mã tài sản đã tạo SAP">
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Mã thiết bị</label>
                  <input style="color: red; font-weight: bold;" value="<?php echo "$mathietbi" ?>" type="text" name="txtmathietbi" class="form-control" id="usr" readonly >
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Loại thiết bị (*) </label>                  
                  <select name="txtdevicetype" class="js-example-basic-multiple form-control" id="type_device" oninvalid="this.setCustomValidity('Loại thiết bị không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn loại thiết bị" ; ?></option>                                   
                      <option value="PC">PC</option>
                      <option value="LT">Laptop</option>
                      <option value="PRT">Printer</option>
                      <option value="DV">Các thiết bị khác</option>                 
                  </select>
                </div>
                <div class="form-group col-lg-6">
                  <label for="address">Tên thiết bị (Dành cho Printer và các thiết bị khác)</label>
                  <input value="" type="text" name="txtnameprinter" class="form-control" id="address" placeholder="Nhâp tên thiết bị printer hoặc thiết bị khác">
                </div>
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686" >Cấu hình thiết bị (Dành cho PC và Laptop) </label>    
                </div>
                <div class="form-group col-lg-3" >
                  <label for="email">Mainboard</label>                  
                  <select name="txtmain" class="js-example-basic-multiple form-control" id="is_main">
                    <option value=""><?php echo "Chọn Mainboard" ; ?></option>                                   
                      <?php
                    while($row_main = mysqli_fetch_assoc($result_main))
                    {   
                    ?>                
                      <option value="<?php echo $row_main['category_detail_name'] ; ?>"><?php echo $row_main['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">CPU</label>                  
                  <select name="txtcpu" class="js-example-basic-multiple form-control" id="is_cpu">
                    <option value=""><?php echo "Chọn CPU" ; ?></option>                                   
                      <?php
                    while($row_cpu = mysqli_fetch_assoc($result_cpu))
                    {   
                    ?>                
                      <option value="<?php echo $row_cpu['category_detail_name'] ; ?>"><?php echo $row_cpu['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Memory</label>                  
                  <select name="txtram" class="js-example-basic-multiple form-control" id="is_memory">
                    <option value=""><?php echo "Chọn memory" ; ?></option>                                   
                      <?php
                    while($row_ram = mysqli_fetch_assoc($result_ram))
                    {   
                    ?>                
                      <option value="<?php echo $row_ram['category_detail_name'] ; ?>"><?php echo $row_ram['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">VGA</label>                  
                  <select name="txtvga" class="js-example-basic-multiple form-control" id="is_vga">
                    <option value=""><?php echo "Chọn card màn hình" ; ?></option>                                   
                      <?php
                    while($row_vga = mysqli_fetch_assoc($result_vga))
                    {   
                    ?>                
                      <option value="<?php echo $row_vga['category_detail_name'] ; ?>"><?php echo $row_vga['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Nguồn</label>                  
                  <select name="txtpsu" class="js-example-basic-multiple form-control" id="is_power">
                    <option value=""><?php echo "Chọn power" ; ?></option>                                   
                      <?php
                    while($row_psu = mysqli_fetch_assoc($result_psu))
                    {   
                    ?>                
                      <option value="<?php echo $row_psu['category_detail_name'] ; ?>"><?php echo $row_psu['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Hard disk1</label>                  
                  <select name="txtdisk1" class="js-example-basic-multiple form-control" id="is_disk1">
                    <option value=""><?php echo "Chọn Disk1" ; ?></option>                                   
                      <?php
                    while($row_disk1 = mysqli_fetch_assoc($result_disk1))
                    {   
                    ?>                
                      <option value="<?php echo $row_disk1['category_detail_name'] ; ?>"><?php echo $row_disk1['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Hard disk2</label>                  
                  <select name="txtdisk2" class="js-example-basic-multiple form-control" id="is_disk2">
                    <option value=""><?php echo "Chọn Disk2" ; ?></option>                                   
                      <?php
                    while($row_disk2 = mysqli_fetch_assoc($result_disk2))
                    {   
                    ?>                
                      <option value="<?php echo $row_disk2['category_detail_name'] ; ?>"><?php echo $row_disk2['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Màn hình</label>                  
                  <select name="txtmonitor" class="js-example-basic-multiple form-control" id="is_monitor">
                    <option value=""><?php echo "Chọn Màn hình" ; ?></option>                                   
                      <?php
                    while($row_monitor = mysqli_fetch_assoc($result_monitor))
                    {   
                    ?>                
                      <option value='<?php echo $row_monitor['category_detail_name'] ; ?>'><?php echo $row_monitor['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Case</label>                  
                  <select name="txtcase" class="js-example-basic-multiple form-control" id="is_case">
                    <option value=""><?php echo "Chọn Case" ; ?></option>                                   
                      <?php
                    while($row_case = mysqli_fetch_assoc($result_case))
                    {   
                    ?>                
                      <option value="<?php echo $row_case['category_detail_name'] ; ?>"><?php echo $row_case['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686" >Thông tin đơn vị sử dụng</label>    
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Phòng ban (*) </label>                  
                  <select name="txtdept" class="js-example-basic-multiple form-control" id="is_dept" oninvalid="this.setCustomValidity('Phòng ban không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn phòng ban" ; ?></option>                                   
                      <?php
                    while($row_dept = mysqli_fetch_assoc($result_dept))
                    {   
                    ?>                
                      <option value="<?php echo $row_dept['dept_name'] ; ?>"><?php echo $row_dept['dept_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <!-- Location dept -->                                 
                <input value="<?php echo $phongban ; ?>" type="hidden" name="txtlocation" class="form-control" id="address">
                <div class="form-group col-lg-4">
                  <label for="address">Nhân sự sử dụng</label>
                  <input value="" type="text" name="txtusr" class="form-control" id="address" placeholder="Nhập nhân sự sử dụng thiết bị">
                </div>                

                <div class="form-group col-lg-4">
                  <label for="address">Ghi chú (nếu có) </label>
                  <input value="" type="text" name="txtnote" class="form-control" id="address" placeholder="Nhập ghi chú (nếu có)">
                </div>
                <div class="form-group col-lg-2">
                  <label for="address">Ngày thêm thiết bị</label>
                  <input value="<?php echo $date_tl ;?>" type="date" name="txtdate" class="form-control" id="address">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="insert">Thêm thiết bị</button>
                </div>
            </div>
        </form>
        </div>
                <?php

            }
                elseif($func == "update-device")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Cập nhật thiết bị mới</h2>
            </div>
                <form action='updatedevice.php' method='POST'>
            <div class="panel-body">
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686"> Thông tin định danh</label>    
                </div>
                <div class="form-group col-lg-2">
                  <label for="address">Mã Tài Sản</label>
                  <input value="<?php echo $row_device_ud['sap_id'] ;?>" type="text" name="txtsapid" class="form-control" id="address" placeholder="Nhập mã tài sản">
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên thiết bị</label>
                  <input style="color: red; font-weight: bold;" value="<?php echo $row_device_ud['device_name'] ;?>" type="text" name="txtdevice" class="form-control" id="usr" readonly>
                </div>
                 <div class="form-group col-lg-8">
                  <label for="address"> Tên thiết bị (Dành cho Printer hoặc thiết bị khác)</label>
                  <input value="<?php echo $row_device_ud['device_orther_name'] ;?>" type="text" name="txtnameprinter" class="form-control" id="address" >
                </div>
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686" > Cấu hình thiết bị</label>    
                </div>
                <!-- Get old main -->                                 
                  <input value="<?php echo $row_device_ud['device_main']?>" type="hidden" name="txtmain_old" class="form-control" id="address">

                <div class="form-group col-lg-3" >
                  <label for="email">Mainboard</label>                  
                  <select name="txtmain" class="js-example-basic-multiple form-control" id="ud_main">
                    <?php 
                        if(empty($row_device_ud['device_main']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin main ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_main']; ?>"><?php echo $row_device_ud['device_main'] ?></option>
                            <option value=""> Không có main</option>
                       <?php
                        }
                    ?>
                                                       
                      <?php
                    while($row_main = mysqli_fetch_assoc($result_main))
                    {   
                    ?>                
                      <option value="<?php echo $row_main['category_detail_name'] ; ?>"><?php echo $row_main['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <!-- Get old cpu -->                
                  <input value="<?php echo $row_device_ud['device_cpu'] ;?>" type="hidden" name="txtcpu_old" class="form-control" id="address">
               
                <div class="form-group col-lg-3">
                  <label for="email">CPU</label>                  
                  <select name="txtcpu" class="js-example-basic-multiple form-control" id="ud_cpu">
                    <?php 
                        if(empty($row_device_ud['device_cpu']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin cpu ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_cpu']; ?>"><?php echo $row_device_ud['device_cpu'] ?></option>
                       <?php
                        }
                    ?>                                   
                      <?php
                    while($row_cpu = mysqli_fetch_assoc($result_cpu))
                    {   
                    ?>                
                      <option value="<?php echo $row_cpu['category_detail_name'] ; ?>"><?php echo $row_cpu['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <!-- Get old ram -->                
                  <input value='<?php echo $row_device_ud['device_ram'] ;?>' type="hidden" name="txtmemory_old" class="form-control" id="address">
               
                <div class="form-group col-lg-3">
                  <label for="email">Memory</label>                  
                  <select name="txtmemory" class="js-example-basic-multiple form-control" id="ud_mem">
                    <?php 
                        if(empty($row_device_ud['device_ram']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin menory ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value='<?php echo $row_device_ud['device_ram']; ?>'><?php echo $row_device_ud['device_ram']; ?></option>
                       <?php
                        }
                    ?>                                   
                      <?php
                    while($row_ram = mysqli_fetch_assoc($result_ram))
                    {   
                    ?>                
                      <option value='<?php echo $row_ram['category_detail_name'] ; ?>'><?php echo $row_ram['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>

                <!-- Get old vga -->
                  <input value="<?php echo $row_device_ud['device_vga'] ;?>" type="hidden" name="txtvga_old" class="form-control" id="address">
                
                <div class="form-group col-lg-3">
                  <label for="email">VGA</label>                  
                  <select name="txtvga" class="js-example-basic-multiple form-control" id="ud_vga">
                    <?php 
                        if(empty($row_device_ud['device_vga']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin card màn hình ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_vga'] ;?>"><?php echo $row_device_ud['device_vga'] ?></option>
                       <?php
                        }
                    ?>                              
                      <?php
                    while($row_vga = mysqli_fetch_assoc($result_vga))
                    {   
                    ?>                
                      <option value="<?php echo $row_vga['category_detail_name'] ; ?>"><?php echo $row_vga['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                 <!-- Get old nguon -->
                  <input value="<?php echo $row_device_ud['device_psu'] ;?>" type="hidden" name="txtpsu_old" class="form-control" id="address">
                
                <div class="form-group col-lg-3">
                  <label for="email">Nguồn</label>                  
                  <select name="txtpsu" class="js-example-basic-multiple form-control" id="ud_power">
                    <?php 
                        if(empty($row_device_ud['device_psu']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin nguồn ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_psu'] ;?>"><?php echo $row_device_ud['device_psu'] ?></option>
                       <?php
                        }
                    ?>                              
                      <?php
                    while($row_psu = mysqli_fetch_assoc($result_psu))
                    {   
                    ?>                
                      <option value="<?php echo $row_psu['category_detail_name'] ; ?>"><?php echo $row_psu['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                 <!-- Get old disk1 -->
                  <input value="<?php echo $row_device_ud['device_disk1'] ;?>" type="hidden" name="txtdisk1_old" class="form-control" id="address">
                
                <div class="form-group col-lg-3">
                  <label for="email">Hard disk1</label>                  
                  <select name="txtdisk1" class="js-example-basic-multiple form-control" id="ud_disk1">
                    <?php 
                        if(empty($row_device_ud['device_disk1']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin harddisk 1 ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_disk1'] ;?>"><?php echo $row_device_ud['device_disk1'] ?></option>
                       <?php
                        }
                    ?>                                   
                      <?php
                    while($row_disk1 = mysqli_fetch_assoc($result_disk1))
                    {   
                    ?>                
                      <option value="<?php echo $row_disk1['category_detail_name'] ; ?>"><?php echo $row_disk1['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                 <!-- Get old disk2 -->
                  <input value="<?php echo $row_device_ud['device_disk2'] ;?>" type="hidden" name="txtdisk2_old" class="form-control" id="address">
                
                <div class="form-group col-lg-3">
                  <label for="email">Hard disk2</label>                  
                  <select name="txtdisk2" class="js-example-basic-multiple form-control" id="ud_disk2">
                    <?php 
                        if(empty($row_device_ud['device_disk2']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin harddisk 2 ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_disk2'] ;?>"><?php echo $row_device_ud['device_disk2'] ?></option>
                       <?php
                        }
                    ?>                                   
                      <?php
                    while($row_disk2 = mysqli_fetch_assoc($result_disk2))
                    {   
                    ?>                
                      <option value="<?php echo $row_disk2['category_detail_name'] ; ?>"><?php echo $row_disk2['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                 <!-- Get old monitor -->
                  <input value='<?php echo $row_device_ud['device_monitor'] ;?>' type="hidden" name="txtmonitor_old" class="form-control" id="address">
                
                <div class="form-group col-lg-3">
                  <label for="email">Màn hình</label>                
                  <select name="txtmonitor" class="js-example-basic-multiple form-control" id="ud_monitor">  
                    <?php 
                        if(empty($row_device_ud['device_monitor']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin màn hình ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value='<?php echo $row_device_ud['device_monitor'] ; ?>'><?php echo $row_device_ud['device_monitor'] ?></option>
                       <?php
                        }
                    ?>                                   
                      <?php
                    while($row_monitor = mysqli_fetch_assoc($result_monitor))
                    {   
                    ?>                
                      <option value='<?php echo $row_monitor['category_detail_name'] ; ?>'><?php echo $row_monitor['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                 <!-- Get old case -->
                  <input value="<?php echo $row_device_ud['device_case'] ;?>" type="hidden" name="txtcase_old" class="form-control" id="address">
                
                <div class="form-group col-lg-3">
                  <label for="email">Case</label>                  
                  <select name="txtcase" class="js-example-basic-multiple form-control" id="ud_case">
                    <?php 
                        if(empty($row_device_ud['device_case']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin thùng máy tính ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['device_case'] ;?>"><?php echo $row_device_ud['device_case'] ?></option>
                       <?php
                        }
                    ?>                                   
                      <?php
                    while($row_case = mysqli_fetch_assoc($result_case))
                    {   
                    ?>                
                      <option value="<?php echo $row_case['category_detail_name'] ; ?>"><?php echo $row_case['category_detail_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686"> Thông tin đơn vị sử dụng</label>    
                </div>
                <!-- Get old phong ban -->
                  <input value="<?php echo $row_device_ud['dept_name'] ;?>" type="hidden" name="txtphongban_old" class="form-control" id="address">
                <div class="form-group col-lg-2">
                  <label for="email">Phòng ban (*)</label>                  
                  <select name="txtdept" class="js-example-basic-multiple form-control" id="ud_dept" oninvalid="this.setCustomValidity('Phòng ban không để trống')" oninput="setCustomValidity('')" required>
                    <?php 
                        if(empty($row_device_ud['dept_name']))
                        {
                            ?>
                            <option value="" disabled selected hidden>Nhập thông tin phòng ban ... </option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row_device_ud['dept_name'] ;?>" ><?php echo $row_device_ud['dept_name'] ?></option>
                       <?php
                        }
                    ?>                                                       
                      <?php
                    while($row_dept = mysqli_fetch_assoc($result_dept))
                    {   
                    ?>                
                      <option value="<?php echo $row_dept['dept_name'] ; ?>"><?php echo $row_dept['dept_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                   
                  </select>
                </div>
                <!-- Get old nhân sự -->
                  <input value="<?php echo $row_device_ud['user_name'] ;?>" type="hidden" name="txtnhansu_old" class="form-control" id="address">
                <div class="form-group col-lg-4">
                  <label for="address">Nhân sự sử dụng</label>
                  <input value="<?php echo $row_device_ud['user_name'] ;?>" type="text" name="txtusr" class="form-control" id="address" placeholder="Nhập nhân sự sử dụng thiết bị">
                </div>                

                <div class="form-group col-lg-4">
                  <label for="address">Ghi chú (nếu có) </label>
                  <input value="<?php echo $row_device_ud['Note'] ;?>" type="text" name="txtnote" class="form-control" id="address" placeholder="Enter Note">
                </div>
                <div class="form-group col-lg-2">
                  <label for="address">Ngày cập nhật</label>
                  <input value="<?php echo $row_device_ud['device_update_date'] ;?>" type="date" name="txtdate" class="form-control" id="address">
                </div>

                <div class="col-lg-12">
                <button class="btn btn-primary" name="update">Cập nhật thiết bị</button> 
                </div>            
                
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "remove-device") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thanh lý hủy mã tài sản</h2>
            </div>
            <form action='updatedevice.php' method='POST' onSubmit="return confirm('Are you sure to delete?')">
            <div class="panel-body">
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686">Thông tin định danh</label>    
                </div>
                <div class="form-group col-lg-2">
                  <label for="address">Mã Tài Sản</label>
                  <input value="<?php echo $row_device_ud['sap_id'] ;?>" type="text" name="txtsap_id" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="usr">Tên thiết bị</label>
                  <input style="color: red; font-weight: bold;" value="<?php echo $row_device_ud['device_name'] ;?> "  type="text" name="txtdevice" class="form-control" id="usr" readonly>
                </div>  
                <div class="form-group col-lg-8">
                  <label for="address"> Tên thiết bị (Dành cho Printer hoặc thiết bị khác)</label>
                  <input value="<?php echo $row_device_ud['device_orther_name'] ;?>" type="text" name="txtnameprinter" class="form-control" id="address" readonly>
                </div>
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686">Cấu hình thiết bị</label>    
                </div>    
                <div class="form-group col-lg-3" >
                  <label for="email">Mainboard</label>                  
                  <input value="<?php echo $row_device_ud['device_main'] ;?>" type="text" name="txtmain" class="form-control" id="usr" readonly>
                </div>                           
                <div class="form-group col-lg-3">
                  <label for="email">CPU</label>                  
                  <input value="<?php echo $row_device_ud['device_cpu'] ;?>" type="text" name="txtcpu" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Memory</label>                  
                  <input value="<?php echo $row_device_ud['device_ram'] ;?>" type="text" name="txtram" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">VGA</label>                  
                  <input value="<?php echo $row_device_ud['device_vga'] ;?>" type="text" name="txtvga" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Nguồn</label>                  
                  <input value="<?php echo $row_device_ud['device_psu'] ;?>" type="text" name="txtpsu" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Disk1</label>                  
                  <input value="<?php echo $row_device_ud['device_disk1'] ;?>" type="text" name="txtdisk1" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Disk2</label>                  
                  <input value="<?php echo $row_device_ud['device_disk2']; ?>" type="text" name="txtdisk2" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Màn hình</label>                  
                  <input value='<?php echo $row_device_ud['device_monitor'] ;?>' type="text" name="txtmonitor" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Case</label>                  
                   <input value="<?php echo $row_device_ud['device_case'] ;?>" type="text" name="txtcase" class="form-control" id="address" readonly>
                </div>
                <div class="col-lg-12" style="font-size: 25px; background-color: #86e686; margin-bottom: 10px; text-align: center;">
                <label for="address" style="color: #868686">Thông tin đơn vị sử dụng</label>    
                </div>
                <div class="form-group col-lg-2">
                  <label for="email">Phòng ban</label>                  
                   <input value="<?php echo $row_device_ud['dept_name'] ;?>" type="text" name="txtdept" class="form-control" id="address" readonly>
                </div>

                <div class="form-group col-lg-4">
                  <label for="address">Nhân sự sử dụng</label>
                  <input value="<?php echo $row_device_ud['user_name'] ;?>" type="text" name="txtusr" class="form-control" id="address" readonly>
                </div>                

                <div class="form-group col-lg-4">
                  <label for="address">Ghi chú </label>
                  <input value="<?php echo $row_device_ud['Note'] ;?>" type="text" name="txtnote" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-2">
                  <label for="address">Ngày cập nhật</label>
                  <input value="<?php echo $row_device_ud['device_update_date'] ;?>" type="date" name="txtdate" class="form-control" id="address" readonly>
                </div>
                <div class="col-lg-12">                    
                <button class="btn btn-primary" name="delete" >Thanh lý</button>
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