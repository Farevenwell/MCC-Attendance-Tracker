<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM requested_intern_status, user_acc where user_acc.user_acc_id=requested_intern_status.user_acc_id AND requested_intern_status.requested_status='request'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
          
          $date_requested1 = $row['date_requested'];   
          $date_requested12 = date('F d, Y ', strtotime($date_requested1));
        
		  $view_requesting_intern = array();
		  $view_requesting_intern["ID"] = $row["requested_id"];
          $view_requesting_intern["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
		  $view_requesting_intern["Date"] = $date_requested12;
		  
		  
          array_push($response['data'], $view_requesting_intern);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>