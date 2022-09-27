<?php
	
	include("db/dbconnection.php");

	$project_id = $_POST['project_id'];
    $checkby = $_POST['check_by'];

    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');
    $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));
	

    $sql1 = "UPDATE team_project SET status='Already Checked', check_by='$checkby', date_checked='$date' where team_project_id='$project_id'";

	if ($conn->query($sql1) === TRUE) {
		echo "1";
	}else {
	     echo "0";
    }
    $conn->close();
?>