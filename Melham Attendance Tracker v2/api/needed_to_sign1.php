<?php



	include("db/dbconnection.php");

	

    $id = $_POST['weekly_id'];
    $signedby = $_POST['signed_by'];

    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');
    $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));


    $report_status = 'Signed';

    

     $sql = "UPDATE weekly_report SET report_status='$report_status', signed_by='$signedby', date_signed='$date' where weekly_report_id='$id'";

    

		

		if ($conn->query($sql) === TRUE) {

			echo "1";

		}

		else {

		  echo "0";

		}

    $conn->close();

?>