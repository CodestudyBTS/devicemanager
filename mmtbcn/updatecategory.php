<?php   
        session_start();
        include('../admin/connect.php');
        if (isset($_SESSION['username']))      {
        if($_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >= 3)
        {    
        $func = isset($_GET['func']) ? $_GET['func'] : '' ;
        $category_detail_id = isset($_GET['category_detail']) ? $_GET['category_detail'] : '' ;
        $category = isset($_GET['category']) ? $_GET['category'] : '' ;
        // Get data category 
        $query_category = "SELECT * from category WHERE category_id";
        $result_category= mysqli_query($connect, $query_category) ; 
       

        // Get data category_detail
        $query_category_detail = "SELECT * from category_detail        
        join category on category_detail.category_id=category.category_id 
        WHERE category_detail_id='$category_detail_id'";
        $result_category_detail= mysqli_query($connect, $query_category_detail) ; 
        $row_category_detail = mysqli_fetch_array($result_category_detail);
           require 'xulyupdatecategory.php';               

?> 


<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../images/logo.jpg">
        <?php
        if(empty($func) ||  $func == "add-category")
        {
            echo "<title>Thêm linh kiện</title>";
        }
        elseif($func == "update-category")
        {
            echo "<title>Cập nhật linh kiện</title>";
        }
        elseif($func == "remove-category")
        {
            echo "<title>Xóa linh kiện</title>";
        }
        ?>
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
            if(empty($func) ||  $func == "add-category")
            {
                ?>
                <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm tên linh kiện </h2>
            </div>
            <form action='updatecategory.php' method='POST'>
            <div class="panel-body">
                <div class="form-group col-lg-6">
                  <label for="usr">Tên Linh kiện (*)</label>
                  <input value="" type="text" name="txtcategory_detail_name" class="form-control" id="usr" placeholder="Điền tên danh mục" oninvalid="this.setCustomValidity('Tên linh kiện không để trống')" oninput="setCustomValidity('')" required >
                </div>
                    <div class="form-group col-lg-6">
                    <label for="email">Danh mục linh kiện (*)</label>                  
                     <select name="txtcategory" class="form-control" id="sel1" oninvalid="this.setCustomValidity('Tên danh mục không để trống')" oninput="setCustomValidity('')" required>
                    <option value=""><?php echo "Chọn tên danh mục" ; ?></option> 
                    <?php
                    while($row_category = mysqli_fetch_assoc($result_category))
                    {   
                    ?>                
                      <option value="<?php echo $row_category['category_id'] ; ?>"><?php echo $row_category['category_name'] ; ?></option>
                      <?php 
                      } 
                      ?>                  
                  </select>
                </div> 
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú (nếu có) </label>
                  <input value="" type="text" name="txtnote" class="form-control" id="address" placeholder="Nhập ghi chú (nếu có)">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày thêm linh kiện</label>
                  <input value="" type="date" name="txtdate" class="form-control" id="address">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="insert">Thêm</button>
                </div>
            </div>
        </form>
        </div>
                <?php

            }
                elseif($func == "update-category")
                {

             ?>           
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Cập nhật linh kiện</h2>
            </div>
            <form action='updatecategory.php' method='POST'>
            <div class="panel-body">
                <div class="form-group">
                  <!-- <label for="usr">Tên Linh kiện:</label> -->
                  <input value="<?php echo $row_category_detail['category_detail_id'] ; ?>" name="txtcategory_detail_id" type="hidden" class="form-control" id="usr">
                </div>
                <div class="form-group col-lg-6">
                  <label for="usr">Tên Linh kiện (*) </label>
                  <input value='<?php echo $row_category_detail['category_detail_name'] ; ?>' name="txtcategory_detail_name" type="text" class="form-control" id="usr" oninvalid="this.setCustomValidity('Tên linh kiện không để trống')" oninput="setCustomValidity('')" required>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Danh mục linh kiện (*) </label>
                  <select name="txtcategory" class="form-control" id="sel1" oninvalid="this.setCustomValidity('Tên danh mục không để trống')" oninput="setCustomValidity('')" required>
                    <option value="<?php echo $row_category_detail['category_id'] ; ?>"><?php echo $row_category_detail['category_name'] ; ?></option>
                    <?php
                    while($row_category = mysqli_fetch_assoc($result_category))
                    {   
                    ?>                
                      <option value="<?php echo $row_category['category_id'] ; ?>"><?php echo $row_category['category_name'] ; ?></option>
                      <?php 
                      } 
                      ?>      
                  </select>
                </div>                
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú (nếu có)</label>
                  <input value="<?php echo $row_category_detail['Note'] ; ?>" name="txtnote" type="text" class="form-control" id="address" placeholder="Nhập ghi chú (nếu có)">
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày cập nhật linh kiện</label>
                  <input value="<?php echo $row_category_detail['category_detail_date'] ; ?>" name="txtdate" type="date" class="form-control" id="address">
                </div>
                <div class="col-lg-12">
                <button class="btn btn-primary" name="update">Cập nhật</button>   
                </div>          
                
            </div>
        </form>
        </div>
        <?php
    }
    elseif ($func == "remove-category") 
    {
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Xóa linh kiện</h2>
            </div>
            <form action='updatecategory.php' method='POST' onSubmit="return confirm('Bạn có muốn xóa không?')">
            <div class="panel-body">
                <div class="form-group">
                  <!-- <label for="usr">Tên Linh kiện:</label> -->
                  <input value="<?php echo $row_category_detail['category_detail_id'] ; ?>" name="txtcategory_detail_id" type="hidden" class="form-control" id="usr" >
                </div>
                <div class="form-group col-lg-6">
                  <label for="usr">Tên Linh kiện</label>
                  <input value="<?php echo $row_category_detail['category_detail_name'] ; ?>" name="txtcategory_detail_name" type="text" class="form-control" id="usr" readonly>
                </div>
                <div class="form-group col-lg-6">
                  <label for="email">Danh mục linh kiện</label>
                  <input value="<?php echo $row_category_detail['category_name'] ; ?>" name="txtcategory" type="text" class="form-control" id="usr" readonly>
                </div>                
                <div class="form-group col-lg-9">
                  <label for="address">Ghi chú</label>
                  <input value="<?php echo $row_category_detail['Note'] ; ?>" name="txtnote" type="text" class="form-control" id="address" readonly>
                </div>
                <div class="form-group col-lg-3">
                  <label for="address">Ngày câp nhật</label>
                  <input value="<?php echo $row_category_detail['category_detail_date'] ; ?>" name="txtdate" type="date" class="form-control" id="address" readonly>
                </div>  
                <div class="col-lg-12">                   
                <button class="btn btn-primary" name="delete" >Xóa</button>
                </div>
            </div>
        </form>
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