<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM attendance_status, user_acc where attendance_status.user_acc_id=user_acc.user_acc_id";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
		  $view_user = array();
		  $view_user["ID"] = $row["id"];
          $view_user["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
          if($row["attend_status"] == 2)
          {
            $view_user["Action"] = '<label class="badge badge-danger">CLOSED</label>';
          }
          else
          {
            $view_user["Action"] = '<label class="badge badge-success">OPENED</label>';
          }
		  
        $date_submitted = $row['date_closed_opened'];   
        $date_submitted1 = date('F d, Y ', strtotime($date_submitted));

		  $view_user["Date"] = $date_submitted1;
		  
		  
          array_push($response['data'], $view_user);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>