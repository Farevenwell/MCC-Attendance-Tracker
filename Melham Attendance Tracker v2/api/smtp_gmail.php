<?php


	include("db/dbconnection.php");
	
    if(isset($_POST['smtp_gmail']) && isset($_POST['random_letters'])){
        
        $smtp_gmail = $conn->real_escape_string($_POST['smtp_gmail']);
        $random_letters = $conn->real_escape_string($_POST['random_letters']);
		
		
	            $sql1 = "INSERT INTO smtp_gmail_guide (smtp_gmail, smtp_random) VALUES ('$smtp_gmail', '$random_letters')";
				if ($conn->query($sql1) === TRUE) 
				{
					echo "1" ;			
			
				} else 
				{
					echo "0";
				}
			
        
        $conn->close();
    }
	

?>