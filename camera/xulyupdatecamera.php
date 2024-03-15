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
$cam_daughi = addslashes($_POST['txtdaughiname']);
$cam_name = addslashes($_POST['txtcameraname']);
$cam_soluong = addslashes($_POST['txtslcamera']);
$cam_provider = addslashes($_POST['txtcameraprovider']);
$cam_disk = addslashes($_POST['txtcameradisk']);
$cam_user = addslashes($_POST['txtcamerausr']);
$cam_pass = addslashes($_POST['txtcamerapass']);
$cam_domain = addslashes($_POST['txtcameradomain']);
$cam_dept_name = addslashes($_POST['txtnotephongban']);
$cam_dept_location = addslashes($_POST['txtlocation']);
$cam_port_media = addslashes($_POST['txtportmedia']);
$cam_port_web = addslashes($_POST['txtportweb']);
$cam_update = addslashes($_POST['txtupdatedate']);
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$cam_daughi|| !$cam_name || !$cam_dept_name)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        $query_is_usr = "SELECT cam_dept_name from camera  WHERE cam_dept_name='$cam_dept_name'" ;
        $result_is_usr = mysqli_query($connect, $query_is_usr) ;
        $row_is_usr = mysqli_fetch_array($result_is_usr);
        if (is_null($row_is_usr))      
        {   
        $query_is_camera = "INSERT INTO camera (ten_daughi,  ten_camera , sl_camera, ten_thuonghieu, camera_disk, username_cam, password_cam, domain_cam, cam_dept_name, cam_dept_location, port_media, port_http, update_date) VALUES ('$cam_daughi', '$cam_name', '$cam_soluong', '$cam_provider', '$cam_disk', '$cam_user', '$cam_pass', '$cam_domain', '$cam_dept_name', '$cam_dept_location', '$cam_port_media', '$cam_port_web', '$cam_update') ";
                    if (mysqli_query($connect, $query_is_camera)) 
                    {}
        $query_is_log_camera = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm hệ thống camera của đơn vị $cam_dept_name vị trí $cam_dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_camera)) 
                    {}
                            
         }
         else
         {          
         echo "Thông tin hệ thống đã được cập nhật cho đơn vị. <a href='javascript: history.go(-1)'>Trở lại</a>";   
         }
      
                                    
                               
header("Location: thongke_camera.php");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$camera_id = addslashes($_POST['txtcamera_id']);     
$cam_daughi = addslashes($_POST['txtdaughiname']);
$cam_name = addslashes($_POST['txtcameraname']);
$cam_soluong = addslashes($_POST['txtslcamera']);
$cam_provider = addslashes($_POST['txtcameraprovider']);
$cam_disk = addslashes($_POST['txtcameradisk']);
$cam_disk_old = addslashes($_POST['txtcameradisk_old']);
$cam_user = addslashes($_POST['txtcamerausr']);
$cam_pass = addslashes($_POST['txtcamerapass']);
$cam_domain = addslashes($_POST['txtcameradomain']);
$cam_dept_name = addslashes($_POST['txtnotephongban']);
$cam_dept_location = addslashes($_POST['txtlocation']);
$cam_port_media = addslashes($_POST['txtportmedia']);
$cam_port_web = addslashes($_POST['txtportweb']);
$cam_update = addslashes($_POST['txtupdatedate']);

//Lấy dữ liệu nhập old    
$cam_daughi_old = addslashes($_POST['txtdaughiname_old']);
$cam_name_old = addslashes($_POST['txtcameraname_old']);
$cam_soluong_old = addslashes($_POST['txtslcamera_old']);
$cam_provider_old = addslashes($_POST['txtcameraprovider_old']);
$cam_user_old = addslashes($_POST['txtcamerausr_old']);
$cam_pass_old = addslashes($_POST['txtcamerapass_old']);
$cam_domain_old = addslashes($_POST['txtcameradomain_old']);
$cam_dept_name_old = addslashes($_POST['txtnotephongban_old']);
$cam_dept_location_old = addslashes($_POST['txtlocation_old']);
$cam_port_media_old = addslashes($_POST['txtportmedia_old']);
$cam_port_web_old = addslashes($_POST['txtportweb_old']);
$cam_update_old = addslashes($_POST['txtupdatedate_old']);
//Kiểm tra đã nhập đủ thông tin dầu ghi, camera và đơn vị sử dụng
if (!$cam_daughi|| !$cam_name || !$cam_dept_name)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        if($cam_daughi_old != $cam_daughi)
        {
           $query_ud_cam_daughi = "UPDATE camera SET ten_daughi ='$cam_daughi' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_daughi)) 
                    {} 
            $query_is_log_cam_daughi = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật tên đầu ghi $cam_daughi_old thành tên đầu ghi $cam_daughi của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_daughi)) 
                    {}
        }
        if($cam_name_old != $cam_name)
        {
            $query_ud_cam_name = "UPDATE  camera SET  ten_camera='$cam_name' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_name)) 
                    {} 
            $query_is_log_cam_name = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật tên camera $cam_name_old thành tên camera $cam_name của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_name)) 
                    {}
        }
        if($cam_soluong_old != $cam_soluong)
        {
            $query_ud_cam_soluong = "UPDATE  camera SET sl_camera='$cam_soluong' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_soluong)) 
                    {} 
            $query_is_log_cam_soluong = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật số lượng $cam_soluong_old thành số lượng $cam_soluong của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_soluong)) 
                    {}
        }
        if($cam_provider_old != $cam_provider)
        {
            $query_ud_cam_provider = "UPDATE  camera SET ten_thuonghieu='$cam_provider' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_provider)) 
                    {} 
            $query_is_log_cam_provider = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật thương hiệu $cam_provider_old thành thương hiệu $cam_provider của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_provider)) 
                    {}
        }
        if($cam_disk_old != $cam_disk)
        {
            $query_ud_cam_disk = "UPDATE  camera SET camera_disk='$cam_disk' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_disk)) 
                    {} 
            $query_is_log_cam_disk = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật dung lượng lưu trữ $cam_disk_old thành dung lượng lưu trữ $cam_disk của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_disk)) 
                    {}
        }
        if($cam_user_old != $cam_user)
        {
            $query_ud_cam_user = "UPDATE  camera SET username_cam='$cam_user' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_user)) 
                    {} 
            $query_is_log_cam_user = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật tên đăng nhập $cam_user_old thành tên đăng nhập $cam_user của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_user)) 
                    {}
        }
        if($cam_pass_old != $cam_pass)
        {
            $query_ud_cam_pass = "UPDATE  camera SET password_cam='$cam_pass' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_pass)) 
                    {} 
            $query_is_log_cam_pass = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật password camera $cam_pass_old thành password camera $cam_pass của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_pass)) 
                    {}
        }
        if($cam_domain_old != $cam_domain)
        {
            $query_ud_cam_domain = "UPDATE  camera SET domain_cam='$cam_domain' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_domain)) 
                    {} 
            $query_is_log_cam_domain = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật domain/ip $cam_domain_old thành domain/ip $cam_domain của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_domain)) 
                    {}   
        }
        if($cam_dept_name_old != $cam_dept_name)
        {
            $query_ud_cam_dept_name = "UPDATE  camera SET cam_dept_name='$cam_dept_name' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_dept_name)) 
                    {} 
            $query_is_log_cam_dept_name = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật đơn vị sử dụng $cam_dept_name_old thành $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_dept_name)) 
                    {}   
        }
        if($cam_dept_location_old != $cam_dept_location)
        {
            $query_ud_cam_dept_location = "UPDATE camera SET cam_dept_location='$cam_dept_location' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_dept_location)) 
                    {} 
            $query_is_log_cam_dept_location = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật địa điểm camera $cam_dept_location_old thành địa điểm $cam_dept_location của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cam_dept_location)) 
                    {}   
        } 
        if($cam_port_media_old != $cam_port_media)
        {
            $query_ud_cam_port_media = "UPDATE camera SET port_media='$cam_port_media' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_port_media)) 
                    {} 
            $query_is_log_cam_port_media = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật port media $cam_port_media_old thành port media $cam_port_media của đơn vị $cam_dept_name', NOW()) "; 
                    if (mysqli_query($connect, $query_is_log_cam_port_media)) 
                    {} 
        } 
        if($cam_port_web_old != $cam_port_web)
        {
            $query_ud_cam_port_web = "UPDATE camera SET port_http='$cam_port_web' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_port_web)) 
                    {} 
            $query_is_log_cam_port_web = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật port web $cam_port_web_old thành port web $cam_port_web của đơn vị $cam_dept_name', NOW()) "; 
                    if (mysqli_query($connect, $query_is_log_cam_port_web)) 
                    {}    
        }
        if($cam_update_old != $cam_update)
        {
            $query_ud_cam_update = "UPDATE camera SET update_date='$cam_update' WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_ud_cam_update)) 
                    {} 
            $query_is_log_cam_update = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật port web $cam_update_old thành port web $cam_update của đơn vị $cam_dept_name', NOW()) "; 
                    if (mysqli_query($connect, $query_is_log_cam_update)) 
                    {} 
        }  


header("Location: thongke_camera.php");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$camera_id = addslashes($_POST['txtcamera_id']);     
$cam_daughi = addslashes($_POST['txtdaughiname']);
$cam_name = addslashes($_POST['txtcameraname']);
$cam_soluong = addslashes($_POST['txtslcamera']);
$cam_provider = addslashes($_POST['txtcameraprovider']);
$cam_disk = addslashes($_POST['txtcameradisk']);
$cam_user = addslashes($_POST['txtcamerausr']);
$cam_pass = addslashes($_POST['txtcamerapass']);
$cam_domain = addslashes($_POST['txtcameradomain']);
$cam_dept_name = addslashes($_POST['txtnotephongban']);
$cam_dept_location = addslashes($_POST['txtlocation']);
$cam_port_media = addslashes($_POST['txtportmedia']);
$cam_port_web = addslashes($_POST['txtportweb']);
$cam_update = addslashes($_POST['txtupdatedate']);
//Kiểm tra đã nhập đủ thông tin dầu ghi, camera và đơn vị sử dụng
if (!$cam_daughi|| !$cam_name || !$cam_dept_name)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
         
        $query_del_camera = "DELETE FROM  camera WHERE camera_id ='$camera_id'";
                    if (mysqli_query($connect, $query_del_camera)) 
                    {}  
        $query_del_log_camera = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa hệ thống $camera_name của đơn vị $cam_dept_name', NOW()) ";
                    if (mysqli_query($connect, $query_del_log_dept)) 
                    {}                                   
                     
header("Location: thongke_camera.php");    
                   

}
?>