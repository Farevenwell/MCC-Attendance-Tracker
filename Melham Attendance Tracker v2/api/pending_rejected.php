<?php

	include("db/dbconnection.php");
	
    $reject_id = $_POST['reject_id'];
    $leave_status ='Rejected';
   // sql to delete a record
   $sql = "UPDATE intern_leave SET leave_status='$leave_status' where leave_id='$reject_id'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "1";
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
?>