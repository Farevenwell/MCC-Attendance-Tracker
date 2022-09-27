<?php

	

	include("db/dbconnection.php");

    

    $sql = "SELECT * FROM team, user_acc where team.leader_id=user_acc.user_acc_id";

    

    $result = $conn->query($sql);



    



    if ($result->num_rows > 0) {

      

      $response['data'] = array();



      // output data of each row

      

      while($row = $result->fetch_array()) {


        if($row["co_leader_id"]==0)

        {
            
            


            $view_team = array();

            $view_team["ID"] = $row["leader_id"];

            $view_team["Team Name"] = $row["team_name"];

            $view_team["Team Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

            $view_team["Co Leader"] = "<label class='badge badge-info'><strong>NO CO LEADER</strong></label>";

            $sql2 = "SELECT status FROM team_project where status='To be Check' AND  team_name1='".$row['team_id']. "'";
            $result2 = $conn->query($sql2);
                
            $row2 = mysqli_num_rows($result2);
            
            if($row2 <= 0)
            {
                $row2 = 0;
            }else{
                 $row2 = "<font color='red'>".$row2."</font>";
            }
            
            $view_team['uncheck_team_project'] = $row2; 



            $sql3 = "SELECT weekly_report.report_status FROM weekly_report where report_status='Unsign' AND team_name1='".$row['team_id']. "' ";
            $result3 = $conn->query($sql3);
                
            $row3 = mysqli_num_rows($result3);
            
            if($row3 <= 0)
            {
                $row3 = 0;
            }else{
                $row3 = "<font color='red'>".$row3."</font>";
            }
            
            $view_team['uncheck_team_weekly'] = $row3;
            

                    

            array_push($response['data'], $view_team);

        }else{

            $sql1 = "SELECT * FROM team, user_acc where team.co_leader_id=user_acc.user_acc_id AND team.leader_id='".$row["user_acc_id"]."'";

    

            $result1 = $conn->query($sql1);

    

    

                while($row1 = $result1->fetch_array()) {

                $view_team = array();

                $view_team["ID"] = $row1["leader_id"];

                $view_team["Team Name"] = $row1["team_name"];

                $view_team["Team Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

                $view_team["Co Leader"] = $row1["firstname"]." ".$row1["middle_name"]." ".$row1["lastname"];



                $sql2 = "SELECT team_project.status FROM team_project where status='To be Check' AND  team_name1='".$row1['team_id']. "' ";
                $result2 = $conn->query($sql2);
                
                $row2 = mysqli_num_rows($result2);
                
                if($row2 <= 0)
                {
                    $row2 = 0;
                }else{
                     $row2 = "<font color='red'>".$row2."</font>";
                }
                
                $view_team['uncheck_team_project'] = $row2; 



                $sql3 = "SELECT weekly_report.report_status FROM weekly_report where report_status='Unsign' AND team_name1='".$row1['team_id']. "' ";
                $result3 = $conn->query($sql3);
                
                $row3 = mysqli_num_rows($result3);
                
                if($row3 <= 0)
                {
                    $row3 = 0;
                }else{
                    $row3 = "<font color='red'>".$row3."</font>";
                }
            
                
                $view_team['uncheck_team_weekly'] = $row3; 
                
                array_push($response['data'], $view_team);

        }



       

        }



    }

      echo json_encode($response);  



      

    } else {

      echo json_encode(array('data'=>''));

    }





    $conn->close();

?>