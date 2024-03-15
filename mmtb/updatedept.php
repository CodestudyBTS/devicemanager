<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))
        {
        if($_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >=3)      {    
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $dept_id = isset($_GET['dept']) ? $_GET['dept'] : '' ;
        $date_tl=date('Y-m-d');
        // Get data category 
        $query_dept = "SELECT * from phongban " ;
        $result_dept= mysqli_query($connect, $query_dept) ; 
        // $row_dept = mysqli_fetch_array($result_dept);

        //Get data category_detail
        $query_dept_ud = "SELECT * from phongban WHERE dept_id='$dept_id'";
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
                  <input value="" type="text" name="txtdept" class="form-control" id="usr" placeholder="Điền tên phòng ban" oninvalid="this.setCustomValidity('Tên phòng ban không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Vị trí phòng ban (*)</label>                  
                  <select name="txtlocation" class="form-control" id="sel1" oninvalid="this.setCustomValidity('Vị trí phòng ban không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn tên địa điểm" ; ?></option>                                   
                      <option value="cty">Tổng công ty</option>
                      <option value="tienphong">CN Tiên Phong</option>                 
                  </select>
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
                  <input value="<?php echo $row_dept_ud['dept_name'] ; ?>" name="txtdept" type="text" class="form-control" id="usr" oninvalid="this.setCustomValidity('Tên phòng không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Vị trí phòng ban (*)</label>
                  <select name="txtlocation" class="form-control" id="sel1" oninvalid="this.setCustomValidity('Vị trí phòng ban không để trống')" oninput="setCustomValidity('')" required>
                    <option value="<?php echo $row_dept_ud['dept_location'] ; ?>"><?php 
                    if( $row_dept_ud['dept_location'] ==  "cty" )
                     {
                             echo "Tổng Công Ty" ; 
                     }
                    elseif ($row_dept_ud['dept_location'] ==  "tienphong")
                    {
                            echo "CN Tiên Phong" ;
                    } ?>
                    </option>
                    <option value="cty">Tổng công ty</option>
                    <option value="tienphong">CN Tiên Phong</option>    
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
            <form action='updatedept.php' method='POST' onSubmit="return confirm('Bạn muốn xóa phòng ban không?')">
            <div class="panel-body">
                  <input value="<?php echo $row_dept_ud['dept_id'] ; ?>" name="txtdept_id" type="hidden" class="form-control" id="usr">
                <div class="form-group col-lg-6">
                  <label for="usr">Tên phòng ban (*)</label>
                  <input value="<?php echo $row_dept_ud['dept_name'] ; ?>" name="txtdept" type="text" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Vị trí phòng ban (*)</label>
                  <input value=" <?php if( $row_dept_ud['dept_location'] ==  "cty" )
                     {
                             echo "Tổng Công Ty" ; 
                     }
                    elseif ($row_dept_ud['dept_location'] ==  "tienphong")
                    {
                            echo "CN Tiên Phong" ;
                    } ?>" 
                    name="txtlocation" type="text" class="form-control" id="usr" readonly>
                </div>                
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú</label>
                  <input value="<?php echo $row_dept_ud['Note_phongban'] ; ?>" name="txtnote" type="text" class="form-control" id="address">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày cập nhật</label>
                  <input value="<?php echo $row_dept_ud['update_date'] ; ?>" name="txtdate" type="date" class="form-control" id="address">
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
else
{
     header("Location: ../index.php");
}
}
else
{
    header("Location: ../admin/login.php");
}