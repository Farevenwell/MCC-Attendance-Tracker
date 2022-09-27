

<?php
date_default_timezone_set('Asia/Manila');


include("db/dbconnection.php");

    $user_id = $_POST["intern_id"];
    $reported_by = $_POST["reported_by"];
    $reason = $_POST["reason"];

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

$currentDate = date('Y-m-d');
$currentTime = date('H:i');
$date_reported = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime)); 


if($user_id === $reported_by)
{
    echo "2";

}else{

$sql4 = "SELECT * FROM user_acc WHERE report_date='$currentDate' AND user_acc_id='$reported_by'";

$result4 = $conn->query($sql4);
        
if(mysqli_num_rows($result4)>0)
{
    echo "3";
}else{


$sql6 = mysqli_query($conn, "UPDATE user_acc SET report_date = '$currentDate' WHERE user_acc_id='$reported_by'");

$sql = "SELECT * FROM user_acc WHERE user_acc_id ='$user_id'";
$count = 0;    
$result = $conn->query($sql);
        
while($row = $result->fetch_array()) 
{
    $firstname = $row["firstname"]; 
    $email =  $row["username"];
}

$sql = "INSERT INTO reported_intern (user_acc_id, reported_by, reason, report_count, team_name, date) VALUES ('$user_id','$reported_by','$reason','$count','$team_name','$date_reported')";

if ($conn->query($sql) === TRUE) 
{	
	$result = mysqli_query($conn, "SELECT SUM(report_count) AS count FROM reported_intern WHERE user_acc_id = '$user_id'"); 

	while($row=mysqli_fetch_assoc($result)){
		$current_count = $row['count'];
	}    

    $new_count = $current_count + 1;

    if($new_count == 6)
    {
        $sql = "UPDATE intern_info SET intern_status = 'Multiple Reports' WHERE username = '$email'";
   
        if($conn->query($sql) === TRUE) {


						$name = $email;
  	                    require_once __DIR__.'/vendor/autoload.php';
	
	                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'tls';                       
                        $mail->Username = 'uip.tracker.v2@gmail.com';
                        $mail->Password = 'stiyvmpsdyirygfq';


                        // Recipients
                        $mail->setFrom('uip.tracker.v2@gmail.com', 'Melham Construction Corporation');
                        $mail->addAddress($email);
	                    $mail->addReplyTo('uip.tracker.v2@gmail.com','Melham Construction Corporation');

	                    //message
	
	
	                    $mail->isHTML(true);	
	                    $message = "<div style='width:90%;'><h4><b><p>Hello ".$name.",<br><br>You have been reported multiple times with your teamamtes. Please coordinate with the team leader or core team regarding the problem.<br><br>While this case is not resolved, you cannot login to attendance tracker for the meantime!<br><br> Thank you for your understanding!<br><br>Sincerly,<br><br><u>Feric G. Decenan</u><br><i>ADMIN</i></p></b></h4></div>";
	
                        // Content
                        $mail->Subject = "TEMPORARY BANNED";
                        $mail->Body    = $message.'<br><br><br><footer><div style="text-align: center; font-size: 12px;color:black; height:30px; width: 100%;"><p>Copyright &copy; '.date("Y").' Melham Construction Corporation | Project IT-30 Team</p></div></footer>';;
                        $mail->send();
						

						echo "1";
            }         
    }else
    {
        echo "1"; 
    } 
}
}
} 


$conn->close();
?>




