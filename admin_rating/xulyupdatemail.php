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
$username = addslashes($_POST['txtUsername']);
$mail = addslashes($_POST['txtmail']);
$tenhienthi = addslashes($_POST['txttenhienthi']);
$type = addslashes($_POST['txttype']);
$license = addslashes($_POST['txtlicense']);
$donvi = addslashes($_POST['txtdonvi']);
$cncuthe = addslashes($_POST['txtcncuthe']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$mail || !$tenhienthi)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        if ($mail == "bitis.com.vn" || $mail == "bitis.com" || $mail == "hoaanhphat.vn") 
        {
        $query_is_365 = "SELECT Username from mail_office365 WHERE Username='$username'" ;
        $result_is_365 = mysqli_query($connect, $query_is_365) ;
        $row_is_365 = mysqli_fetch_array($result_is_365);
        if (is_null($row_is_365))      
        {   
        $query_is_office365 = "INSERT INTO mail_office365 (Username, Mail, TenHienThi, Type, License, DonVi, CNcuthe, Note, NgayCapNhat) VALUES ('$username', '$mail', '$tenhienthi','$type', '$license', '$donvi', '$cncuthe', '$note', '$date') ";
                    if (mysqli_query($connect, $query_is_office365)) 
                    {}
        $query_is_log_365 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm email $username@$mail vào danh sách email office 365', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_365)) 
                    {}
                            
         }
         else
         {         	
         header("Location: /updatemail.php?mail=<?php echo $mail; ?>&username=<?php echo $username ; ?>");	
         }
                    }
      
      elseif ($mail == "bitisgroup.vn") 
        {
        $query_is_gr = "SELECT Username from mail_bitisgroup WHERE Username='$username'" ;
        $result_is_gr = mysqli_query($connect, $query_is_gr) ;
        $row_is_gr = mysqli_fetch_array($result_is_gr);
        if (is_null($row_is_gr))      
        {   
        $query_is_officegr = "INSERT INTO mail_bitisgroup (Username, Mail, TenHienThi, Type, License, DonVi, CNcuthe, Note, NgayCapNhat) VALUES ('$username', '$mail', '$tenhienthi','$type', '$license', '$donvi', '$cncuthe', '$note', '$date') ";
                    if (mysqli_query($connect, $query_is_officegr)) 
                    {} 
        $query_is_log_gr = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm email $username@$mail vào danh sách email bitisgroup.vn', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_gr)) 
                    {}                           
                    }                    
         else
         {         	
         header("Location: /updatemail.php?mail=<?php echo $mail; ?>&username=<?php echo $username ; ?>");	
         }
     }                            	
                               
header("Location: office365.php");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$username = addslashes($_POST['txtUsername']);
$mail = addslashes($_POST['txtmail']);
$tenhienthi = addslashes($_POST['txttenhienthi']);
$type = addslashes($_POST['txttype']);
$license = addslashes($_POST['txtlicense']);
$donvi = addslashes($_POST['txtdonvi']);
$cncuthe = addslashes($_POST['txtcncuthe']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$mail || !$tenhienthi)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        if ($mail == "bitis.com.vn") 
        {
          
        //$query_is_office365 = "INSERT INTO mail_office365 (Username, Mail, TenHienThi, Type, License, DonVi, CNcuthe, Note, NgayCapNhat) VALUES ('$username', '$mail', '$tenhienthi','$type', '$license', '$donvi', '$cncuthe', '$note', '$date') ";
        $query_ud_office365 = "UPDATE  mail_office365 SET Username='$username', Mail='$mail', TenHienThi='$tenhienthi', Type='$type', License='$license', DonVi='$donvi', CNcuthe='$cncuthe', Note='$note', NgayCapNhat='$date' WHERE Username='$username'";
                    if (mysqli_query($connect, $query_ud_office365)) 
                    {}  
        $query_is_log_365 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật thông tin email $username@$mail vào danh sách email office 365', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_365)) 
                    {}                         
         
                    }
      
      elseif ($mail == "bitisgroup.vn") 
        {
        
        //$query_is_officegr = "INSERT INTO mail_bitisgroup (Username, Mail, TenHienThi, Type, License, DonVi, CNcuthe, Note, NgayCapNhat) VALUES ('$username', '$mail', '$tenhienthi','$type', '$license', '$donvi', '$cncuthe', '$note', '$date') ";
        $query_ud_gr = "UPDATE  mail_bitisgroup SET Username='$username', Mail='$mail', TenHienThi='$tenhienthi', Type='$type', License='$license', DonVi='$donvi', CNcuthe='$cncuthe', Note='$note', NgayCapNhat='$date' WHERE Username='$username'";
                    if (mysqli_query($connect, $query_ud_gr)) 
                    {}  
        $query_is_log_gr = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm email $username@$mail vào danh sách email bitisgroup.vn', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_gr)) 
                    {}                          
                    }                
                     
header("Location: office365.php");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$username = addslashes($_POST['txtUsername']);
$mail = addslashes($_POST['txtmail']);
$tenhienthi = addslashes($_POST['txttenhienthi']);
$type = addslashes($_POST['txttype']);
$license = addslashes($_POST['txtlicense']);
$donvi = addslashes($_POST['txtdonvi']);
$cncuthe = addslashes($_POST['txtcncuthe']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$mail || !$tenhienthi)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        if ($mail == "bitis.com.vn") 
        {
        $query_del_office365 = "DELETE FROM  mail_office365 WHERE Username='$username'";
                    if (mysqli_query($connect, $query_del_office365)) 
                    {}       
        $query_is_log_365 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa email $username@$mail vào danh sách email office 365', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_365)) 
                    {}                    
         
                    }
      
      elseif ($mail == "bitisgroup.vn") 
        {      
        $query_del_gr = "DELETE FROM  mail_bitisgroup WHERE Username='$username'";
                    if (mysqli_query($connect, $query_del_gr)) 
                    {}  
        $query_is_log_gr = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa email $username@$mail vào danh sách email bitisgroup.vn', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_gr)) 
                    {}                          
                    }                
                     
header("Location: office365.php");    
                   

}
?>