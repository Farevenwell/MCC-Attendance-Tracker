<?php

	include("db/dbconnection.php");
	
    $id = $_POST['id'];
    $web_status = 1;
    
   // sql to delete a record
   $sql = "UPDATE webinar SET web_status='$web_status' where webinar_id='$id'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "1";
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
?>