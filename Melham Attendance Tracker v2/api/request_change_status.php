<?php


	include("db/dbconnection.php");
	

        $user_acc_id_requesting = $_POST['user_acc_id_requesting'];
        $now = date_create()->format('Y-m-d');
        $requesting = "request";
		if(isset($_POST['user_acc_id_requesting']))
		{
			$sql = "SELECT * FROM requested_intern_status WHERE user_acc_id	='".$_POST['user_acc_id_requesting']."'";
			$result = $conn->query($sql);
			
			if(mysqli_num_rows($result)>0)
			{
				echo '2';
			}
			else
			{
					$sql1 = "INSERT INTO requested_intern_status (user_acc_id, requested_status, date_requested) VALUES ('$user_acc_id_requesting', '$requesting', '$now')";
					if ($conn->query($sql1) === TRUE) 
					{
						echo "1" ;			
				
					} else 
					{
						echo "0";
					}
				
			}

        	}
		
        $conn->close();
    
	

?>