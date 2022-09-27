<?php

	include("db/dbconnection.php");
	
    $id = $_POST['id'];
    $status_payment = "Denied";
    
   // sql to delete a record
   $sql = "UPDATE attended_webinar SET status_payment='$status_payment' where attend_web_id='$id'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "1";
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
?>