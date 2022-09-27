<?php



    $user_acc_id = $_GET['id']; 

	

	include("db/dbconnection.php");

    

    $sql = "SELECT * FROM team, user_acc, weekly_report where team.leader_id=user_acc.user_acc_id AND weekly_report.team_name1=team.team_id AND weekly_report.user_acc_id=user_acc.user_acc_id AND weekly_report.report_status='Signed' AND weekly_report.user_acc_id='".$user_acc_id."'";

    

    $result = $conn->query($sql);



    



    if ($result->num_rows > 0) {

      

      $response['data'] = array();



      // output data of each row

      

      while($row = $result->fetch_array()) {


        $sql6 = "SELECT * FROM user_acc WHERE user_acc_id='".$row['signed_by']."'";
        $result6 = $conn->query($sql6);
        
        if ($result6->num_rows > 0) {
            while($row6 = $result6->fetch_array()) {
                $signed_by =  $row6["firstname"]." ".$row6["middle_name"]." ".$row6["lastname"];
            }
        }



        if($row["co_leader_id"]==0)

        {



            $view_weekly_report = array();

            $view_weekly_report["ID"] = $row["weekly_report_id"];

            $view_weekly_report["Team Name"] = $row["team_name"];

            $view_weekly_report["Team Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

            $view_weekly_report["Co Leader"] = "<label class='badge badge-info'><strong>NO CO LEADER</strong></label>";

            $view_weekly_report["Week #"] = $row["weekly_no"];

            $view_weekly_report["Date Submitted"] = $row['date_submitted']; 

            $view_weekly_report["Remark"] = $row["remark"];

             

            $view_weekly_report["G-Drive Link"] = "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";

            $view_weekly_report["Status"] = "<label class='badge badge-info'><strong>".$row["report_status"]."</strong></label>";

            $view_weekly_report["Signed By"] = $signed_by;

            $view_weekly_report["Date Signed"] = $row["date_signed"];

            

            array_push($response['data'], $view_weekly_report);

        }else{

            $sql1 = "SELECT * FROM team, user_acc where team.co_leader_id=user_acc.user_acc_id AND team.leader_id='".$row["user_acc_id"]."'";

    

            $result1 = $conn->query($sql1);

    

    

                while($row1 = $result1->fetch_array()) {

                $view_weekly_report = array();

                $view_weekly_report["ID"] = $row["weekly_report_id"];

                $view_weekly_report["Team Name"] = $row1["team_name"];

                $view_weekly_report["Team Leader"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];

                $view_weekly_report["Co Leader"] = $row1["firstname"]." ".$row1["middle_name"]." ".$row1["lastname"];

                $view_weekly_report["Week #"] = $row["weekly_no"];

                $view_weekly_report["Date Submitted"] = $row['date_submitted']; 

                $view_weekly_report["Remark"] = $row["remark"];

                $view_weekly_report["G-Drive Link"] = "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";

                $view_weekly_report["Status"] = "<label class='badge badge-info'><strong>".$row["report_status"]."</strong></label>";

                $view_weekly_report["Signed By"] = $signed_by;

                $view_weekly_report["Date Signed"] = $row["date_signed"];


                

                

                array_push($response['data'], $view_weekly_report);

        }



       

        }



    }

      echo json_encode($response);  



      

    } else {

      echo json_encode(array('data'=>''));

    }





    $conn->close();

?>