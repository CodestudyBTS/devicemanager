<?php
$connect_osticket = mysqli_connect ('192.168.122.19', 'osticket_user', 'Str0ngDBP@ssw0rd', 'osticket_db') or die ('Không thể kết nối tới database');
//mysqli_set_charset($conn, 'UTF8');

if($connect_osticket === false){ 
die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
else {
//echo 'Kết nối DB thành công!';
}
?>