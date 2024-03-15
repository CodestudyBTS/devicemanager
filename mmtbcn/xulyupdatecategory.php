<?php
//Khai báo sử dụng session
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
//Kết nối tới database
include('../admin/connect.php');
$staff = $_SESSION['username'];
if (isset($_POST['insert']))
{

  
//Lấy dữ liệu nhập vào
$category_detail_name = addslashes($_POST['txtcategory_detail_name']);
$category_id = addslashes($_POST['txtcategory']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);

  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$category_detail_name || !$category_id )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        
        $query_is_category_detail = "SELECT category_detail_name from category_detail  WHERE category_detail_name='$category_detail_name'" ;
        $result_is_category_detail = mysqli_query($connect, $query_is_category_detail) ;
        $row_is_category_detail = mysqli_fetch_array($result_is_category_detail);
        if (is_null($row_is_category_detail))      
        {   
        $query_is_category_detail = "INSERT INTO category_detail (category_id,  category_detail_name , Note, category_detail_date, staff_update) VALUES ('$category_id', '$category_detail_name', '$note', '$date', '$staff') ";
                    if (mysqli_query($connect, $query_is_category_detail)) 
                    {}
        $query_is_log_category = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm danh mục chi tiết $category_detail_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_category)) 
                    {}
                            
         }
         else
         {         	
         echo "Tên linh kiện đã tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";	
         }
      
                                 	
                               
header("Location: thongke_category.php");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$category_detail_id = addslashes($_POST['txtcategory_detail_id']);    
$category_detail_name = addslashes($_POST['txtcategory_detail_name']);
$category_id = addslashes($_POST['txtcategory']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$category_detail_name || !$category_id )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        
        $query_ud_category_detail = "UPDATE  category_detail SET category_id='$category_id', category_detail_name='$category_detail_name', Note='$note', category_detail_date='$date', staff_update='$staff' WHERE category_detail_id ='$category_detail_id'";
                    if (mysqli_query($connect, $query_ud_category_detail))  
                    {}
        $query_ud_log_category = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật danh mục chi tiết $category_detail_name', NOW()) ";
                    if (mysqli_query($connect, $query_ud_log_category)) 
                    {}              
header("Location: thongke_category.php");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$category_detail_id = addslashes($_POST['txtcategory_detail_id']);    
$category_detail_name = addslashes($_POST['txtcategory_detail_name']);
$category_id = addslashes($_POST['txtcategory']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$category_detail_name || !$category_id)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
         
        $query_del_category_detail = "DELETE FROM  category_detail WHERE category_detail_id ='$category_detail_id'";
                    if (mysqli_query($connect, $query_del_category_detail)) 
                    {}  
        $query_del_log_category = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa danh mục chi tiết $category_detail_name', NOW()) ";
                    if (mysqli_query($connect, $query_del_log_category)) 
                    {}                                   
                     
header("Location: thongke_category.php");    
                   

}
?>