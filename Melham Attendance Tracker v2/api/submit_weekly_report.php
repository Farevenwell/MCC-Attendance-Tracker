<?php

	include("db/dbconnection.php");
    
    date_default_timezone_set('Asia/Manila');
    
	$currentDate = date('Y-m-d');
    $currentTime = date('H:i');
    $now = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime)); 

    if(isset($_POST['user_acc_id1']) && isset($_POST['weekly_report']) && isset($_POST['gdrive_link1']) && isset($_POST['team_name1'])){



        $user_acc_id = $_POST['user_acc_id1'];

		$weekly_report = $_POST['weekly_report'];

		$team_name1 = $_POST['team_name1'];

		$gdrive_link = $_POST['gdrive_link1'];

		$unsign = 'Unsign';


        if($currentTime > "18:00")
        {
            $remark = "LATE";
        }else{
            $remark = "ON TIME";
        }
		

	            $sql1 = "INSERT INTO weekly_report (user_acc_id, weekly_no, date_submitted, report_status, team_name1, gdrive_link, remark) VALUES ('$user_acc_id', '$weekly_report', '$now', '$unsign', '$team_name1', '$gdrive_link','$remark')";

				if ($conn->query($sql1) === TRUE) 

				{

					echo "1" ;			

			

				} else 

				{

					echo "0";

				}

			

        

        $conn->close();

    }

	



?>