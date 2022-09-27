<?php
		
	date_default_timezone_set('Asia/Manila');
	   
    include("db/dbconnection.php");
	
   
	$email = $_GET['email'];
	$currentDate = date('Y-m-d');
	$currentTime = date('H:i');
	$remark="Time in Successful";
	$lastID="";
	$user_id="";
	$time_in="";
	
	if($currentTime >= "00:00" && $currentTime <= "02:59"){
	    
	    $currentTime = "23:59";
	    $currentDate = date('Y-m-d', strtotime('yesterday'));
	}
	
	
    $sql = "SELECT * FROM user_acc WHERE username = '$email'";
    
	$result = $conn->query($sql);
    
    
    
    if ($result->num_rows > 0) {

	  if($row = $result->fetch_assoc()) {
		$user_id = $row["user_acc_id"];
        $shift = $row["shift"];
	  }
	}  
	
	$result1 = mysqli_query($conn, "SELECT MAX(att_id) AS id FROM attendance WHERE user_acc_id = '$user_id'"); 
	
	while($row1=mysqli_fetch_assoc($result1)){
		$lastID = $row1['id'];
	}

    $sql3 = "SELECT * FROM attendance WHERE att_id = '$lastID' AND user_acc_id = '$user_id'";
    
	$result3 = $conn->query($sql3);
    
    
    
    if ($result3->num_rows > 0) {

	  if($row3 = $result3->fetch_assoc()) {
		$time_in = $row3["time_in"];
        $rem = $row3["remark_time_in"];
	  }
	} 
	
    if($shift == 3)
    {
	    $today_hrs3 = round((strtotime($currentTime) - strtotime($time_in))/3600, 1);
       
        if($rem == "1 hr late"){
            $today_hrs1 = $today_hrs3 - 1;
        }else if($rem == "2 hrs late"){
            $today_hrs1 = $today_hrs3 - 2;
        }else{
            $today_hrs1 = $today_hrs3;
        }
    }else{
	    $today_hrs3 = round((strtotime("12:00") - strtotime($time_in))/3600, 1);
	    
	    if($currentTime >= "13:00")
	    {
	        $today_hrs2 = round((strtotime($currentTime) - strtotime("13:00"))/3600, 1);
	    }else{
	        $today_hrs2 = 0;
	    }

        if($rem == "1 hr late"){
            $today_hrs5 = $today_hrs3 + $today_hrs2;
            $today_hrs1 = $today_hrs5 - 1; 

        }else if($rem == "2 hrs late"){
            $today_hrs5 = $today_hrs3 + $today_hrs2;
            $today_hrs1 = $today_hrs5 - 2;

        }else{
            $today_hrs1 = $today_hrs3 + $today_hrs2;
        }
    }

	
	
	if($today_hrs1 > 8 ){
		$today_hrs = 8;
	}else{
		$today_hrs = $today_hrs1;
	}
	
	$rqrd_hrs=0;
	
    $sql4 = "SELECT * FROM intern_info WHERE username = '$email'";
    
	$result4 = $conn->query($sql4);
    
    
    
    if ($result4->num_rows > 0) {

	  if($row4 = $result4->fetch_assoc()) {

			$rqrd_hrs = $row4["required_hours"];
	    }
	} 	
	
	 
	
    $sql2 = "UPDATE attendance SET time_out = '$currentTime' , date_out = '$currentDate' , remark = 'Time out Successful', hrs_today = '$today_hrs' WHERE remark='$remark' and att_id='$lastID' and user_acc_id ='$user_id'";
    
	if (mysqli_query($conn, $sql2)) {
		$response = array();

		$sql5 = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id = '$user_id'";
    
		$result5 = mysqli_query($conn, $sql5);
        $row5 = $result5->fetch_assoc();
        $hrs_added = round($row5["hrs_added"], 1);


        $sql3 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id = '$user_id'";
	    $result3 = mysqli_query($conn, $sql3);
        $row3 = $result3->fetch_assoc();            
        
        $sql4 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id = '$user_id'";
	    $result4 = mysqli_query($conn, $sql4);
        $row4 = $result4->fetch_assoc();        
        
        
        $penalty = $row3["extra_hours"];
        $deduction = $row4["extra_hours"];

		$hrs_left = $rqrd_hrs - $hrs_added - $deduction + $penalty;
		
		$sql6 = "UPDATE attendance SET hrs_left = '$hrs_left', hrs_added = '$hrs_added' WHERE remark='Time out Successful' and att_id='$lastID' and user_acc_id ='$user_id'";
	
		if (mysqli_query($conn, $sql6)) {
	
			echo '1';
		}
        else{
            echo '0';
        }			

	} else {
  
            echo '0';
	}
	
	
	 $conn->close();
?>