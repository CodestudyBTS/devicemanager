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
$username = addslashes($_POST['txtusr']);
$password = addslashes($_POST['txtpass']);
$pass=md5($password);
$tenhienthi = addslashes($_POST['txtdisplayname']);
$sex = addslashes($_POST['txtsex']);
$email = addslashes($_POST['txtemail']);
$location = addslashes($_POST['txtlocation']);
$admin = addslashes($_POST['txtadmin']);
$admin365 = addslashes($_POST['txtadmin_365']);
$adminrating = addslashes($_POST['txtadmin_rating']);
$adminticket = addslashes($_POST['txtadmin_ticket']);
$adminmmtb = addslashes($_POST['txtadmin_mmtb']);
$adminmmtbcn = addslashes($_POST['txtadmin_mmtb_cn']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username|| !$password )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        
        $query_is_usr = "SELECT username from member  WHERE username='$username'" ;
        $result_is_usr = mysqli_query($connect, $query_is_usr) ;
        $row_is_usr = mysqli_fetch_array($result_is_usr);
        if (is_null($row_is_usr))      
        {   
        $query_is_usr = "INSERT INTO member (username,  password , email, fullname, sex,  location, admin, admin_365, admin_rating, admin_ticket, admin_mmtb, admin_cn_mmtb) VALUES ('$username', '$pass', '$email', '$tenhienthi', '$sex',  '$location', '$admin', '$admin365', '$adminrating', '$adminticket', '$adminmmtb', '$adminmmtbcn') ";
                    if (mysqli_query($connect, $query_is_usr)) 
                    {}
        $query_is_log_usr = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm user $username vị trí $location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_usr)) 
                    {}
                            
         }
         else
         {         	
         echo "Tên user đã tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";	
         }
      
                                 	
                               
header("Location: thongke_member.php");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$user_id = addslashes($_POST['txtmember_id']);    
$username = addslashes($_POST['txtusr']);
$password = addslashes($_POST['txtpass']);
$pass=md5($password);
$tenhienthi = addslashes($_POST['txtdisplayname']);
$sex = addslashes($_POST['txtsex']);
$email = addslashes($_POST['txtemail']);
$location = addslashes($_POST['txtlocation']);
$admin = addslashes($_POST['txtadmin']);
$admin365 = addslashes($_POST['txtadmin_365']);
$adminrating = addslashes($_POST['txtadmin_rating']);
$adminticket = addslashes($_POST['txtadmin_ticket']);
$adminmmtb = addslashes($_POST['txtadmin_mmtb']);
$adminmmtbcn = addslashes($_POST['txtadmin_mmtb_cn']);

//Lấy dữ liệu nhập old    
$pass_old = addslashes($_POST['txtpass_old']);
$tenhienthi_old = addslashes($_POST['txtdisplayname_old']);
$sex_old = addslashes($_POST['txtsex_old']);
$email_old = addslashes($_POST['txtemail_old']);
$location_old = addslashes($_POST['txtlocation_old']);
$admin_old = addslashes($_POST['txtadmin_old']);
$admin365_old = addslashes($_POST['txtadmin_365_old']);
$adminrating_old = addslashes($_POST['txtadmin_rating_old']);
$adminticket_old = addslashes($_POST['txtadmin_ticket_old']);
$adminmmtb_old = addslashes($_POST['txtadmin_mmtb_old']);
$adminmmtbcn_old = addslashes($_POST['txtadmin_mmtb_cn_old']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        if($pass_old != $password)
        {
           $query_ud_pass = "UPDATE  member SET password='$pass' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_pass)) 
                    {} 
            $query_is_log_pass = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật password của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_pass)) 
                    {}
        }
        if($tenhienthi_old != $tenhienthi)
        {
            $query_ud_tenhienthi = "UPDATE  member SET fullname='$tenhienthi' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_tenhienthi)) 
                    {} 
            $query_is_log_tenhienthi = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật tên hiển thị của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_tenhienthi)) 
                    {}
        }
        if($sex_old != $sex)
        {
            $query_ud_sex = "UPDATE  member SET sex='$sex' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_sex)) 
                    {} 
            $query_is_log_sex = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật giới tính của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_sex)) 
                    {}
        }
        if($email_old != $email)
        {
            $query_ud_email = "UPDATE  member SET email='$email' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_email)) 
                    {} 
            $query_is_log_email = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật email của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_email)) 
                    {}
        }
        if($location_old != $location)
        {
            $query_ud_location = "UPDATE  member SET location='$location' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_location)) 
                    {} 
            $query_is_log_location = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật nơi làm việc của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_location)) 
                    {}
        }
        if($admin_old != $admin)
        {
            $query_ud_admin = "UPDATE  member SET admin='$admin' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_admin)) 
                    {} 
            $query_is_log_admin = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phân quyền admin global từ $admin_old thành $admin của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_admin)) 
                    {}   
        }
        if($admin365_old != $admin365)
        {
            $query_ud_admin365 = "UPDATE  member SET admin_365='$admin365' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_admin365)) 
                    {} 
            $query_is_log_admin365 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phân quyền admin365 từ $admin365_old thành $admin365 của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_admin365)) 
                    {}   
        }
        if($adminrating_old != $adminrating)
        {
            $query_ud_adminrating = "UPDATE  member SET admin_rating='$adminrating' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_adminrating)) 
                    {} 
            $query_is_log_adminrating = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phân quyền adminrating từ $adminrating_old thành $adminrating của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_adminrating)) 
                    {}   
        } 
        if($adminticket_old != $adminticket)
        {
            $query_ud_adminticket = "UPDATE  member SET admin_ticket='$adminticket' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_adminticket)) 
                    {} 
            $query_is_log_adminticket = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phân quyền adminticket từ $adminticket_old thành $adminticket của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_adminticket)) 
                    {}   
        } 
        if($adminmmtb_old != $adminmmtb)
        {
            $query_ud_adminmmtb = "UPDATE  member SET admin_mmtb='$adminmmtb' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_adminmmtb)) 
                    {} 
            $query_is_log_adminmmtb = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phân quyền admin mmtb từ $adminmmtb_old thành $adminmmtb của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_adminmmtb)) 
                    {}   
        }  
        if($adminmmtbcn_old != $adminmmtbcn)
        {
            $query_ud_adminmmtbcn = "UPDATE  member SET admin_cn_mmtb='$adminmmtbcn' WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_ud_adminmmtbcn)) 
                    {} 
            $query_is_log_adminmmtbcn = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phân quyền admin mmtb cn từ $adminmmtbcn_old thành $adminmmtbcn của user $username', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_adminmmtbcn)) 
                    {}   
        }                              
header("Location: thongke_member.php");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$user_id = addslashes($_POST['txtmember_id']);    
$username = addslashes($_POST['txtusr']);
$password = addslashes($_POST['txtpass']);
$location = addslashes($_POST['txtlocation']); 
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
         
        $query_del_member = "DELETE FROM  member WHERE id ='$user_id'";
                    if (mysqli_query($connect, $query_del_member)) 
                    {}  
        $query_del_log_dept = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa member $username vị trí $location', NOW()) ";
                    if (mysqli_query($connect, $query_del_log_dept)) 
                    {}                                   
                     
header("Location: thongke_member.php");    
                   

}
?>