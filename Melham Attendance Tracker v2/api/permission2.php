<?php
	
	include("db/dbconnection.php");

	$id = $_POST['intern_id2'];
    $permission = 2;
    $rejectby = $_POST['reject_by'];
    $reasontext = $_POST['reason'];
	$randomno = rand(0,100000);
	$renames = 'rejected'.$randomno;
    
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');
    $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));



    $sql = "SELECT * FROM user_acc  where  user_acc_id='$id'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      
      while($row = $result->fetch_array()) {

				$name = $row["firstname"];
                $email = $row["username"];
				$newName= $renames.'|'.$row["username"];

                $sql2 = "UPDATE user_acc SET permission='$permission',username='$newName' WHERE user_acc_id='$id'";

                $sqlinsert = "INSERT INTO intern_applicant_logs ( user_id, staff_id, status, date ) VALUES ('$id','$rejectby','Rejected','$date' )";
                $conn->query($sqlinsert);
                
                $sqlstaff = "SELECT * FROM user_acc  where  user_acc_id='$rejectby'";
                $result2 = $conn->query($sqlstaff);
                 while($row = $result2->fetch_array()) {
                    $staff_name = $row['firstname'] . " ". $row['middle_name']." ".$row['lastname'];
                 }

				
			
				if ($conn->query($sql2) === TRUE) {

                        
                                               
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
                        $mail->AddEmbeddedImage('imageMail/reject.png', 'banner');
	                    //message
	
	
	                    $mail->isHTML(true);	
	                    $message = "<div style='border-left-width: 7px; border-left-style: solid; border-left-color: #0071BD; background-color: #d4dbd5; border-radius: 5px; width:650px;'><h4><b><p style='padding:15px 10px 15px 10px;'>Dear ".$name.",<br><br>It was a great pleasure to know you and thank you so much for your interest in Melham Construction Corporation Company. Unfortunately, we decided to decline your application.<br><br> After careful review, " .$reasontext. "<br><br>Kind regards,<br><br><u>".$staff_name."</u><br><i>UIP ATTENDANCE TRACKER STAFF</i></p></b></h4></div>";
	
                        // Content
                        $mail->Subject = "REJECTED INTERN";
                        $mail->Body    = '<img style="height:300px; width:650px" alt="Loading image..." src="cid:banner"><br>'.$message.'<br><br><br><footer><div style="text-align: center; font-size: 12px;color:black; height:30px; width: 100%;"><p>Copyright &copy; '.date("Y").' Melham Construction Corporation | Project IT-30 Team</p></div></footer>';;
                        $mail->send();
						

						echo "1";
				}
				else {
				        echo "0";
				}


          
	  }
      
     
      
    }else{
            echo "0";
    } 
    $conn->close();
?>