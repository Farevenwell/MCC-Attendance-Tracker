<?php

	include("db/dbconnection.php");
	
    $id = $_POST['id'];
    $Cancelled = 'Cancelled';
    
   // sql to delete a record
   $sql = "UPDATE intern_leave SET leave_status='$Cancelled' where leave_id='$id'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "1";
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
?>