<?php

	include("db/dbconnection.php");
	
    $id = $_POST['intern_id'];
    $approveby = $_POST['approve_by'];
    $permission = 1;
    $password = randomPass();
	$hashed_pass = md5($password);  
	
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');
    $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));



    $sql1 = "SELECT * FROM user_acc WHERE user_acc_id ='$id'";
    
    $result1 = $conn->query($sql1);
    
    
    while($row1 = $result1->fetch_array()) 
      {
         $firstname = $row1["firstname"]; 
         $email =  $row1["username"];
      }

    $sql7 = "SELECT * FROM user_acc WHERE user_acc_id ='$approveby'";
    
    $result7 = $conn->query($sql7);
    
    
    while($row7 = $result7->fetch_array()) 
      {
         $name_approved = $row7["firstname"]." ".$row7["middle_name"]." ".$row7["lastname"]; 
      }


    $sql2 = "SELECT * FROM intern_info WHERE username ='$email'";
    
    $result2 = $conn->query($sql2);
    
    
    while($row2 = $result2->fetch_array()) 
      {

         $dept = $row2["department"]; 
         $start =  $row2["startdate"]." at ".$row2["start_shift"];
         $website = "<a href='https://melhamconstruction.ph/uip/attendance/'> Attendance Tracker Website </a>";
         $compWebsite = "<a href='https://melhamconstruction.ph/'> Melham Construction Corporation </a>";
         $compEmail ="uip.webtracker@gmail.com";
      }

      $sqlinsert = "INSERT INTO intern_applicant_logs ( user_id, staff_id, status, date ) VALUES ('$id','$approveby','Approved','$date' )";

		if ($conn->query($sqlinsert) === TRUE) {
		 
		$sql = "UPDATE user_acc SET passwd = '$hashed_pass' , permission='$permission' where user_acc_id='$id'";
        $conn->query($sql);
		    
		$sql1 = "UPDATE intern_info SET intern_status ='Ongoing' WHERE username='$email'";
		if ($conn->query($sql1) === TRUE) {

						$name = $firstname;
  	                    require_once __DIR__.'/vendor/autoload.php';
	
	                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                        include("smtpInjection.php");
                        
                        $mail->SMTPDebug = 0;
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'tls';                       
                        $mail->Username = $smtpEmail;
                        $mail->Password = $smtpPass;


                        // Recipients
                        $mail->setFrom($smtpEmail, 'Melham Construction Corporation');
                        $mail->addAddress($email,$name);
	                    $mail->addReplyTo($smtpEmail,'Melham Construction Corporation');
                        $mail->AddEmbeddedImage('imageMail/approved.gif', 'congrats');
	                    //message
	
	
	                    $mail->isHTML(true);	
	                    $message = "<div style='border-left-width: 7px; border-left-style: solid; border-left-color: #0071BD; background-color: #d4dbd5; border-radius: 5px; width:650px;'><h4><b><p style='padding:15px 10px 15px 10px;'>Dear ".$name.",<br><br>Welcome to Melham Construction Corporation!<br><br> We are delighted you have chosen to use your extraordinary talent in ".$dept." to take our work to new heights. We cannot even begin to list all the ways your skills will be invaluable to our company mission.<br><br>We want to make sure your first day goes as smoothly as possible. Here are some key things you should know:<br><br>*When: ".$start."<br>*Where: ".$website."<br><br><font style='color:red'>**Please note for time in**</font><br><br>-16 to 30 mins late will have a deduction of 1 hour.<br>-31 to 120 mins late will have a deduction of 2 hours.<br>-121 mins late and beyond is considered an absent.<br><br><font style='color:red'>**Please note for time out**</font><br><br>-25 mins from the end of shift, the time out button will be disabled.<br><br><font style='color:red'>**For 3PM to 12AM shift ONLY**</font><br><br>-time out button will be valid until 11:59PM.<br><br><font style='color:green'>Below is your username & password, please don't share it to anyone.</font><br><br>username: ".$email."<br>password: ".$password."<br><p style='padding:15px 10px 15px 10px;'>In the meantime, we encourage you to check out our website, ".$compWebsite." to do some reading about our work.<br><br>Please do not hesitate to email me at ".$compEmail." if I can answer any questions or support you in any other way.<br><br>Sincerely,<br><br><u>".$name_approved."</u><br><i>UIP ATTENDANCE TRACKER STAFF</i></p></b></h4></div>";
	
                        // Content
                        $mail->Subject = "APPROVED INTERN";
                        $mail->Body    = '<img style="height:300px; width:650px" alt="Loading image..." src="cid:congrats"><br>'.$message.'<br><br><br><footer><div style="text-align: center; font-size: 12px;color:black; height:30px; width: 100%;"><p>Copyright &copy; '.date("Y").' Melham Construction Corporation | Project IT-30 Team</p></div></footer>';
                        $mail->send();
						
						echo "1";   
                        
		        }
		}
		else {
		  echo "0";
		}
     
    
    $conn->close();
    
function randomPass()
{
    $length = rand(10,20);
    $randomCharacters = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ_0123456789';
    $stringLength = strlen($randomCharacters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $randomCharacters[rand(0, $stringLength - 1)];
    }

    return $randomString;
}	    
?>