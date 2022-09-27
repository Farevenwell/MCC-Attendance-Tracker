<?php

	$user_acc_id = $_GET['id']; 


	include("db/dbconnection.php");

    
    $sql = "SELECT * FROM user_acc, university_documents where user_acc.user_acc_id=university_documents.user_acc_id AND user_acc.user_acc_id='".$user_acc_id."' AND university_documents.user_acc_id='".$user_acc_id."'";

    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {

      

      $response['data'] = array();

      // output data of each row

      

      while($row = $result->fetch_array()) {

        $date_submitted = $row['date_submitted'];   

        $date_submitted1 = date('F d, Y ', strtotime($date_submitted));

        $deadline = $row['deadline'];   

        $deadline1 = date('F d, Y ', strtotime($deadline));



		  $view_project = array();

		  $view_project["ID"] = $row["document_id"];

          $view_project["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

          $view_project["Document"] = $row["document_title"];

          $view_project["Deadline"] = $deadline1;

          $view_project["Date Submitted"] = $date_submitted1;

          $view_project["File Format"] = $row["file_format"];
          
          $view_project["OJT Name"] = $row["coordinator_name"];
          
          $view_project["OJT Email"] = $row["coordinator_email"];
          

          $view_project["G-Drive Link"] = "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>"; 

          
          if($row["status"] == "Pending"){
                  $view_project["Status"] =  "<label class='badge badge-danger'>Pending</label>";
          }else{
                  $view_project["Status"] =  "<label class='badge badge-info'>Signed</label>";
          }
          
          $view_project["Signed By"] = $row["signed_by"];
          
          $view_project["Date Signed"] = $row["date_signed"];


		
          array_push($response['data'], $view_project);



          

	  }

      echo json_encode($response);

     

      

    } else {

      echo json_encode(array('data'=>''));

    }

    $conn->close();

?>