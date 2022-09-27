<?php
	header('Access-Control-Allow-Origin: *');
    header('Conten-Type: application/json');

    include('db/dbconnection.php');

	date_default_timezone_set('Asia/Manila');
    $getID = $_GET["id"];

	$currentTime = date('H:i');
	$currentDate = date('Y-m-d');

    $time=time();

   
	$sql2 = "SELECT * FROM staff_info, user_acc WHERE staff_info.username = user_acc.username ORDER By user_acc.last_login DESC";

	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {

        $response['data'] = array();

	    while($row = $result2->fetch_array()) {

            $listitem = array();
            $listitem["User ID"] = $row["user_acc_id"];


            if($getID == $row["user_acc_id"])
            {
                $listitem["Profile"] = '<img class="image" style="width:50px; border:2px solid #1DEB3B; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';
                $listitem["Name"] = "<font color='#1DEB3B'> Just you </font>";
                $listitem["Company"] = "<font  color='#1DEB3B'>".$row["company"]. "</font>";
                $listitem["Department"] = "<font color='#1DEB3B'>".$row["department"]. "</font>";
                $listitem["login"] = "<font color='#1DEB3B'>".humanTiming(strtotime($row["time_login"]))." ago </font>";
                $listitem["Team"] = "<font color='#1DEB3B'>".$row["team_handled"]. "</font>";

                if($row["activity"]==null)
                {
                    $listitem["Activity"] = "<font color='#1DEB3B'>Inactive</font>";
                }else{
                    $listitem["Activity"] = "<font color='#1DEB3B'>".$row["activity"]. "</font>";
                }

                if($row["staff_position"] == null)
                {
                    $listitem["Position"] = "<font color='#1DEB3B'>No Position Yet</font>";

                }else {
                    $listitem["Position"] = "<font color='#1DEB3B'>".$row["staff_position"]. "</font>";
                }

            }else{
                $listitem["Profile"] = '<img class="image" style="width:50px; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';            
                $listitem["Name"] = $row["firstname"]." ".$row["lastname"];
                $listitem["Company"] = $row["company"];
                $listitem["Department"] = $row["department"];
                $listitem["login"] = humanTiming(strtotime($row["time_login"]))." ago";    
                $listitem["Team"] = $row["team_handled"];

                if($row["activity"]==null)
                {
                    $listitem["Activity"] = "Inactive";
                }else{
                    $listitem["Activity"] = $row["activity"];
                }

                if($row["staff_position"] == null)
                {
                    $listitem["Position"] = "No Position Yet";

                }else {
                    $listitem["Position"] = $row["staff_position"];
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


?>