<?php
	
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM webinar";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      $response['data'] = array();
      // output data of each row
      
      while($row = $result->fetch_array()) {

        $meeting_date = $row['meeting_date'];   
        $meeting_date1 = date('F d, Y ', strtotime($meeting_date));

		  $view_webinar = array();
		  $view_webinar["ID"] = $row["webinar_id"];
      $view_webinar["Title"] = $row["title_name"];
		  $view_webinar["Speaker"] = $row["speaker"];
		  $view_webinar["Date"] = $meeting_date1;
      $view_webinar["Fee"] = $row["registration_fee"];
      $view_webinar["web_status"] = $row["web_status"];

		  
		  
          array_push($response['data'], $view_webinar);

          
	  }
      echo json_encode($response);
     
      
    } else {
      echo json_encode(array('data'=>''));
    }
    $conn->close();
?>