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
$dept_name = addslashes($_POST['txtdept']);
$dept_location = addslashes($_POST['txtlocation']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$dept_name || !$dept_location )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        
        $query_is_dept = "SELECT dept_name from phongban  WHERE dept_name='$dept_name'" ;
        $result_is_dept = mysqli_query($connect, $query_is_dept) ;
        $row_is_dept = mysqli_fetch_array($result_is_dept);
        if (is_null($row_is_dept))      
        {   
        $query_is_dept = "INSERT INTO phongban (dept_name,  dept_location , Note_phongban, update_date, staff_update) VALUES ('$dept_name', '$dept_location', '$note', '$date', '$staff') ";
                    if (mysqli_query($connect, $query_is_dept)) 
                    {}
        $query_is_log_dept = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm phòng $dept_name vị trí $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_dept)) 
                    {}
                            
         }
         else
         {         	
         echo "Tên phòng ban đã tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";	
         }
      
                                 	
                               
header("Location: thongke_category.php?phongban=list_dept");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$dept_id = addslashes($_POST['txtdept_id']);    
$dept_name = addslashes($_POST['txtdept']);
$dept_location = addslashes($_POST['txtlocation']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$dept_name || !$dept_location )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        
        $query_ud_dept = "UPDATE  phongban SET dept_name='$dept_name', dept_location='$dept_location', Note_phongban='$note', update_date='$date', staff_update='$staff' WHERE dept_id ='$dept_id'";
                    if (mysqli_query($connect, $query_ud_dept)) 
                    {}
                    $query_ud_log_dept = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phòng $dept_name vị trí $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_ud_log_dept)) 
                    {}               
header("Location: thongke_category.php?phongban=list_dept");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$dept_id = addslashes($_POST['txtdept_id']);    
$dept_name = addslashes($_POST['txtdept']);
$dept_location = addslashes($_POST['txtlocation']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$dept_name || !$dept_location )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
         
        $query_del_dept = "DELETE FROM  phongban WHERE dept_id ='$dept_id'";
                    if (mysqli_query($connect, $query_del_dept)) 
                    {}  
        $query_del_log_dept = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa phòng $dept_name vị trí $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_del_log_dept)) 
                    {}                                   
                     
header("Location: thongke_category.php?phongban=list_dept");    
                   

}
?>