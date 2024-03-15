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
$network_name = addslashes($_POST['txtnetworkname']);
$network_type = addslashes($_POST['txtnetworktype']);
$network_usr = addslashes($_POST['txtnetworkusr']);
$network_pass = addslashes($_POST['txtnetworkpass']);
$network_provider = addslashes($_POST['txtnetworkprovider']);
$dept_location = addslashes($_POST['txtlocation']);
$dept_name = addslashes($_POST['txtnotephongban']);
$start_date = addslashes($_POST['txtstartdate']);
$end_date = addslashes($_POST['txtenddate']);
$duration = addslashes($_POST['txtduration']);
$network_price = addslashes($_POST['txtnetworkprice']);
$network_note = addslashes($_POST['txtnetworknote']);
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$network_name|| !$network_type )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        $query_is_usr = "SELECT network_name from network  WHERE network_name='$network_name'" ;
        $result_is_usr = mysqli_query($connect, $query_is_usr) ;
        $row_is_usr = mysqli_fetch_array($result_is_usr);
        if (is_null($row_is_usr))      
        {   
        $query_is_network = "INSERT INTO network (network_name,  network_type , network_usr, network_pass, network_provider,  dept_location, dept_name, start_date, end_date, duration, network_price, network_note) VALUES ('$network_name', '$network_type', '$network_usr', '$network_pass', '$network_provider', '$dept_location', '$dept_name', '$start_date', '$end_date', '$duration', '$network_price', '$network_note') ";
                    if (mysqli_query($connect, $query_is_network)) 
                    {}
        $query_is_log_network = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm đường truyền $network_name vị trí $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network)) 
                    {}
                            
         }
         else
         {         	
         echo "Tên thông tin đường truyền đã tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";	
         }
      
                                 	
                               
header("Location: thongke_network.php");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$network_id = addslashes($_POST['txtnetwork_id']);    
$network_name = addslashes($_POST['txtnetworkname']);
$network_type = addslashes($_POST['txtnetworktype']);
$network_usr = addslashes($_POST['txtnetworkusr']);
$network_pass = addslashes($_POST['txtnetworkpass']);
$network_provider = addslashes($_POST['txtnetworkprovider']);
$dept_location = addslashes($_POST['txtlocation']);
$dept_name = addslashes($_POST['txtnotephongban']);
$start_date = addslashes($_POST['txtstartdate']);
$end_date = addslashes($_POST['txtenddate']);
$duration = addslashes($_POST['txtduration']);
$network_price = addslashes($_POST['txtnetworkprice']);
$network_note = addslashes($_POST['txtnetworknote']);
//Lấy dữ liệu nhập old    
$network_type_old = addslashes($_POST['txtnetworktype_old']);
$network_usr_old = addslashes($_POST['txtnetworkusr_old']);
$network_pass_old = addslashes($_POST['txtnetworkpass_old']);
$network_provider_old = addslashes($_POST['txtnetworkprovider_old']);
$dept_location_old = addslashes($_POST['txtlocation_old']);
$dept_name_old = addslashes($_POST['txtnotephongban_old']);
$start_date_old = addslashes($_POST['txtstartdate_old']);
$end_date_old = addslashes($_POST['txtenddate_old']);
$duration_old = addslashes($_POST['txtduration_old']);
$network_price_old = addslashes($_POST['txtnetworkprice_old']);
$network_note_old = addslashes($_POST['txtnetworknote_old']);  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$network_name|| !$network_type)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        if($network_type_old != $network_type)
        {
           $query_ud_network_type = "UPDATE  network SET network_type='$network_type' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_network_type)) 
                    {} 
            $query_is_log_network_type = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật gói cước $network_type_old thành gói $network_type của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network_type)) 
                    {}
        }
        if($network_usr_old != $network_usr)
        {
            $query_ud_network_usr = "UPDATE  network SET network_usr='$network_usr' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_network_usr)) 
                    {} 
            $query_is_log_network_usr = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật user $network_usr_old thành user $network_usr của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network_usr)) 
                    {}
        }
        if($network_pass_old != $network_pass)
        {
            $query_ud_network_pass = "UPDATE  network SET network_pass='$network_pass' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_network_pass)) 
                    {} 
            $query_is_log_network_pass = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật password $network_pass_old thành password $network_pass của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network_pass)) 
                    {}
        }
        if($network_provider_old != $network_provider)
        {
            $query_ud_network_provider = "UPDATE  network_provider SET network_provider='$network_provider' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_network_provider)) 
                    {} 
            $query_is_log_network_provider = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật nhà cung cấp $network_provider_old thành nhà cung cấp $network_provider của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network_provider)) 
                    {}
        }
        if($dept_location_old != $dept_location)
        {
            $query_ud_location = "UPDATE  network SET dept_location='$dept_location' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_location)) 
                    {} 
            $query_is_log_location = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật đơn vị $dept_location_old thành đơn vị $dept_location của đường truyền $network_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_location)) 
                    {}
        }
        if($dept_name_old != $dept_name)
        {
            $query_ud_name = "UPDATE  network SET dept_name='$dept_name' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_name)) 
                    {} 
            $query_is_log_name = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật đơn vị $dept_name_old thành đơn vị $dept_name của đường truyền $network_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_name)) 
                    {}
        }
        if($start_date_old != $start_date)
        {
            $query_ud_start_date = "UPDATE  network SET start_date='$start_date' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_start_date)) 
                    {} 
            $query_is_log_start_date = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật ngày bắt đầu đăng ký/gia hạn $start_date_old thành ngày bắt đầu đăng ký/gia hạn $start_date của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_start_date)) 
                    {}   
        }
        if($end_date_old != $end_date)
        {
            $query_ud_end_date = "UPDATE  network SET end_date='$end_date' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_end_date)) 
                    {} 
            $query_is_log_end_date = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật ngày kết thúc đăng ký/gia hạn $end_date_old thành ngày kết thúc đăng ký/gia hạn $end_date của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_end_date)) 
                    {}   
        }
        if($duration_old != $duration)
        {
            $query_ud_duration = "UPDATE network SET duration='$duration' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_duration)) 
                    {} 
            $query_is_log_duration = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật thời hạn đăng ký/gia hạn $duration_old thành thời hạn đăng ký/gia hạn $duration của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_duration)) 
                    {}   
        } 
        if($network_price_old != $network_price)
        {
            $query_ud_network_price = "UPDATE network SET network_price='$network_price' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_network_price)) 
                    {} 
            $query_is_log_network_price = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật Số tiền đăng ký/gia hạn $network_price_old thành số tiền đăng ký/gia hạn $network_price của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network_price)) 
                    {}   
        } 
        if($network_note_old != $network_note)
        {
            $query_ud_network_note = "UPDATE network SET network_note='$network_note' WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_ud_network_note)) 
                    {} 
            $query_is_log_network_note = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật ghi chú $network_note_old thành  $network_note của đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_network_note)) 
                    {}   
        }               
header("Location: thongke_network.php");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$network_id = addslashes($_POST['txtnetwork_id']);    
$network_name = addslashes($_POST['txtnetworkname']);
$network_type = addslashes($_POST['txtnetworktype']);
$network_usr = addslashes($_POST['txtnetworkusr']);
$network_pass = addslashes($_POST['txtnetworkpass']);
$network_provider = addslashes($_POST['txtnetworkprovider']);
$dept_location = addslashes($_POST['txtlocation']);
$start_date = addslashes($_POST['txtstartdate']);
$end_date = addslashes($_POST['txtenddate']);
$duration = addslashes($_POST['txtduration']);
$network_price = addslashes($_POST['txtnetworkprice']);
$network_note = addslashes($_POST['txtnetworknote']);
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$network_name || !$network_type)  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
         
        $query_del_network = "DELETE FROM  network WHERE network_id ='$network_id'";
                    if (mysqli_query($connect, $query_del_network)) 
                    {}  
        $query_del_log_network = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã xóa đường truyền $network_name của đơn vị $dept_location', NOW()) ";
                    if (mysqli_query($connect, $query_del_log_dept)) 
                    {}                                   
                     
header("Location: thongke_network.php");    
                   

}
?>