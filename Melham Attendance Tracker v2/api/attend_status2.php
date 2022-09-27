<?php


	include("db/dbconnection.php");
	
    if(isset($_POST['attend_status_user_id']) && isset($_POST['status_close']) && isset($_POST['event_title'])){

        $attend_status_user_id = $_POST['attend_status_user_id'];
        $status_close = $_POST['status_close'];
		$event_title = $_POST['event_title'];
        $date_closed = $_POST['date_from'];
        $date_opened = $_POST['date_to'];


		
		
	            $sql1 = "INSERT INTO attendance_status (user_acc_id, event_title, attend_status, date_closed, date_opened) VALUES ('$attend_status_user_id', '$event_title', '$status_close', '$date_closed','$date_opened')";
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
