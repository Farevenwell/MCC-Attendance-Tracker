<?php
	header('Access-Control-Allow-Origin: *');
    header('Conten-Type: application/json');

    include('db/dbconnection.php');

    $getID = $_GET["id"];

	date_default_timezone_set('Asia/Manila');

	$currentTime = date('H:i');
	$currentDate = date('Y-m-d');

    $time=time();
    
    
    $sqla = "SELECT * FROM user_acc WHERE user_acc_id='$getID'";
    $resulta = $conn->query($sqla);

    while($rowa = $resulta->fetch_array()) {
        $uty = $rowa["usertype"];
    }
    
    
    if($uty === "Admin" || $uty ==="Staff")
    {
        $sql2 = "SELECT * FROM intern_info, user_acc WHERE intern_info.username = user_acc.username AND permission = '1' ORDER By last_login DESC";
    }else{
   
	    $sql2 = "SELECT * FROM intern_info, user_acc WHERE intern_info.username = user_acc.username AND permission = '1' AND last_login > '$time' ORDER By last_login DESC";
    }
	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {

        $response['data'] = array();

	    while($row = $result2->fetch_array()) {

            $listitem = array();
            $listitem["User ID"] = $row["user_acc_id"];
            $team = team($row["user_acc_id"]);

            if($getID == $row["user_acc_id"])
            {
                $listitem["Profile"] = '<img class="image" style="width:50px; border:2px solid #1DEB3B; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';
                $listitem["Name"] = "<font color='#1DEB3B'> Just you </font>";
                $listitem["Company"] = "<font color='#1DEB3B'>".$row["company"]. "</font>";
                $listitem["Department"] = "<font color='#1DEB3B'>".$row["department"]. "</font>";
                $listitem["login"] = "<font color='#1DEB3B'>".humanTiming(strtotime($row["time_login"]))." ago </font>";
                
                if($team == "")
                {
                    $listitem["Team"] = "<font color='#1DEB3B'> No Team </font>";
                }else{
                    $listitem["Team"] = "<font color='#1DEB3B'>".$team. "</font>";
                }
                if($row["position"] == 1)
                {
                    $listitem["Position"] = "<font color='#1DEB3B'> Team Leader </font>";

                }else if($row["position"] == 2)
                {
                    $listitem["Position"] = "<font color='#1DEB3B'>Team Co Leader </font>";

                }else if($row["position"] == 3)
                {
                    $listitem["Position"] = "<font color='#1DEB3B'> Member </font>";

                }else if($row["position"] == 0)
                {
                    $listitem["Position"] = "<font color='#1DEB3B'> No Team Assigned </font>";
                }




            }else{
                $listitem["Profile"] = '<img class="image" style="width:50px; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';            
                $listitem["Name"] = $row["firstname"]." ".$row["lastname"];
                $listitem["Company"] = $row["company"];
                $listitem["Department"] = $row["department"];
                $listitem["login"] = humanTiming(strtotime($row["time_login"]))." ago";
                if($team == "")
                {
                    $listitem["Team"] = "No Team";
                }else{
                    $listitem["Team"] = $team;
                }

                if($row["position"] == 1)
                {
                    $listitem["Position"] = "Team Leader";

                }else if($row["position"] == 2)
                {
                    $listitem["Position"] = "Team Co Leader";

                }else if($row["position"] == 3)
                {
                    $listitem["Position"] = "Member";

                }else if($row["position"] == 0)
                {
                    $listitem["Position"] = "No Team Assigned";
                }
            }
            
            if($row["last_login"]>$time)
            {
                $listitem["status"] = "<button disabled class='btn-sm btn-gradient-success me-2'>ONLINE</button>";
            }else{
                $listitem["status"] = "<button disabled style='background:gray;' class='btn-sm btn-gradient-success me-2'>OFFLINE</button>";
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