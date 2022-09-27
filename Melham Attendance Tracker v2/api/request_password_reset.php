<html>
<?php
    date_default_timezone_set('Asia/Manila');
    
    include("db/dbconnection.php");

    $email = $_POST['email'];
    $password = randomPass();
    $hashed_pass = md5($password);
    $currentDate = date('Y-m-d');
    
	$sql = "SELECT * FROM user_acc WHERE username='$email'";
	$result = $conn->query($sql);

	if(mysqli_num_rows($result)==0)
	{
	    ?>
		<script>
		    alert("Invalid Email! Please try again!"); 
		    window.location.replace("../index.html");
		</script>;
	
	<?php
	}else{
	$sql4 = "SELECT * FROM user_acc WHERE password_updated='$currentDate' AND username='$email'";
	$result4 = $conn->query($sql4);
    
    if(mysqli_num_rows($result4)!=0)
    {
       echo '<script>alert("You have already changed your password today! WAG GARAPAL!"); window.location.href="../index.html";</script>';
    }else{    
    
    $sql2 = "UPDATE user_acc SET passwd = '$hashed_pass', password_updated = '$currentDate' WHERE username = '$email'";
    
    if(mysqli_query($conn, $sql2)) {

	$name = $email;
	
	$email1 = "feric08c@gmail.com";
	$message = "Dear ".$name.", \n\nWe have replace your old password with the new password!";
								
	$email_from = "Melham Construction Corporation ".$email1;
	$email_subject = "PASSWORD RESET";
	$email_body = "$message\n"."\nBelow is your username & new password. Please don't share it to anyone. Thank you!\n\nWAG MO NA PO SANANG KALIMUTAN GAYA NG PAG LIMOT MO SA KANYA!\n\nusername: ".$email."\npassword: ".$password." \n\n-ADMIN";
                        
	$to = $email;
                                                               
	$headers ="From: $email_from \r\n";
        
	$headers .="Reply-To: $email1 \r\n";
								       
	mail($to,$email_subject,$email_body,$headers);
                                
	echo '<script>alert("Please check your email for your new password. Thank you!"); window.location.href="../index.html";</script>';
    }
    }
	}
	


function randomPass()
{
    $length = rand(10,20);
    $randomCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
    $stringLength = strlen($randomCharacters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $randomCharacters[rand(0, $stringLength - 1)];
    }

    return $randomString;
}	

?>
</html>