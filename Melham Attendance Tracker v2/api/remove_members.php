<?php

	include("db/dbconnection.php");
	
    $id = $_POST['id'];
    $position = 0;
    
   // sql to delete a record
   

        $sql =  "UPDATE user_acc SET position='$position' where user_acc_id='$id'";
       
		
		if ($conn->query($sql) === TRUE) {

			$sql1 = "DELETE FROM team_members WHERE user_acc_id = '$id'";
    
            
            if ($conn->query($sql1) === TRUE) {
                echo "1";
            }
            else {
            echo "0";
            }
		}
		
     
    
    $conn->close();
?>	