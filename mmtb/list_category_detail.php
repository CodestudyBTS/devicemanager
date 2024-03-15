<?php       
        include('../admin/connect.php');
        $phongban = isset($_GET['phongban']) ? $_GET['phongban'] : '' ;
       $category = isset($_GET['category']) ? $_GET['category'] : '' ;  
    ?> 
<!-- count bad rating -->
<?php
if(empty($phongban) )
{

if(empty($category) )
        {
             $query_detail = "SELECT * from category_detail join category on category_detail.category_id=category.category_id   " ;   
        }
else
{
        $query_detail = "SELECT * from category_detail join category on category_detail.category_id=category.category_id WHERE category.category_id='$category' " ;
        $query_category = "SELECT * from category  WHERE category_id='$category' " ;
        $result_category = mysqli_query($connect, $query_category) ;
        $row_category = mysqli_fetch_assoc($result_category);

}

$result_detail = mysqli_query($connect, $query_detail) ;

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
                <div class="row">
                        <ol class="breadcrumb" style="margin-top: 12px;">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active"><?php
                                 if (empty($category) )
                                                        {
                                                        echo "General" ;
                                                        $cate="General";                                                        
                                                        }                                                        
                                                        else
                                                        {
                                                           echo $row_category['category_name']; 
                                                           $cate=$row_category['category_name'];   
                                                        }
                                                         ?></li>
                        </ol>
                <table id='empTable' class="display nowrap custom-tt">
  <thead>
    <tr>
      <th scope="col" style="width:25px; text-align:center;">STT</th>
      <th scope="col" style="text-align:center;">Tên linh kiện</th>
      <th scope="col" style="width:150px; text-align:center;">Danh mục</th>
      <th scope="col" style="text-align:center;">Ghi chú</th>
      <?php
      if ($_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >=3) {      
      ?>
      <th scope="col" style="width:25px">Admin </th>
      <?php
  }
  ?>

    </tr>

  </thead>
  
  <tbody>
        <?php
        $dem=1;
        while($row = mysqli_fetch_assoc($result_detail))
        {

  ?>
    <tr>
      <td style="text-align:center;"><?php echo $dem ; ?></td>
      <td><?php echo $row['category_detail_name'] ; ?></td>
      <td style="text-align:center;"><?php echo $row['category_name'] ; ?></td> 
      <td><?php echo $row['Note'] ; ?></td>     
      <?php
      if ( $_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >=3) {      
      ?>
      <td><a href="updatecategory.php?category_detail=<?php echo $row['category_detail_id']; ?>&func=update-category"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a>
        <a href="updatecategory.php?category_detail=<?php echo $row['category_detail_id']; ?>&func=remove-category"><font size="6" color="red"><i class="fa fa-trash-o"></i> </font></a>
      </td>  
      <?php
  }
  ?>
    </tr> 
    <?php
  $dem++;
}
  ?>  
  </tbody>
  
</table>
<?php
      if ( $_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >=3) { 
        if(empty($category) )
        {
      ?>
        <div> <a href="updatecategory.php" class="btn btn-primary">Thêm Linh Kiện</a></div>
<?php
        }
        else{
            ?>
        <div> <a href="updatecategory.php?category=<?php echo $category ;?>" class="btn btn-primary">Thêm Linh Kiện</a></div>
            <?php
        }
  }
  ?> 
                </div><!--/.row-->
                </div>  
<?php
}
else
{
        //echo "dang phát triênr";
        $query_dept = "SELECT * from phongban   " ;
        $result_dept = mysqli_query($connect, $query_dept) ;
        ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
                <div class="row">
                        <ol class="breadcrumb" style="margin-top:12px;">
                                <li><a href="../index.php">
                                        <em class="fa fa-home"></em>
                                </a></li>
                                <li class="active"><?php                                 
                                                        echo "Danh mục phòng ban" ;
                                                        $cate="Phòng ban";
                                                        ?>                                                        
                                                       </li>
                        </ol>
                <table id='empTable' class="display nowrap custom-tt">
  <thead>
    <tr>
      <th scope="col" style="width:25px; text-align:center;">STT</th>
      <th scope="col" style="text-align:center;">Tên phòng ban</th>
      <th scope="col" style="text-align:center;">Ghi chú</th>
      <th scope="col" style="width:300px; text-align:center;">Vị trí</th>
      <?php
      if ($_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >= 3) {      
      ?>
      <th scope="col" style="width:25px; text-align:center;">Admin </th>
      <?php
  }
  ?>
    </tr>
  </thead>
  
  <tbody>
        <?php
        $dem=1;
        while($row_dept = mysqli_fetch_assoc($result_dept))
        {

  ?>
    <tr>
      <td style="text-align:center;"><?php echo $dem ; ?></td>
      <td ><?php echo $row_dept['dept_name'] ; ?></td>
      <td><?php echo $row_dept['Note_phongban'] ; ?></td>
      <td style="text-align:center;"><?php if( $row_dept['dept_location'] ==  "cty" )
      {
        echo "Tổng Công Ty" ; 
      }
      elseif ($row_dept['dept_location'] ==  "tienphong")
      {
        echo "CN Tiên Phong" ;
      }
       ?></td>
      <?php
      if ( $_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >=3) {      
      ?>
      <td><a href="updatedept.php?dept=<?php echo $row_dept['dept_id']; ?>&func=update-dept"><font size="6" color="green"><i class="fa fa-pencil-square"></i> </font></a>
        <a href="updatedept.php?dept=<?php echo $row_dept['dept_id']; ?>&func=remove-dept"><font size="6" color="red"><i class="fa fa-trash-o"></i> </font></a>
      </td>  
      <?php
  }
  ?>
    </tr> 
    <?php
  $dem++;
}
  ?>  
  </tbody>
  
</table>
<?php
      if ( $_SESSION['admin_mmtb'] >= 2 || $_SESSION['admin'] >=3) {      
      ?>
<div> <a href="updatedept.php" class="btn btn-primary">Thêm Phòng Ban</a></div>
<?php
  }
  ?> 
                </div><!--/.row-->
                </div>  







<?php
}
?>
<!-- Script -->
        <script>
            var cates = "<?php echo $cate; ?>";
        $(document).ready(function(){
            var empDataTable = $('#empTable').DataTable({                        
                dom: 'Blfrtip',   
                oLanguage: {
                    "sSearch": "Tìm kiếm:"
                },
                language: {
                    "lengthMenu": "Hiển thị _MENU_ dòng trên trang",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "info": "Hiển thị trang _PAGE_ trên _PAGES_ trang",
                    "infoEmpty": "Không có kết quản khả dụng",
                    'paginate': {
                        'previous': "Trang trước",
                        'next': "Trang sau"
                    }
                },             
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: 'Xuất dữ liệu danh mục ' + cates ,
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Xuất dữ liệu danh mục ' + cates ,
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                                columns: ':visible',
                                
                           // columns: [0,1] // Column index which needs to export
                        }
                    },
                    {
                        extend: 'csv',
                        title: 'Xuất dữ liệu danh mục ' + cates ,
                    },
                    {
                        extend: 'excel',
                        title: 'Xuất dữ liệu danh mục ' + cates ,
                    }         
                ] ,                 
            lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
            });

        });
        </script>            

        </div>  <!--/.main-->