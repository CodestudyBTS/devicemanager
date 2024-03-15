<?php
//Khai báo sử dụng session
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
//Kết nối tới database
include('../admin/connect.php');
$staff = $_SESSION['username'];
if (isset($_POST['updaterating']))
{  
//Lấy dữ liệu nhập vào
$ticket_id = addslashes($_POST['txtticketid']);
$number_ticket = addslashes($_POST['txtnumberticket']);
$ticket_subject = addslashes($_POST['txtticketsubject']);
$rating = addslashes($_POST['txtrating']);
$rating_old = addslashes($_POST['txtrating_old']);
$dept = addslashes($_POST['txtdept']);
$teammemberemail = addslashes($_POST['txtteammemberemail']);
$ticketassigned = addslashes($_POST['txtticketassigned']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$ticket_id || !$number_ticket || !$ticket_subject || !$rating )  {
echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
} 
    $query_ud_rating = "UPDATE  rating SET ticket_id='$ticket_id', number_ticket='$number_ticket', ticket_subject='$ticket_subject', ticket_rate='$rating', ticket_dept='$dept', team_member_email='$teammemberemail', ticket_assigned='$ticketassigned' WHERE ticket_id='$ticket_id'";
                    if (mysqli_query($connect, $query_ud_rating)) 
                    {}  
    if($rating_old != $rating && $rating_old != null)
        {
            $query_is_log_rating = "INSERT INTO log_file (contain, time_excute) VALUES ('$staff đã  cập nhật đánh giá từ $rating_old thành đánh giá $rating cho ticket $number_ticket : $ticket_subject', NOW()) ";
                    if (mysqli_query($connect, $query_is_log_rating)) 
                    {}
        }                                  
header("Location: thongke.php");
}
?>