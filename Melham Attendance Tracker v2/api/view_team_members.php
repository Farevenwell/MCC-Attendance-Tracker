<?php
	
    $id = (int)$_GET['id']; 

	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM team_members, team, user_acc where  team.team_id=team_members.team_name_id AND team_members.user_acc_id=user_acc.user_acc_id AND team_members.team_name_id='".$id."'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
		  $view_report = array();
		  $view_report["ID"] = $row["user_acc_id"];
          $view_report["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
		  
		  
          array_push($response['data'], $view_report);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>