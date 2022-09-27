<head>
 <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<?php
require 'config.php';

    $sqla = "SELECT * FROM smtp_gmail_guide LIMIT 1";

    $resulta = $con->query($sqla);

    while($rowa = $resulta->fetch_array()) {
     
        $smtpEmail = $rowa["smtp_gmail"];
        $smtpPass = $rowa["smtp_random"];
    }

date_default_timezone_set('Asia/Manila');

if(isset($_POST["email"])){
    //fetch email inputted
    $emailTo = $_POST["email"];
    //auto generated code to be inserted in the database
    $code = uniqid(true);
    // query for inserting the code and emial in the reset passwords table
    $query = mysqli_query($con, "INSERT INTO resetpasswords(code,email) VALUES ('$code', '$emailTo')");
    
    //if query is not exceuted then code will not go through
    if(!$query){
        exit("Error");
    }
    
    //check if the user is permitted
    $check_perimission  = "select * from user_acc where username = '$emailTo'";
    $result_permission  = mysqli_query($con, $check_perimission); 
    if(mysqli_num_rows($result_permission ) > 0){
        $row= mysqli_fetch_assoc($result_permission);
        if($row['permission'] == "0"){ 

        echo "<script>
        setTimeout(function() {
            swal({
                type: 'error',
                title: 'Account is not yet permitted!',
                text: 'Sorry we cannot send a password reset link to your email since this account is not yet permitted by the company, please wait until the admin permits this account by informing you via email thank you.'
            }, function() {
                window.location = 'index.html';
            });
        }, 1000);
    </script>"; 
           
            exit();
        }
    }
    //check if email is permitted ends here
    
    //check user type trapping
    //check if the user is staff
    $check_staff = "select * from user_acc where username = '$emailTo'";
    $result_check_staff  = mysqli_query($con, $check_staff); 
    if(mysqli_num_rows($result_check_staff) > 0){
        $row= mysqli_fetch_assoc($result_check_staff);
        if($row['usertype'] == "Staff"){ 

        echo "<script>
        setTimeout(function() {
            swal({
                type: 'error',
                title: 'This email belongs to a staff!',
                text: 'Sorry we cannot send a password reset link to this email since this is a staff account.Resetting password via email is only available for interns.'
            }, function() {
                window.location = 'index.html';
            });
        }, 1000);
    </script>"; 
           
            exit();
        }
    }
    
    //check if the user is admin
    $check_staff = "select * from user_acc where username = '$emailTo'";
    $result_check_staff  = mysqli_query($con, $check_staff); 
    if(mysqli_num_rows($result_check_staff) > 0){
        $row= mysqli_fetch_assoc($result_check_staff);
        if($row['usertype'] == "Admin"){ 

        echo "<script>
        setTimeout(function() {
            swal({
                type: 'error',
                title: 'This email belongs to an admin!',
                text: 'Sorry we cannot send a password reset link to this email since this is an Admin account.Resetting password via email is only available for interns.'
            }, function() {
                window.location = 'index.html';
            });
        }, 1000);
    </script>"; 
           
            exit();
        }
    }
    //check user type ends here
    $check_email = mysqli_query($con, "SELECT username FROM user_acc where username = '$emailTo' ");

    //trapping for one day request only
    if(mysqli_num_rows($check_email) > 0){
        
    $currentDate = date('Y-m-d');
    
    $sql4 = "SELECT * FROM user_acc WHERE password_updated='$currentDate' AND username='$emailTo'";
	$result4 = $con->query($sql4);
        
    if(mysqli_num_rows($result4)!=0)
    {

   echo "<script>
        setTimeout(function() {
            swal({
                type: 'error',
                title: 'Password reset limit!',
                text: 'You can only receive a password reset link once a day. Please wait until tomorrow.'
            }, function() {
                window.location = 'index.html';
            });
        }, 1000);
    </script>";

    }else{
    //query for updating reset date
    $sql2 = mysqli_query($con, "UPDATE user_acc SET password_updated = '$currentDate' WHERE username = '$emailTo'");
    //link to be send to the email
    $url = "<a href='https://melhamconstruction.ph/uip/attendance/resetPassword.php?code=$code'>Password Reset Link</a>";

    //fetch email to be send to the email
    $name = $emailTo;
	
  	require_once __DIR__.'/api/vendor/autoload.php';
	
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
    $mail->addAddress($name);
	$mail->addReplyTo($smtpEmail,'Melham Construction Corporation');
    $mail->AddEmbeddedImage('api/imageMail/resetpassword.png', 'banner');
	//message
	
	
	$mail->isHTML(true);	
	$message = "<div style='border-left-width: 7px; border-left-style: solid; border-left-color: #0071BD; background-color: #d4dbd5; border-radius: 5px; width:650px;'><h4><b><p style='padding:15px 10px 15px 10px;'>Hi ".$name.",<br><br>There was a request to change your password!<br><br>If you did not make this request then please ignore this email.<br><br>Otherwise, please click this link to change your password: ".$url." <br><br>Thanks,<br><br>The Project IT-30 Team</p></b></h4></div>";
	
    // Content
    $mail->Subject = "PASSWORD RESET";
    $mail->Body    = '<img style="height:300px; width:650px" alt="Loading image..." src="cid:banner"><br>'.$message.'<br><br><br><footer><div style="text-align: center; font-size: 12px;color:black; height:30px; width: 100%;"><p>Copyright &copy; '.date("Y").' Melham Construction Corporation | Project IT-30 Team</p></div></footer>';
    $mail->send();
						
     echo '<script>
        setTimeout(function() {
            swal({
                title: "Password reset link sent!",
                text: "Please check your email/spam messages for the password reset link. Thank you!",
                type: "success"
            }, function() {
                window.location = "index.html";
            });
        }, 1000);
    </script>';                         
	
    }
	}else{

    echo "<script>
            setTimeout(function() {
                swal({
                    type: 'error',
                    title: 'Non-existing email!',
                    text: 'The email does not exist in the system.'
                }, function() {
                    window.location = 'index.html';
                });
            }, 1000);
        </script>";

       exit();

    }
  }
?>
