<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM smtp_gmail_guide";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {
		  $view_smtp_gmail = array();
		  $view_smtp_gmail["ID"] = $row["smtp_id"];
		  $view_smtp_gmail["SMTP GMAIL"] = $row["smtp_gmail"];
          $view_smtp_gmail["HIGHLIGHTED RANDOM LETTERS"] = $row["smtp_random"]; 
		  
		  
          array_push($response['data'], $view_smtp_gmail);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>