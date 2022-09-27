<?php


	include("db/dbconnection.php");
	
    if(isset($_POST['attend_status_user_id1']) && isset($_POST['status_open1']) && isset($_POST['event_title1'])){

        $attend_status_user_id = $_POST['attend_status_user_id1'];
        $status_open = $_POST['status_open1'];
		$event_title = $_POST['event_title1'];
        $now = '0';

	    $result1 = mysqli_query($conn, "SELECT MAX(id) AS id FROM attendance_status"); 
	
	    while($row1=mysqli_fetch_assoc($result1)){
		    $lastID = $row1['id'];
	    }
		
		
	            $sql1 = "UPDATE attendance_status SET user_acc_id ='$attend_status_user_id', event_title = '$event_title', attend_status = '$status_open',date_closed='0', date_opened = '0' WHERE id = '$lastID'";
				if ($conn->query($sql1) === TRUE) 
				{
					echo "1" ;			
			
				} else 
				{
					echo "0";
				}
			
        
        $conn->close();
    }

?>
