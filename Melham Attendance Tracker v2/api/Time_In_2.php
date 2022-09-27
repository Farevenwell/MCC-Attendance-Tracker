<?php

  header('Access-Control-Allow-Origin: *');

  include('db/dbconnection.php');
  
   
   date_default_timezone_set('Asia/Singapore');
	$email = $_GET['email'];
	$user_id = "";
	$remark = "Time in Successful";
	$currentTime = date('H:i');
	$currentDate = date('Y-m-d');	
		
    $sql = "SELECT * FROM user_acc WHERE username = '$email'";
    
	$result = $conn->query($sql);
    
    $response = array();
    
    if ($result->num_rows > 0) {

	  if($row = $result->fetch_assoc()) {
		$user_id = $row["user_acc_id"];
	  }
	}   

	
	$sql4 = "SELECT * FROM intern_info WHERE username = '$email'";   
	$result4 = $conn->query($sql4);
    
	$response = array();
    
	if ($result4->num_rows > 0) {

		if($row4 = $result4->fetch_assoc()) 
        {
			$rqrd_hrs1 = $row4["required_hours"];
			$company = $row4["company"];
		}
	} 		

	$sql10 = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id = '$user_id'";
    
	$result10 = mysqli_query($conn, $sql10);
    $row10 = $result10->fetch_assoc();
    $hrs_added = round($row10["hrs_added"], 1);

    $sql8 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id = '$user_id'";
	$result8 = mysqli_query($conn, $sql8);
    $row8 = $result8->fetch_assoc();            
        
    $sql9 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id = '$user_id'";
	$result9 = mysqli_query($conn, $sql9);
    $row9 = $result9->fetch_assoc();        
            
    $penalty = $row8["extra_hours"];
    $deduction = $row9["extra_hours"];

	$rqrd_hrs = $rqrd_hrs1 - $hrs_added - $deduction + $penalty;
	

	
	if($currentTime > "09:15" && $currentTime <= "09:30")
	{
		$remark1 = "1 hr late";
		$sql2 = "INSERT INTO attendance (company, user_acc_id, date_in, time_in, date_out, time_out, hrs_today,remark_time_in, remark, hrs_left) VALUES ('$company','$user_id','$currentDate','$currentTime','','',0,'$remark1','$remark','$rqrd_hrs')";

	}else if($currentTime >= "09:31" && $currentTime <= "11:00")
	{
		$remark1 = "2 hrs late";
		$sql2 = "INSERT INTO attendance (company, user_acc_id, date_in, time_in, date_out, time_out, hrs_today,remark_time_in, remark, hrs_left) VALUES ('$company','$user_id','$currentDate','$currentTime','','',0,'$remark1','$remark','$rqrd_hrs')";

	}else if($currentTime <= "09:15" && $currentTime >= "08:45")
	{
		$remark1 = "On time";
		$sql2 = "INSERT INTO attendance (company, user_acc_id, date_in, time_in, date_out, time_out, hrs_today,remark_time_in, remark, hrs_left) VALUES ('$company','$user_id','$currentDate','$currentTime','','',0,'$remark1','$remark','$rqrd_hrs')";

	}else if($currentTime <= "08:44" && $currentTime >= "00:01"){
	    
	    die("0");
	    
	}else{
		$remark1 = "Absent (Not following time shift)";
		$absent_time_in = $currentTime;
		$absent_time_out = $currentTime;		
		$sql2 = "INSERT INTO attendance (company, user_acc_id, date_in, time_in, date_out, time_out, hrs_today,remark_time_in, remark, hrs_added, hrs_left) VALUES ('$company','$user_id','$currentDate','$absent_time_in','$currentDate','$absent_time_out',0,'$remark1','Time out Successful',0,'$rqrd_hrs')";
	}
    $response = array();
    if ($conn->query($sql2) === TRUE) {
      echo '1';
    

    } else {
      echo '0';
    }
    
    $conn->close();
 
?>
 