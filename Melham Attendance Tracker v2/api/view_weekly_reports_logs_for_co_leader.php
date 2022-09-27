<?php



    $user_acc_id = $_GET['id']; 

	

	include("db/dbconnection.php");

    

    $sql = "SELECT * FROM team, user_acc, weekly_report where team.co_leader_id=user_acc.user_acc_id AND weekly_report.team_name1=team.team_id  AND team.co_leader_id='".$user_acc_id."'";

    

    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {

      

      $response['data'] = array();



      // output data of each row

      

      while($row = $result->fetch_array()) {
         
          $sql5 = "SELECT * FROM user_acc where user_acc_id='".$row['signed_by']."'";

    

            $result5 = $conn->query($sql5);
            
            if ($result5->num_rows > 0) {

            
            while($row5 = $result5->fetch_array()) {
                $signedby =  $row5["firstname"]." ".$row5["middle_name"]." ".$row5["lastname"];
            }
            }

            $sql1 = "SELECT * FROM team, user_acc where team.leader_id=user_acc.user_acc_id AND team.co_leader_id='".$row["co_leader_id"]."'";

    

            $result1 = $conn->query($sql1);

    

    

                while($row1 = $result1->fetch_array()) {

                $view_weekly_report = array();

                $view_weekly_report["ID"] = $row["weekly_report_id"];

                $view_weekly_report["Team Name"] = $row1["team_name"];

                $view_weekly_report["Remark"] = $row["remark"];

                $view_weekly_report["Team Leader"] = $row1["firstname"]." ".$row1["middle_name"]." ".$row1["lastname"];

                $view_weekly_report["Co Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

                $view_weekly_report["Week #"] = $row["weekly_no"];

                $view_weekly_report["Date Submitted"] = $row['date_submitted']; 



                if($row["report_status"] == 'Signed'){

                    $view_weekly_report["Status"] = "<label class='badge badge-info'><strong>".$row["report_status"]."</strong></label>";

                }else{

                    $view_weekly_report["Status"] = "<label class='badge badge-danger'>".$row["report_status"]."</label>";

                }



                if($row["signed_by"]== "" && $row["date_signed"]=="" ){

                    $view_weekly_report["Signed By"] = "Not yet signed";
                    $view_weekly_report["Date Signed"] = "Not yet signed";

                }else{

                    $view_weekly_report["Signed By"] =  $signedby;
                    $view_weekly_report["Date Signed"] = $row["date_signed"];

                }
                

                

                

                

                array_push($response['data'], $view_weekly_report);

        



       

        }



    }

      echo json_encode($response);  



      

    } else {

      echo json_encode(array('data'=>''));

    }





    $conn->close();

?>