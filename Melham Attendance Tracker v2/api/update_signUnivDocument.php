<?php

	include("db/dbconnection.php");
    
    if(isset($_GET['id'], $_COOKIE['user_id'])){
        
        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');
        
        $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));
        $id = $_GET["id"];
        $checkby = $_COOKIE['user_id'];
        
        $sql = "UPDATE `university_documents` SET `status` = 'Signed', `signed_by` = '$checkby', `date_signed` = '$date' WHERE `university_documents`.`document_id` = '$id'";

        if ($conn->query($sql) === TRUE)
        {
            echo '1';
        }
    }
    else{
        echo '0';
    }
    
    $conn->close();
?>