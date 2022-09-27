<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM intern_leave, user_acc where intern_leave.user_acc_id=user_acc.user_acc_id AND intern_leave.leave_status='Pending'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
          $view_intern_leave = array();
          $view_intern_leave["ID"] = $row["leave_id"];
          $view_intern_leave["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
          $view_intern_leave["Leave Type"] = $row["leave_type"];

          $leave_from1 = $row['leave_from'];   
          $leave_from2 = date('F d, Y ', strtotime($leave_from1));

          $leave_to1 = $row['leave_to'];   
          $leave_to2 = date('F d, Y ', strtotime($leave_to1));

          $view_intern_leave["Days Leave"] = $leave_from2." to ".$leave_to2;
		  
          array_push($response['data'], $view_intern_leave);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>