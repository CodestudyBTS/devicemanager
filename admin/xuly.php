<?php
//Khai báo sử dụng session
session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
//Kết nối tới database
include('connect.php');
if (isset($_POST['dangnhap']))
{

  
//Lấy dữ liệu nhập vào
$username = addslashes($_POST['txtUsername']);
$username = str_replace("'" , "\'"  , $username);
$username = str_replace('"' ,   '\"' , $username);
$password = addslashes($_POST['txtPassword']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password) {
echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
  
// mã hóa pasword
$password = md5($password);
  
//Kiểm tra tên đăng nhập có tồn tại không
$query = "SELECT * FROM member WHERE username='$username'"  ;

$result = mysqli_query($connect, $query) or die( mysqli_error($connect));

if (!$result) {
echo "Tên đăng nhập hoặc mật khẩu không tồn tại!";
} 
  
//Lấy mật khẩu trong database ra
$row = mysqli_fetch_array($result);
  
if ($password != $row['password']) {
echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}
  
//Lưu tên đăng nhập
$_SESSION['admin'] = $row['admin'];
$_SESSION['admin365'] = $row['admin_365'];
$_SESSION['adminticket'] = $row['admin_ticket'];
$_SESSION['admin_rating'] = $row['admin_rating'];
$_SESSION['admin_mmtb'] = $row['admin_mmtb'];
$_SESSION['admin_cn_mmtb'] = $row['admin_cn_mmtb'];
$_SESSION['username'] = $row['fullname'];
$_SESSION['gioitinh'] = $row['sex'];
$_SESSION['email'] = $row['email'];
$_SESSION['staff_location'] = $row['location'];

//update date login
date_default_timezone_set('Asia/Ho_Chi_Minh');
$currentDateTime = date('d-m-Y H:i:s');
$query_ud_date_usr = "UPDATE  member SET date_login='$currentDateTime' WHERE username='$username'";
                    if (mysqli_query($connect, $query_ud_date_usr)) 
                    {} 
header("Location: ../index.php");

//echo "Xin chào <b>" .$username . "</b>. Bạn đã đăng nhập thành công. <a href=''>Thoát</a>";
//die();
//$connect->close();

}
?>