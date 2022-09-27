<?php

	include("db/dbconnection.php");
	
    $team_id = $_POST['team_name_id'];
    $members_id = $_POST['mem_id'];

    
    $position = 3;
    
   // sql to delete a record
   $sql1 = "INSERT INTO team_members (team_name_id, user_acc_id) VALUES ('$team_id', '$members_id')";
   if ($conn->query($sql1) === TRUE) 
   {
     $sql = "UPDATE user_acc SET position='$position' where user_acc_id='$members_id'";

                   if ($conn->query($sql) === TRUE) {
                   echo "1";
                   } else {
                   echo "0";
                   }			
 
   } else 
   {
     echo "0";
   }
     
    
    $conn->close();
?>