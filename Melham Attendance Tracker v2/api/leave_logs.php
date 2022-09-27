<?php
	
 
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM intern_leave, user_acc where intern_leave.user_acc_id=user_acc.user_acc_id  AND intern_leave.leave_status!='Pending' ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {

		  $view_leave_status = array();
		  $view_leave_status["ID"] = $row["leave_id"];
      $view_leave_status["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
      $view_leave_status["Leave Type"] = $row["leave_type"];

      $leave_from1 = $row['leave_from'];   
      $leave_from2 = date('F d, Y ', strtotime($leave_from1));

      $leave_to1 = $row['leave_to'];   
      $leave_to2 = date('F d, Y ', strtotime($leave_to1));

		  $view_leave_status["Days Leave"] = $leave_from2." to ".$leave_to2;
         

          if($row["leave_status"]=="Cancelled"  )
          {
            $view_leave_status["Status"] = "<label class='badge badge-dark'><strong>".$row["leave_status"]."</strong></label>";
          }else if($row["leave_status"]=="Approved"){
            $view_leave_status["Status"] = "<label class='badge badge-success'><strong>".$row["leave_status"]."</strong></label>";
          }else{
            $view_leave_status["Status"] = "<label class='badge badge-danger'><strong>".$row["leave_status"]."</strong></label>";
          }
		  
		  
          array_push($response['data'], $view_leave_status);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>
