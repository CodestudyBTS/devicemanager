<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))
        {
        if($_SESSION['admin_cn_mmtb'] >= 2 || $_SESSION['admin'] >= 3 )
        {       
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $dept_id = isset($_GET['dept']) ? $_GET['dept'] : '' ;
        $date_tl=date('Y-m-d');
        $location_cn=$_SESSION['staff_location'];
        // Get data category 
        $query_dept = "SELECT * from cn_phongban" ;
        $result_dept= mysqli_query($connect, $query_dept) ; 
        // $row_dept = mysqli_fetch_array($result_dept);

        //Get data category_detail
        $query_dept_ud = "SELECT * from cn_phongban WHERE dept_id='$dept_id'";
        $result_dept_ud= mysqli_query($connect, $query_dept_ud) ; 
        $row_dept_ud = mysqli_fetch_array($result_dept_ud);
           require 'xulyupdatedept.php';               

?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <?php
        if(empty($func) ||  $func == "add-dept")
        {
            echo "<title>Thêm phòng ban</title>";
        }
        elseif($func == "update-dept")
        {
            echo "<title>Cập nhật phòng ban</title>";
        }
        elseif($func == "remove-dept")
        {
            echo "<title>Xóa phòng ban</title>";
        }
        ?>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <!-- <link href="css/styles.css" rel="stylesheet"> -->
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
        <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
        <link href="css/styles.css" rel="stylesheet">
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
            if(empty($func) ||  $func == "add-dept")
            {
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm phòng ban </h2>
            </div>
            <form action='updatedept.php' method='POST'>
            <div class="panel-body">
                <div class="form-group col-lg-6">
                  <label for="usr">Tên phòng ban (*) </label>
                  <input value="" type="text" name="txtdept" class="form-control" id="usr" placeholder="Điền tên phòng ban" oninvalid="this.setCustomValidity('Tên phòng ban không để trống')" oninput="setCustomValidity('')" required >
                </div>
                <div class="form-group col-lg-3">
                  <label for="usr">Mã site (*) </label>
                  <input value="" type="text" name="txtsite" class="form-control" id="usr" placeholder="Điền mã site" oninvalid="this.setCustomValidity('Mã site không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Vị trí phòng ban (*)</label>  
                  <?php 
                  if($location_cn == "cty")
                  {
                    ?>
                    <select name="txtlocation" class="form-control" id="sel1" oninvalid="this.setCustomValidity('Vị trí phòng ban không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn tên địa điểm" ; ?></option>  
                    <option value="CNTP">Chi Nhánh Tiên Phong</option>                                 
                    <option value="CNMB">Chi Nhánh Miền Bắc</option>
                    <option value="CNMN">Chi Nhánh Miền Nam</option>
                    <option value="CNMT">Chi Nhánh Miền Tây</option>
                    <option value="CNTN">Chi Nhánh Miền Trung - Tây Nguyên</option>
                    </select>
                 <?php 
                  }
                  else
                  {
                  ?>                
                  <select name="txtlocation" class="form-control" id="sel1">
                      <option value="<?php echo $location_cn ; ?>">
                        <?php
                            if($location_cn == "CNMB" || $location_cn == "cnmb")
                            {
                                echo "Chi Nhánh Miền Bắc";
                            }
                            elseif($location_cn == "CNMN" || $location_cn == "cnmn")
                            {
                                echo "Chi Nhánh Miền Nam";
                            }
                            elseif($location_cn == "CNMT" || $location_cn == "cnmt")
                            {
                                echo "Chi Nhánh Miền Tây";
                            }
                            elseif($location_cn == "CNTN" || $location_cn == "cntn")
                            {
                                echo "Chi Nhánh Miền Trung - Tây Nguyên";
                            }
                            elseif($location_cn == "CNTP" || $location_cn == "cntp")
                            {
                                echo "Chi Nhánh Tiên Phong";
                            }                            
                        ?>
                  </option>        
                  </select>
                  <?php 
              }
              ?>
                </div>
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú(nếu có) </label>
                  <input value="" type="text" name="txtnote" class="form-control" id="address" placeholder="Nhập ghi chú nếu có">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày thêm</label>
                  <input value="<?php echo $date_tl ;?>" type="date" name="txtdate" class="form-control" id="address">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="insert">Thêm phòng ban</button>
                </div>
            </div>
        </form>
        </div>
                <?php

            }
                elseif($func == "update-dept")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Cập nhật phòng ban</h2>
            </div>
            <form action='updatedept.php' method='POST'>
            <div class="panel-body">
                  <input value="<?php echo $row_dept_ud['dept_id'] ; ?>" name="txtdept_id" type="hidden" class="form-control" id="usr">
               
                <div class="form-group col-lg-6 ">
                  <label for="usr">Tên phòng ban (*)</label>
                  <input value="<?php echo $row_dept_ud['dept_name'] ; ?>" name="txtdept" type="text" class="form-control" id="usr" oninvalid="this.setCustomValidity('Tên phòng ban không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-3 ">
                  <label for="usr">Mã site (*)</label>
                  <input value="<?php echo $row_dept_ud['dept_site'] ; ?>" name="txtsite" type="text" class="form-control" id="usr" oninvalid="this.setCustomValidity('Mã site không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Vị trí phòng ban (*)</label>
                  <select name="txtlocation" class="form-control" id="sel1" oninvalid="this.setCustomValidity('Vị trí phòng ban không để trống')" oninput="setCustomValidity('')" required>
                    <option value="<?php echo $row_dept_ud['dept_location'] ; ?>">
                        <?php
                            if($row_dept_ud['dept_location'] == "CNMB")
                            {
                                echo "Chi Nhánh Miền Bắc";
                            }
                            elseif($row_dept_ud['dept_location'] == "CNMN")
                            {
                                echo "Chi Nhánh Miền Nam";
                            }
                            elseif($row_dept_ud['dept_location'] == "CNMT")
                            {
                                echo "Chi Nhánh Miền Tây";
                            }
                            elseif($row_dept_ud['dept_location'] == "CNTN")
                            {
                                echo "Chi Nhánh Miền Trung - Tây Nguyên";
                            } 
                            elseif($row_dept_ud['dept_location'] == "CNTP")
                            {
                                echo "Chi Nhánh Tiên Phong";
                            }
                            ?>
                    </option>  
                  </select>
                </div>                
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú (nếu có)</label>
                  <input value="<?php echo $row_dept_ud['Note_phongban'] ; ?>" name="txtnote" type="text" class="form-control" id="address" placeholder="Nhập ghi chú nếu có">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày cập nhật</label>
                  <input value="<?php echo $row_dept_ud['update_date'] ; ?>" name="txtdate" type="date" class="form-control" id="address">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="update">Cập nhật phòng ban</button>
                </div>             
                
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "remove-dept") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Xóa phòng ban</h2>
            </div>
            <form action='updatedept.php' method='POST' onSubmit="return confirm('Bạn muốn xóa không?')">
            <div class="panel-body">
                  <input value="<?php echo $row_dept_ud['dept_id'] ; ?>" name="txtdept_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-6">
                  <label for="usr">Tên phòng ban</label>
                  <input value="<?php echo $row_dept_ud['dept_name'] ; ?>" name="txtdept" type="text" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="usr">Mã site</label>
                  <input value="<?php echo $row_dept_ud['dept_site'] ; ?>" name="txtsite" type="text" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="email">Vị trí phòng ban</label>
                  <input value=" <?php if( $row_dept_ud['dept_location'] ==  "CNMB" )
                     {
                             echo "Chi Nhánh Miền Bắc" ; 
                     }
                    elseif ($row_dept_ud['dept_location'] ==  "CNMN")
                    {
                            echo "Chi Nhánh Miền Nam" ;
                    }
                    elseif($row_dept_ud['dept_location'] == "CNMT")
                    {
                            echo "Chi Nhánh Miền Tây";
                    }
                    elseif($row_dept_ud['dept_location'] == "CNTN")
                    {
                            echo "Chi Nhánh Miền Trung - Tây Nguyên";
                    }
                    elseif($row_dept_ud['dept_location'] == "CNTP")
                    {
                            echo "Chi Nhánh Tiên Phong";
                    }
                             ?> " name="txtlocation" type="text" class="form-control" id="usr" readonly>
                </div>                
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú</label>
                  <input value="<?php echo $row_dept_ud['Note_phongban'] ; ?>" name="txtnote" type="text" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày cập nhật</label>
                  <input value="<?php echo $row_dept_ud['update_date'] ; ?>" name="txtdate" type="date" class="form-control" id="address" readonly>
                </div>
                <div class="col-lg-12">                           
                <button class="btn btn-primary" name="delete" >Xóa phòng ban</button>
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