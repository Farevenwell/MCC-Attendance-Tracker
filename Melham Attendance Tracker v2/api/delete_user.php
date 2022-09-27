<?php

	include("db/dbconnection.php");
	
    $id = $_POST['id'];
    
    
   // sql to delete a record
    $sql = "DELETE FROM user_acc WHERE 	user_acc_id = '$id'";
    
		
		if ($conn->query($sql) === TRUE) {
			echo "ACCOUNT USER SUCCESSFULLY DELETED";
		}
		else {
		  echo "Error deleting record: " . $conn->error;
		}
     
    
    $conn->close();
?>