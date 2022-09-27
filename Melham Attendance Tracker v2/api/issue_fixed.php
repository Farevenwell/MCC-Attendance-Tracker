<?php
	
	date_default_timezone_set('Asia/Manila');
	   
    include("db/dbconnection.php");
    
    $id = $_GET["id"];
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i');
    $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));
    

    $sql = "UPDATE intern_report SET report_status = 'Fixed', date_fixed ='$date' WHERE report_id = '$id'";
    
    
    if (mysqli_query($conn, $sql)) {

        $sql0 = "SELECT * FROM intern_report WHERE report_id ='$id'";
    
        $result0 = $conn->query($sql0);
    
        while($row0 = $result0->fetch_array()) 
        {
            $userid = $row0["user_acc_id"]; 
        }


        
        
        $sql1 = "SELECT * FROM user_acc WHERE user_acc_id ='$userid'";
    
        $result1 = $conn->query($sql1);
    
        while($row1 = $result1->fetch_array()) 
        {
            $firstname = $row1["firstname"]; 
            $email =  $row1["username"];
        }
        
        $sql2 = "SELECT * FROM intern_report WHERE report_id ='$id'";
    
        $result2 = $conn->query($sql2);
    
        while($row2 = $result2->fetch_array()) 
        {
            $ticket_id = $row2["ticket_no"]; 
            $files = "<a href=".$row2["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";
            $subject = $row2["report_subject"];
            $details = $row2["report_details"];
            $status = $row2["report_status"];
        } 
        
                        $name = $firstname;
  	                    require_once __DIR__.'/vendor/autoload.php';
	                    include("smtpInjection.php");
	                    
	                    
	                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

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
	                    //message
	
	
	                    $mail->isHTML(true);	
	                    $message = "Good Day!<br><br> Thank you for submitting your issue, this will greatly help the system to work as smooth as possible.<br><br> The report you have submitted has been successfully fixed by our system developer.<br><br> If you encounter the same issue or problem again, please reply to this email. Thank you and have a nice day!<br><br><b>Ticket ID:</b> ".$ticket_id."<br><b>Subject:</b> ".$subject."<br><b>Submitted Files:</b> ".$files."<br><b>Report Issue Status:</b> ".$status."<br><br><b>More Deatils about the Issue:</b> ".$details."<br><br>Thanks,<br><br>Project IT-30 Team";
	
                        // Content
                        $mail->Subject = "SUBMITTED ISSUE HAS BEEN FIXED | ".$ticket_id;
                        $mail->Body    = $message.'<br><br><br><footer><div style="text-align: center; font-size: 12px;color:black; height:30px; width: 100%;"><p>Copyright &copy; '.date("Y").' Melham Construction Corporation | Project IT-30 Team</p></div></footer>';
                        $mail->send();        
        
        
        
        
        
        
        
        
        
        
        echo "1";
    }else{
        echo "0";
    }
    
    $conn->close();
    
?>