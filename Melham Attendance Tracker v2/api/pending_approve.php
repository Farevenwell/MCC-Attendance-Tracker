<?php

	include("db/dbconnection.php");
	
    $approve = $_POST['approve'];
    $leave_status ='Approved';
   // sql to delete a record
   $sql = "UPDATE intern_leave SET leave_status='$leave_status' where leave_id='$approve'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "1";
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
?>