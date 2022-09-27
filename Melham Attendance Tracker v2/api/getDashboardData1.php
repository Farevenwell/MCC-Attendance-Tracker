<?php

  $uid = $_GET['uid'];
  $username = $_GET['username'];

  include("db/dbconnection.php");
  $data = array();

  $sql = "SELECT * FROM intern_info WHERE username ='$username'";
  $result = $conn->query($sql);
  while($row = $result->fetch_array()) 
  {
     $data['requiredHrs'] = $row["required_hours"]; 
     $req_hrs = $row["required_hours"]; 
  }
  
  
   $sql2 = "SELECT user_acc_id FROM user_acc WHERE username ='$username'";
   $result2 = $conn->query($sql2);
   while($row2 = $result2->fetch_array()) 
    {

        $sql3 = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id ='".$row2["user_acc_id"]."'";
		$result3 = mysqli_query($conn, $sql3);
        $row3 = $result3->fetch_assoc();

        $sql4 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id ='".$row2["user_acc_id"]."'";
	    $result4 = mysqli_query($conn, $sql4);
        $row4 = $result4->fetch_assoc();

        $sql5 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id ='".$row2["user_acc_id"]."'";
	    $result5 = mysqli_query($conn, $sql5);
        $row5 = $result5->fetch_assoc();       
        
        $rendered = $row3["hrs_added"] + $row4["extra_hours"] - $row5["extra_hours"];
        $remaining = $req_hrs - $row3["hrs_added"] - $row4["extra_hours"] + $row5["extra_hours"];
        
        if($row4["extra_hours"] <= 0)
        {
            $data['deductedHours'] = 0;
        }else{
            $data['deductedHours'] = $row4["extra_hours"];
        }
        
        if($row5["extra_hours"] <= null)
        {
            $data['penaltyHours'] = '0';
        }else{
            $data['penaltyHours'] = $row5["extra_hours"];
        }
        
        if($rendered <= 0 )
        {
            $data['renderedHours'] = "0";
        }else{
            $data['renderedHours'] = $rendered;
        }
        
        if($remaining <= 0 )
        {
           $data['hoursLeft'] = "0";
        }else{
           $data['hoursLeft'] = $remaining;
        }
    }

    $sql6 = "SELECT * FROM project WHERE status='Already checked' AND user_acc_id ='$uid'";

    $result6 = $conn->query($sql6);
	
	$row6 = mysqli_num_rows($result6);

    $sql7 = "SELECT * FROM project WHERE user_acc_id ='$uid'";

    $result7 = $conn->query($sql7);
	
	$row7 = mysqli_num_rows($result7);
	
	$data['project'] = $row6."|".$row7;
	
    $team = team($uid);

    $sql8 = "SELECT * FROM team_project WHERE status='Already Checked' AND team_name ='$team'";

    $result8 = $conn->query($sql8);
	
	$row8 = mysqli_num_rows($result8);

    $sql9 = "SELECT * FROM team_project WHERE team_name ='$team'";

    $result9 = $conn->query($sql9);
	
	$row9 = mysqli_num_rows($result9);
	
	$data['teamProject'] = $row8."|".$row9;	
	
    $sql10 = "SELECT * FROM weekly_report WHERE report_status='Signed' AND team_name ='$team'";

    $result10 = $conn->query($sql10);
	
	$row10 = mysqli_num_rows($result10);

    $sql11 = "SELECT * FROM weekly_report WHERE team_name ='$team'";

    $result11 = $conn->query($sql11);
	
	$row11 = mysqli_num_rows($result11);
	
	$data['teamReport'] = $row10."|".$row11;
	
    echo json_encode($data);
  
    $conn->close;
    
    function team ($id)
    {
            include('db/dbconnection.php');

            $user_id = $id;

            $sql1 = "SELECT * FROM team WHERE team.leader_id = '$user_id'";
 
	        $result1 = $conn->query($sql1);
     
            if ($result1->num_rows > 0) {

	            if($row1 = $result1->fetch_assoc()) {
                     $team_name = $row1["team_name"];
	            }
	        }else{

                $sql1 = "SELECT * FROM team WHERE team.co_leader_id = '$user_id'";
    
	            $result1 = $conn->query($sql1);
     
                if ($result1->num_rows > 0) {

	                if($row1 = $result1->fetch_assoc()) {
                        $team_name = $row1["team_name"];
	                }
	            }
            }
            $sql1 = "SELECT * FROM team_members, user_acc WHERE team_members.user_acc_id=user_acc.user_acc_id AND team_members.user_acc_id='$user_id'";
    
	        $result1 = $conn->query($sql1);
     
            if ($result1->num_rows > 0) {

	            if($row1 = $result1->fetch_assoc()) {

		            $team_id = $row1["team_name_id"];

                    $sql2 = "SELECT * FROM team WHERE team_id ='$team_id'";
    
	                $result2 = $conn->query($sql2);
     
                    if ($result2->num_rows > 0) {

	                    if($row2 = $result2->fetch_assoc()) {
		                     $team_name = $row2["team_name"];
	                    }
	                }
	            }
	        }  
            return $team_name; 
    
            $conn->close();	   
        }  

?>
