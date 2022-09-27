<?php
	header('Access-Control-Allow-Origin: *');
    header('Conten-Type: application/json');

    include('db/dbconnection.php');
	date_default_timezone_set('Asia/Manila');

    $time=time();
    $i=1;

	$id = $_GET['id'];
	$currentTime = date('H:i');
	$currentDate = date('Y-m-d');
	
    $sql0 = "SELECT * FROM user_acc WHERE username = '$id'";
    
	$result0 = $conn->query($sql0);
    
    $response = array();
    
    if ($result0->num_rows > 0) {

	  if($row0 = $result0->fetch_assoc()) {
		$user_id = $row0["user_acc_id"];
	  }
	}

    $sql1 = "SELECT * FROM team WHERE team.leader_id = '$user_id'";
 
	$result1 = $conn->query($sql1);
     
    if ($result1->num_rows > 0) {

	  if($row1 = $result1->fetch_assoc()) {
		$team_id = $row1["team_id"];
        $team_name = $row1["team_name"];
	  }
	}else{

        $sql1 = "SELECT * FROM team WHERE team.co_leader_id = '$user_id'";
    
	    $result1 = $conn->query($sql1);
     
        if ($result1->num_rows > 0) {

	        if($row1 = $result1->fetch_assoc()) {
		        $team_id = $row1["team_id"];
                $team_name = $row1["team_name"];
	        }
	    }
        else
        {
            $sql1 = "SELECT * FROM team_members, user_acc where team_members.user_acc_id=user_acc.user_acc_id AND team_members.user_acc_id='$user_id'";
    
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
        }

    }   

	$sql = "SELECT * FROM team, user_acc WHERE team.leader_id=user_acc.user_acc_id  AND team.team_id = '$team_id'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

        $response['data'] = array();

	    while($row = $result->fetch_array()) {
        
            $listitem = array();
            $listitem["id"] = $row["user_acc_id"];

            if($user_id == $row["user_acc_id"])
            {
                $listitem["Profile"] = '<img class="image" style="width:50px; border:2px solid #1CEB3C; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';
                $listitem["Fullname"] = "<font color='#1CEB3C'> Just you </font>";
                $listitem["Time"] = "<font color='#1CEB3C'>".humanTiming(strtotime($row["time_login"]))." ago </font>";
                $listitem["Team"] = "<font color='#1CEB3C'>".$team_name."</font>";                
            }else
            {               
                $listitem["Profile"] = '<img class="image" style="width:50px; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';
                $listitem["Fullname"] = $row["firstname"]." ".$row["lastname"];
                $listitem["Time"] = humanTiming(strtotime($row["time_login"]))." ago";
                $listitem["Team"] = $team_name;
            }

            if($row["last_login"]>$time)
            {
                $listitem["Status"] = "<button disabled class='btn-sm btn-gradient-success me-2'>ONLINE</button>";
            }else{
                $listitem["Status"] = "<button disabled style='background:gray;' class='btn-sm btn-gradient-success me-2'>OFFLINE</button>";
            }

            array_push($response["data"], $listitem);
		
        }   

        echo json_encode($response);


	} else {
	     echo json_encode(array('data'=>''));
	}
	$conn->close();

function humanTiming ($time)
        {

            $time = time() - $time; // to get the time since that moment
            $time = ($time<1)? 1 : $time;
            $tokens = array (
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
            }

        }

?>