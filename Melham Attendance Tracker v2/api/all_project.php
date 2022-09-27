<?php

	

	include("db/dbconnection.php");

    

    $sql = "SELECT * FROM user_acc, intern_info where user_acc.username=intern_info.username AND user_acc.usertype='Intern' AND user_acc.permission='1'";

    

    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {

      

      $response['data'] = array();
      	
      while($row = $result->fetch_array()) {

		  $all_project = array();
		  
          $sql1 = "SELECT status FROM project WHERE status = 'To be check' AND user_acc_id = '".$row["user_acc_id"]."'"; 
          
          $result1 = $conn->query($sql1);
          
	      $current_count = mysqli_num_rows($result1);    
          
          if($current_count > 0)
          {
              $current_count = "<font color='red'>".$current_count."</font>";
          }
          
            
		  $all_project["ID"] = $row["user_acc_id"];

          $all_project["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

		  $all_project["Department"] = $row["department"];

		  $all_project["Company"] = $row["company"];
		  
		  $all_project["Uncheck"] = $current_count;

          $all_project["Team"] = team($row["user_acc_id"]);

		  

		  

          array_push($response['data'], $all_project);



          

	  }

      echo json_encode($response);

     

      

    } else {

      echo json_encode(array('data'=>''));

    }
$conn->close();

function team ($id)
{
            include('db/dbconnection.php');

            $user_id = $id;

            $sql1 = "SELECT * FROM team WHERE team.leader_id = '$user_id'";
 
	        $result1 = $conn->query($sql1);
     
            if ($result1->num_rows > 0) {

	            if($row1 = $result1->fetch_assoc()) {
                     $team_name = $row1["team_name"];
	            }
	        }else{

                $sql1 = "SELECT * FROM team WHERE team.co_leader_id = '$user_id'";
    
	            $result1 = $conn->query($sql1);
     
                if ($result1->num_rows > 0) {

	                if($row1 = $result1->fetch_assoc()) {
                        $team_name = $row1["team_name"];
	                }
	            }
            }
            $sql1 = "SELECT * FROM team_members, user_acc WHERE team_members.user_acc_id=user_acc.user_acc_id AND team_members.user_acc_id='$user_id'";
    
	        $result1 = $conn->query($sql1);
     
            if ($result1->num_rows > 0) {

	            if($row1 = $result1->fetch_assoc()) {

		            $team_id = $row1["team_name_id"];

                    $sql2 = "SELECT * FROM team WHERE team_id ='$team_id'";
    
	                $result2 = $conn->query($sql2);
     
                    if ($result2->num_rows > 0) {

	                    if($row2 = $result2->fetch_assoc()) {
		                     $team_name = $row2["team_name"];
	                    }
	                }
	            }
	        }
	 if($team_name == "")
	 {
	     return $team_name = "No Team";
	 }else{
	    return $team_name; 
	 }
              
$conn->close();	   
 
}
?>