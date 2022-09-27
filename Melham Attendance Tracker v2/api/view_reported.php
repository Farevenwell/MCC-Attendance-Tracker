<?php
	header('Access-Control-Allow-Origin: *');
    header('Conten-Type: application/json');

    include('db/dbconnection.php');
	date_default_timezone_set('Asia/Manila');

	$id = $_GET['id'];
  	
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

	$sql2 = "SELECT * FROM user_acc,reported_intern WHERE reported_intern.report_count = '0' AND reported_intern.user_acc_id = user_acc.user_acc_id AND  reported_intern.team_name ='$team_name'";

	$result2 = $conn->query($sql2);

	if ($result2->num_rows > 0) {

        $response['data'] = array();

	    while($row = $result2->fetch_array()) {

            $listitem = array();

            $id = $row["id"];

            $sql3 = "SELECT * FROM user_acc,reported_intern WHERE reported_intern.reported_by  = user_acc.user_acc_id AND  reported_intern.id ='$id'";

	        $result3 = $conn->query($sql3);

	        if($result3->num_rows > 0) {

                while($row3 = $result3->fetch_array()) {

                     $listitem["Reported"] = $row3["firstname"]." ".$row3["lastname"];
                }
            }

	        $result6 = mysqli_query($conn, "SELECT SUM(report_count) AS count FROM reported_intern WHERE user_acc_id = '".$row["user_acc_id"]."'"); 
	
	        while($row6=mysqli_fetch_assoc($result6)){
		        $count = $row6['count'];
	        }            

            $listitem["id"] = $row["id"];
            $listitem["Profile"] = '<img class="image" style="width:50px; height: 50px; border-radius: 50%;" src="api/uploaded_profile/'.$row["profile_pic"].'" />';
            $listitem["Fullname"] = $row["firstname"]." ".$row["lastname"];
            $listitem["Team"] = $row["team_name"];
            $listitem["Reason"] = $row["reason"];
            $listitem["Date"] = $row["date"];
            $listitem["Status"] = "<label class='badge badge-success'>PENDING REPORT</label>";


            array_push($response["data"], $listitem);
		
        }   

        echo json_encode($response);


	} else {
	     echo json_encode(array('data'=>''));
	}
	$conn->close();


?>