<?php
$connect = mysqli_connect ('127.0.0.1', 'root', '', 'itmanager') or die ('Không thể kết nối tới database');
//mysqli_set_charset($conn, 'UTF8');

if($connect === false){ 
die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
else {
//echo 'Kết nối DB thành công!';
}
?>