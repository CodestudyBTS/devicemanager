<?php   
        session_start();
        include('../admin/ketnoi.php');
        include('../admin/connect.php');
        $func_listdata  = isset($_GET['func_listdata']) ? $_GET['func_listdata'] : '' ;
        $toyear = date("Y");           
                    
        // $result_total = mysqli_query($connect_osticket, $query_total) ;
        
        if($func_listdata == "get_total_ticket")
        {
            $dept  = isset($_GET['dept']) ? $_GET['dept'] : '' ;
            $rate  = isset($_GET['rate']) ? $_GET['rate'] : '' ;
// Columns configuration
$columns = array(
    array('db' => 'ticket_id', 'dt' => 0),
    array('db' => 'number_id', 'dt' => 1),
    array('db' => 'status_ticket', 'dt' => 2),
    array('db' => 'subject_ticket', 'dt' => 3),
    array('db' => 'user_email', 'dt' => 4),
    array('db' => 'firstname_staff', 'dt' => 5),
    array('db' => 'lastname_staff', 'dt' => 6),
    array('db' => 'email_staff', 'dt' => 7),
    array('db' => 'ticket_create', 'dt' => 8),
    array('db' => 'dept_staff', 'dt' => 9),
    // Add more columns as needed
);
// Query data 
if (empty($rate) )
{
    $query_total = "SELECT osticket_db.ost_ticket.ticket_id , osticket_db.ost_ticket.number AS number_id,  osticket_db.ost_ticket_status.state AS status_ticket, osticket_db.ost_ticket__cdata.subject AS subject_ticket, osticket_db.ost_user_email.address AS user_email, osticket_db.ost_staff.firstname AS firstname_staff, osticket_db.ost_staff.lastname AS lastname_staff, osticket_db.ost_staff.email AS email_staff, osticket_db.ost_ticket.created AS ticket_create, osticket_db.ost_department.name AS dept_staff     
        FROM osticket_db.ost_ticket 
        join osticket_db.ost_ticket__cdata on osticket_db.ost_ticket.ticket_id=osticket_db.ost_ticket__cdata.ticket_id 
        join osticket_db.ost_ticket_status on osticket_db.ost_ticket.status_id=osticket_db.ost_ticket_status.id
        join  osticket_db.ost_user_email on osticket_db.ost_ticket.user_id=osticket_db.ost_user_email.user_id
        join  osticket_db.ost_staff on osticket_db.ost_ticket.staff_id=osticket_db.ost_staff.staff_id
        join osticket_db.ost_department on osticket_db.ost_ticket.dept_id=osticket_db.ost_department.id WHERE " ; 
        $query_total .= " osticket_db.ost_department.name like '%$dept%' ";
}
else
{    
    $query_total_rated = "SELECT ticket_id from rating " ;
    $result_total_rated = mysqli_query($connect, $query_total_rated) ;
    $data_rated = array();    
    while($row_rated = mysqli_fetch_assoc($result_total_rated))
     {
             $data_rated[] = $row_rated['ticket_id'];
    }
        $rated = implode(",", $data_rated);
    $query_total = "SELECT osticket_db.ost_ticket.ticket_id , osticket_db.ost_ticket.number AS number_id,  osticket_db.ost_ticket_status.state AS status_ticket, osticket_db.ost_ticket__cdata.subject AS subject_ticket, osticket_db.ost_user_email.address AS user_email, osticket_db.ost_staff.firstname AS firstname_staff, osticket_db.ost_staff.lastname AS lastname_staff, osticket_db.ost_staff.email AS email_staff, osticket_db.ost_ticket.created AS ticket_create, osticket_db.ost_department.name AS dept_staff     
        FROM osticket_db.ost_ticket 
        join osticket_db.ost_ticket__cdata on osticket_db.ost_ticket.ticket_id=osticket_db.ost_ticket__cdata.ticket_id 
        join osticket_db.ost_ticket_status on osticket_db.ost_ticket.status_id=osticket_db.ost_ticket_status.id
        join  osticket_db.ost_user_email on osticket_db.ost_ticket.user_id=osticket_db.ost_user_email.user_id
        join  osticket_db.ost_staff on osticket_db.ost_ticket.staff_id=osticket_db.ost_staff.staff_id
        join osticket_db.ost_department on osticket_db.ost_ticket.dept_id=osticket_db.ost_department.id WHERE " ;        
        $query_total .= " osticket_db.ost_ticket.ticket_id NOT IN ($rated) ";   
        $query_total .= "AND (osticket_db.ost_department.name like '%$dept%' )";
    
}



// Filtering for search
if (!empty($_POST['search']['value'])) {
    $searchValue = $_POST['search']['value'];
    $query_total .= " AND( osticket_db.ost_ticket.ticket_id LIKE '%$searchValue%' OR osticket_db.ost_ticket.number LIKE '%$searchValue%' OR osticket_db.ost_ticket_status.state LIKE '%$searchValue%' OR osticket_db.ost_ticket__cdata.subject LIKE '%$searchValue%' OR osticket_db.ost_user_email.address LIKE '%$searchValue%' OR osticket_db.ost_staff.firstname LIKE '%$searchValue%' OR osticket_db.ost_staff.lastname LIKE '%$searchValue%' OR osticket_db.ost_staff.email LIKE '%$searchValue%' OR osticket_db.ost_ticket.created LIKE '%$searchValue%')";
}

 // Ordering list
$orderColumn = $columns[$_POST['order'][0]['column']]['db'];
$orderDir = $_POST['order'][0]['dir'];
$query_total .= " ORDER BY $orderColumn $orderDir";
// Excute query and count num_row
$result_total = mysqli_query($connect_osticket, $query_total); 
$totalData = mysqli_num_rows($result_total);
// match value totalData to totalRecords and totalFiltered to list data on datatable
$totalRecords =  $totalData;
$totalFiltered = $totalData;
// Paging
$start = $_POST['start'];
$length = $_POST['length'];
$query_total .= " LIMIT $start, $length";

// Execute the query after choice ordering and list num_row on page
$result_total = mysqli_query($connect_osticket, $query_total);
$data = array();

while ($row_total = mysqli_fetch_assoc($result_total)) {
    $data[] = $row_total;
}
// Close the database connection
mysqli_close($connect_osticket);

// Prepare the response
$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => intval($totalRecords),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
}

?>
