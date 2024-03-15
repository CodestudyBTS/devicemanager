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
$sap_id= addslashes($_POST['txtsapid']);     
$device_id = addslashes($_POST['txtmathietbi']);
$device_type = addslashes($_POST['txtdevicetype']);
$device_name_other = addslashes($_POST['txtnameprinter']);
$device_name= $device_type."-".$device_id;
if($device_type == "PC")
{
    $device_type_id = 1;
}
elseif($device_type == "LT")
{
    $device_type_id = 2;
}
elseif($device_type == "PRT")
{
    $device_type_id = 3;
}
else
{
    $device_type_id = 4;
}

$main = addslashes($_POST['txtmain']);
$cpu = addslashes($_POST['txtcpu']);
$ram = addslashes($_POST['txtram']);
$vga = addslashes($_POST['txtvga']);
$psu = addslashes($_POST['txtpsu']);
$disk1 = addslashes($_POST['txtdisk1']);
$disk2 = addslashes($_POST['txtdisk2']);
$monitor = addslashes($_POST['txtmonitor']);
$case = addslashes($_POST['txtcase']);
$dept = addslashes($_POST['txtdept']);
$user_name = addslashes($_POST['txtusr']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$device_id || !$device_type || !$dept )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
 
        
        $query_is_device_id = "SELECT device_id from device  WHERE device_id='$device_id'" ;
        $result_is_device_id = mysqli_query($connect, $query_is_device_id) ;
        $row_is_device_id = mysqli_fetch_array($result_is_device_id);
        if (is_null($row_is_device_id))      
        {   
        $query_is_device = "INSERT INTO device (sap_id, device_id, device_type , device_type_id,  device_name, device_orther_name, device_main, device_cpu, device_ram, device_vga, device_psu, device_disk1, device_disk2, device_monitor, device_case, dept, user_name, Note, device_update_date,staff_update) VALUES ('$sap_id','$device_id', '$device_type', '$device_type_id', '$device_name','$device_name_other', '$main', '$cpu', '$ram','$vga', '$psu', '$disk1', '$disk2','$monitor', '$case', '$dept', '$user_name','$note', '$date', '$staff') ";
                    if (mysqli_query($connect, $query_is_device)) 
                    {}
        $query_is_log = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thêm $device_name vào danh sách thiết bị', NOW()) ";
                    if (mysqli_query($connect, $query_is_log)) 
                    {}
                            
         }
         else
         {         	
         echo "Thiết bị đã tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";	
         }
      
                                 	
                               
header("Location: thongke_device.php");
}

elseif (isset($_POST['update']))
{

  
//Lấy dữ liệu nhập vào
$sap_id= addslashes($_POST['txtsapid']);   
$device_name= addslashes($_POST['txtdevice']);
$device_name_other = addslashes($_POST['txtnameprinter']);
$main = addslashes($_POST['txtmain']);
$cpu = addslashes($_POST['txtcpu']);
$ram = addslashes($_POST['txtmemory']);
$vga = addslashes($_POST['txtvga']);
$psu = addslashes($_POST['txtpsu']);
$disk1 = addslashes($_POST['txtdisk1']);
$disk2 = addslashes($_POST['txtdisk2']);
$monitor = addslashes($_POST['txtmonitor']);
$case = addslashes($_POST['txtcase']);
$dept = addslashes($_POST['txtdept']);
$user_name = addslashes($_POST['txtusr']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
$sl_bommuc = addslashes($_POST['txtslbommuc']);


//Get data old
$main_old = addslashes($_POST['txtmain_old']);
$cpu_old = addslashes($_POST['txtcpu_old']);
$ram_old = addslashes($_POST['txtmemory_old']);
$vga_old = addslashes($_POST['txtvga_old']);
$psu_old = addslashes($_POST['txtpsu_old']);
$disk1_old = addslashes($_POST['txtdisk1_old']);
$disk2_old = addslashes($_POST['txtdisk2_old']);
$monitor_old = addslashes($_POST['txtmonitor_old']);
$case_old = addslashes($_POST['txtcase']);
$phongban_old = addslashes($_POST['txtphongban_old']);
$nhansu_old = addslashes($_POST['txtnhansu_old']);
$sl_bommuc_old = addslashes($_POST['txtslbommuc_old']);
$date_tl=date('Y-m-d');
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$device_name )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        if($sl_bommuc_old != $sl_bommuc)
        {
            $query_ud_slbommuc = "UPDATE  device SET sl_bommuc='$sl_bommuc' WHERE device_name ='$device_name'";
                    if (mysqli_query($connect, $query_ud_slbommuc)) 
                    {}  
            $query_is_log_slbommuc = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật số lần bơm mực $main_old thành $main thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_slbommuc)) 
                    {}
        }

        if($main_old != $main && $main_old != null)
        {
            $query_is_tl_main = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$main_old', '$device_name', 'MAIN', 'sap_id', '$note', '$date_tl','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_main)) 
                    {}
            $query_is_log_main = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý main $main_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_main)) 
                    {}
            $query_is_log_main1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật main $main_old thành main $main thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_main1)) 
                    {}
        }
        if($cpu_old != $cpu && $cpu_old != null)
        {
            $query_is_tl_cpu = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$cpu_old', '$device_name','CPU', 'sap_id','$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_cpu)) 
                    {}
            $query_is_log_cpu = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý cpu $cpu_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cpu)) 
                    {}
            $query_is_log_cpu1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật cpu $cpu_old thành cpu $cpu thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cpu1)) 
                    {}
        }
        if($ram_old != $ram && $ram_old != null)
        {
            $query_is_tl_ram = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$ram_old', '$device_name','RAM', 'sap_id','$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_ram)) 
                    {}
            $query_is_log_ram = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý memory $ram_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_ram)) 
                    {}
            $query_is_log_ram1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật memory $ram_old thành memory $ram thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_ram1)) 
                    {}
        }
        if($vga_old != $vga && $vga_old != null)
        {
            $query_is_tl_vga = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$vga_old', '$device_name','VGA', 'sap_id', '$note', '$date','staff') ";
                    if (mysqli_query($connect, $query_is_tl_vga)) 
                    {}
            $query_is_log_vga = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý vga $vga_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_vga)) 
                    {}
            $query_is_log_vga1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật vga $vga_old thành vga $vga thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_vga1)) 
                    {}
        }
        if($psu_old != $psu && $psu_old != null)
        {
            $query_is_tl_psu = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$psu_old', '$device_name','PSU', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_psu)) 
            
                    {}
            $query_is_log_psu = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý nguồn $psu_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_psu)) 
                    {}
            $query_is_log_psu1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật nguồn $psu_old thành nguồn $psu thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_psu1)) 
                    {}
        }
        if($disk1_old != $disk1 && $disk1_old != null)
        {
            $query_is_tl_disk1 = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$disk1_old', '$device_name', 'DISK', 'sap_id', '$note', '$date','staff') ";
                    if (mysqli_query($connect, $query_is_tl_disk1)) 
                    {}
            $query_is_log_disk1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý ổ cứng $disk1_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_disk1)) 
                    {}
            $query_is_log_disk11 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật ổ cứng $disk1_old thành ổ cứng $disk1 thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_disk11)) 
                    {}    
        }
        if($disk2_old != $disk2 && $disk2_old != null)
        {
            $query_is_tl_disk2 = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$disk2_old', '$device_name', 'DISK', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_disk2)) 
                    {}
            $query_is_log_disk2 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý ổ cứng $disk2_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_disk2)) 
                    {}
            $query_is_log_disk21 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật ổ cứng $disk2_old thành ổ cứng $disk2 thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_disk21)) 
                    {}
        }
        if($monitor_old != $monitor && $monitor_old != null)
        {
            $query_is_tl_monitor = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$monitor_old', '$device_name', 'MONITOR', 'sap_id', '$note', '$date','staff') ";
                    if (mysqli_query($connect, $query_is_tl_monitor)) 
                    {}
            $query_is_log_monitor = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý màn hình $monitor_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_monitor)) 
                    {}
            $query_is_log_monitor1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật màn hình $monitor_old  thành màn hình $monitor thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_monitor1)) 
                    {}
        }
        if($case_old != $case && $case_old != null)
        {
            $query_is_tl_case = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$case_old', '$device_name', 'CASE', 'sap_id', '$note', '$date','staff') ";
                    if (mysqli_query($connect, $query_is_tl_case)) 
                    {}
            $query_is_log_case = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý thùng máy tính $case_old thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_case)) 
                    {}
            $query_is_log_case1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật thùng máy tính $case_old thùng máy tính $case thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_case)) 
                    {}
        }
        if($phongban_old != $dept && $phongban_old != null)
        {
            $query_dept1 = "SELECT * FROM phongban where dept_id = '$phongban_old'";
            $result_dept1= mysqli_query($connect, $query_dept1) ;  
            $row_dept1 = mysqli_fetch_array($result_dept1);
            $deptname1=$row_dept1['dept_name'];
            $query_dept2 = "SELECT * FROM phongban where dept_id = '$dept'";
            $result_dept2= mysqli_query($connect, $query_dept2) ;  
            $row_dept2 = mysqli_fetch_array($result_dept2);
            $deptname2=$row_dept2['dept_name'];
            $query_is_log_dept = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật phòng $deptname1 thành phòng $deptname2 thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_dept)) 
                    {}
        }
        if($nhansu_old != $user_name && $nhansu_old != null)
        {
            $query_is_log_user = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã cập nhật nhân sự $nhansu_old thành nhân sự $user_name thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_user)) 
                    {}
        }
 
        
        $query_ud_device = "UPDATE  device SET sap_id='$sap_id', device_main='$main', device_cpu='$cpu', device_ram='$ram',device_vga='$vga', device_psu='$psu', device_disk1='$disk1', device_disk2='$disk2', device_monitor='$monitor', device_case='$case', dept='$dept', user_name='$user_name', Note='$note', device_update_date='$date' , device_orther_name='$device_name_other', staff_update='$staff' WHERE device_name ='$device_name'";
                    if (mysqli_query($connect, $query_ud_device)) 
                    {}        
header("Location: thongke_device.php");
}
elseif (isset($_POST['delete']))
{
 //Lấy dữ liệu nhập vào
$sap_id= addslashes($_POST['txtsapid']);   
$device_name= addslashes($_POST['txtdevice']);
$main = addslashes($_POST['txtmain']);
$cpu = addslashes($_POST['txtcpu']);
$ram = addslashes($_POST['txtram']);
$vga = addslashes($_POST['txtvga']);
$psu = addslashes($_POST['txtpsu']);
$disk1 = addslashes($_POST['txtdisk1']);
$disk2 = addslashes($_POST['txtdisk2']);
$monitor = addslashes($_POST['txtmonitor']);
$case = addslashes($_POST['txtcase']);
$dept = addslashes($_POST['txtdept']);
$user_name = addslashes($_POST['txtusr']);
$note = addslashes($_POST['txtnote']);
$date = addslashes($_POST['txtdate']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$device_name )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
        if($main != null)
        {
            $query_is_tl_main = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$main', '$device_name', 'MAIN', 'sap_id', '$note', '$date_tl','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_main)) 
                    {}
            $query_is_log_main = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã main $main thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_main)) 
                    {}
        }
        if($cpu != null)
        {
            $query_is_tl_cpu = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$cpu', '$device_name', 'CPU'; 'sap_id','$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_cpu)) 
                    {}
            $query_is_log_cpu = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã cpu $cpu thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_cpu)) 
                    {}
        }
        if( $ram != null)
        {
            $query_is_tl_ram = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$ram', '$device_name', 'RAM', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_ram)) 
                    {}
            $query_is_log_ram = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã memory $ram thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_ram)) 
                    {}
        }
        if( $vga != null)
        {
            $query_is_tl_vga = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$vga', '$device_name', 'VGA', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_vga)) 
                    {}
            $query_is_log_vga = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã vga $vga thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_vga)) 
                    {}
        }
        if($psu != null)
        {
            $query_is_tl_psu = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$psu', '$device_name', 'PSU', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_psu)) 
            
                    {}
            $query_is_log_psu = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã nguồn $psu thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_psu)) 
                    {}
        }
        if($disk1 != null)
        {
            $query_is_tl_disk1 = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id,  Note, update_date,staff_update) VALUES ('$disk1', '$device_name', 'DISK', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_disk1)) 
                    {}
            $query_is_log_disk1 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã ổ cứng $disk1 thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_disk1)) 
                    {}
        }
        if($disk2 != null)
        {
            $query_is_tl_disk2 = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$disk2', '$device_name', 'DISK', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_disk2)) 
                    {}
            $query_is_log_disk2 = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã ổ cứng $disk2 thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_disk2)) 
                    {}
        }
        if($monitor != null)
        {
            $query_is_tl_monitor = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$monitor', '$device_name', 'MONITOR', 'sap_id', '$note', '$date','$staff') ";
                    if (mysqli_query($connect, $query_is_tl_monitor)) 
                    {}
            $query_is_log_monitor = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã màn hình $monitor thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_monitor)) 
                    {}
        }
        if($case != null)
        {
            $query_is_tl_case = "INSERT INTO thanhly_device (component_name, device_name, category, sap_id, Note, update_date,staff_update) VALUES ('$case', '$device_name', 'CASE', 'sap_id', '$note', '$date','staff') ";
                    if (mysqli_query($connect, $query_is_tl_case)) 
                    {}
            $query_is_log_case = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã thùng máy tính $case thuộc thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_case)) 
                    {}
        }

 
         
        $query_del_device = "DELETE FROM  device WHERE device_name ='$device_name'";
                    if (mysqli_query($connect, $query_del_device)) 
                    {}  
        $query_is_log_del_device = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã thanh lý hủy mã tài sản thiết bị $device_name', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_del_device)) 
                    {}                                   
                     
header("Location: thongke_device.php");   
                   

}
?>