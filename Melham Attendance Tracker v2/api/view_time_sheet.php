<?php

	

	include("db/dbconnection.php");

    date_default_timezone_set('Asia/Manila');



    $id = $_GET['id']; 



    $sql = "SELECT * FROM user_acc, intern_info,attendance where user_acc.username = intern_info.username AND attendance.user_acc_id = user_acc.user_acc_id AND user_acc.user_acc_id = '$id'";

    



    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {

      

      $response['data'] = array();

      // output data of each row

      

      while($row = $result->fetch_array()) {

            $view_intern = array();

            $view_intern["ID"] = $row["app_id"];

            $view_intern["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];	  

            $view_intern["Department"] = $row["department"];

            $view_intern["Company"] = $row["company"];

            $view_intern["date_in"] = date("F j, Y", strtotime($row["date_in"]));

            $view_intern["time_in"] = date("g:i A", strtotime($row["time_in"]));

            $view_intern["shift"] = $row["start_shift"]." - ".$row["end_shift"];

            $view_intern["remark"] = $row["remark_time_in"];

            $view_intern["remark1"] = $row["remark"];
            
            $view_intern["school"] = $row["school"];

            $view_intern["Team"] = team($row["user_acc_id"]);

            if($row["date_out"]==null)
            {
                
                $view_intern["date_out"] = "00-00-0000";
                                
            }else{
                $view_intern["date_out"] = date("F j, Y", strtotime($row["date_out"]));
            }

            if($row["time_out"]==null)
            {
                $view_intern["time_out"] = "00:00";
            }else{
                $view_intern["time_out"] = date("g:i A", strtotime($row["time_out"]));                
            }
            
            if($row["hrs_today"]==null)
            {
                $view_intern["hrs_today"] = "0 hrs";
            }else{
                $view_intern["hrs_today"] = $row["hrs_today"]." hrs";
            }
            
            if($row["hrs_added"]==null)
            {
                $view_intern["hrs_added"] = "0 hrs";
            }else{
                $view_intern["hrs_added"] = $row["hrs_added"]." hrs";
            }
            
            if($row["hrs_left"]==null)
            {
                $view_intern["hrs_left"] = "No changes";
            }else{
                $view_intern["hrs_left"] = $row["hrs_left"]." hrs";
            }            

            

            

            
		  

          array_push($response['data'], $view_intern);



          

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
    return $team_name;          
$conn->close();	   
 
}

?>