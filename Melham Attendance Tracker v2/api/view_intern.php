<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM user_acc, intern_info where user_acc.usertype='Intern' AND intern_info.username=user_acc.username AND permission='1'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
		  $view_intern = array();
		  $view_intern["ID"] = $row["intern_info_id"];
      $view_intern["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];	  
      $view_intern["Department"] = $row["department"];
      $view_intern["Company"] = $row["company"];
      $view_intern["Status"] = $row["intern_status"];
		  
          array_push($response['data'], $view_intern);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>