<?php





    $user_acc_id = $_GET['id']; 

    $coleader="";
	


	include("db/dbconnection.php");



    $sql4 = "SELECT * FROM user_acc, team where user_acc.user_acc_id=team.leader_id AND team.leader_id='".$user_acc_id."'";
    $result4 = $conn->query($sql4);

    
    if ($result4->num_rows > 0){
      while($row4 = $result4->fetch_array()) {
        $team_name = $row4['team_id'];
         $team_leader = $row4['leader_id'];
        $coleader = $row4['co_leader_id'];
      }
    }

    
    
    $sql5 = "SELECT * FROM user_acc where user_acc_id='$coleader'";

    $result5 = $conn->query($sql5);
    
    if ($result5->num_rows > 0) {

      
      while($row5 = $result5->fetch_array()) {
         $coleader_name =  $row5["firstname"]." ".$row5["middle_name"]." ".$row5["lastname"];
      }
    }

    $sql = "SELECT * FROM team, team_project, user_acc WHERE user_acc.user_acc_id=team_project.user_acc_id AND team_project.team_name1=team.team_id AND team_project.status='To be Check' AND team_project.user_acc_id='".$team_leader."'";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {



      $response['data'] = array();


      // output data of each row


      


      while($row = $result->fetch_array()) {





        $date_assigned = $row['date_assigned'];   


        $date_assigned1 = date('F d, Y ', strtotime($date_assigned));





        $date_submitted = $row['date_submitted'];   


        $date_submitted1 = date('F d, Y ', strtotime($date_submitted));


        if($coleader== 0)
        {


            $view_team_project= array();


            $view_team_project["ID"] = $row["team_project_id"];


            $view_team_project["Team Name"] = $row["team_name"];


            $view_team_project["Team Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];


            $view_team_project["Co Leader"] = "<label class='badge badge-info'><strong>NO CO LEADER</strong></label>";


            $view_team_project["Task Name"] = $row["task_name"];


            $view_team_project["File Format"] = $row["file_formats"];


            $view_team_project["Date Assigned"] = $date_assigned1;


            $view_team_project["Date Submitted"] = $date_submitted1;


            $view_team_project["G-Drive Link"] = "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";

            $view_team_project["Status"] = "<label class='badge badge-danger'><strong>Unchecked</strong></label>";

            


            


            array_push($response['data'], $view_team_project);


        }else{


            $sql1 = "SELECT * FROM team, team_project, user_acc WHERE user_acc.user_acc_id=team_project.user_acc_id AND team_project.team_name1=team.team_id AND team_project.status='To be Check' AND team_project.user_acc_id='".$team_leader."'";


    


            $result1 = $conn->query($sql1);


                while($row1 = $result1->fetch_array()) {


                $view_team_project = array();


                $view_team_project["ID"] = $row["team_project_id"];


                $view_team_project["Team Name"] = $row1["team_name"];


                $view_team_project["Team Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];


                $view_team_project["Co Leader"] = $coleader_name;


                $view_team_project["Task Name"] = $row["task_name"];


                $view_team_project["File Format"] = $row["file_formats"];


                $view_team_project["Date Assigned"] = $date_assigned1;


                $view_team_project["Date Submitted"] = $date_submitted1;


                $view_team_project["G-Drive Link"] = "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";

                $view_team_project["Status"] = "<label class='badge badge-danger'><strong>Unchecked</strong></label>";
                


                


                array_push($response['data'], $view_team_project);


        }





       


        }





    }


      echo json_encode($response);  





      


    } else {


      echo json_encode(array('data'=>''));


    }


  





    $conn->close();


?>