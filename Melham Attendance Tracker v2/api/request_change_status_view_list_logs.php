<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM requested_intern_status, user_acc where user_acc.user_acc_id=requested_intern_status.user_acc_id AND requested_intern_status.requested_status!='request'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
          
          $sql1 = "SELECT * FROM requested_intern_status, user_acc where user_acc.user_acc_id=requested_intern_status.approved_decline_by AND requested_intern_status.requested_id='".$row["requested_id"]."' AND requested_intern_status.approved_decline_by='".$row["approved_decline_by"]."'";
          $result1 = $conn->query($sql1);
          
          while($row1 = $result1->fetch_array()) 
          {
              
              $date_requested1 = $row['date_requested'];   
              $date_requested12 = date('F d, Y ', strtotime($date_requested1));

            
    		  $view_requesting_intern = array();
    		  $view_requesting_intern["ID"] = $row["requested_id"];
              $view_requesting_intern["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
    		  $view_requesting_intern["Date"] = $date_requested12;
              $view_requesting_intern["Approved/Declined By"] = $row1["firstname"]." ".$row1["middle_name"]." ".$row1["lastname"];
    		  $view_requesting_intern["Date Approved/Declined"] =  $row['date_approved_decline'];
    		  
    		  
              array_push($response['data'], $view_requesting_intern);
          }
          

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>