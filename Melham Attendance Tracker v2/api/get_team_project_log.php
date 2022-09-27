<?php

	$id = $_GET['id']; 

	include("db/dbconnection.php");

    $sql1 = "SELECT * FROM user_acc, team where user_acc.user_acc_id=team.leader_id AND  team.leader_id='".$id."'";

    

    $result1 = $conn->query($sql1);
    $response['data'] = array();
    
    if ($result1->num_rows > 0) {

      
      while($row1 = $result1->fetch_array()) {
        $team_name = $row1['team_id'];
        $leader_name = $row1["firstname"]." ".$row1["middle_name"]." ".$row1["lastname"];
        $email =$row1['username'];
      }
    }   
        $sql = "SELECT * FROM  user_acc, team, team_project WHERE user_acc.user_acc_id=team_project.user_acc_id AND team.team_id=team_project.team_name1 AND team_project.team_name1='$team_name' AND status='Already Checked'";

    

        $result = $conn->query($sql);
        $response['data'] = array();
        
    if ($result->num_rows > 0) {

      
        while($row = $result->fetch_array()) {

        $sql6 = "SELECT * FROM user_acc WHERE user_acc_id='".$row['check_by']."'";
        $result6 = $conn->query($sql6);
        
        if ($result6->num_rows > 0) {
            while($row6 = $result6->fetch_array()) {
                $signed_by =  $row6["firstname"]." ".$row6["middle_name"]." ".$row6["lastname"];
            }
        }
          
          $view_project = array();

          $view_project["ID"] = $row["team_project_id"];

          $view_project["Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

          $view_project["Team Name"] = $row["team_name"];

          $view_project["Task Name"] = $row["task_name"];





          $date_submitted = $row['date_submitted'];   

          $date_submitted1 = date('F d, Y ', strtotime($date_submitted));



          $date_assigned = $row['date_assigned'];   

          $date_assigned1 = date('F d, Y ', strtotime($date_assigned));



          

          $view_project["Date Assigned"] = $date_assigned1;

          $view_project["Date Submitted"] = $date_submitted1;

          $view_project["File Format"] = $row["file_formats"];
          
          $view_project["Email"] = $row['username'];

          $view_project["G-Drive Link"] =  "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";

		  $view_project["Status"] = "<label class='badge badge-info'><strong>Checked</strong></label>";
          $view_project["Checked By"] = $signed_by;
          $view_project["Date Checked"] = $row['date_checked'];

		  

          array_push($response['data'], $view_project);



          

	  }

      echo json_encode($response);

    } else {

      echo json_encode(array('data'=>''));

    }

    $conn->close();

?>