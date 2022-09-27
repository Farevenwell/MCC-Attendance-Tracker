<?php

	include("db/dbconnection.php");
	
    $id = $_POST['id'];
    $approved_rejected_by = $_POST['id'];
    $leave_status = "Approved";
    
   // sql to delete a record
   $sql = "UPDATE intern_leave SET leave_status='$leave_status', where leave_status='$id'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "1";
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
?>