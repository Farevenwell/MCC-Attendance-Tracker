<?php
	include("db/dbconnection.php");
	
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');

    $sql = "SELECT * FROM attendance_status WHERE attend_status = '2' LIMIT 1";
    
    $result = $conn->query($sql);
    
    if($row = $result->fetch_assoc()) 
    {
        $date = strtoupper(date('F j, Y', strtotime($row["date_opened"])));
        $time = strtoupper(date('g:i a', strtotime($row["date_opened"])));
        echo $date ." - ". $time;  
    }
    
        
$conn->close();
?>