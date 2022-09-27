<?php


	include("db/dbconnection.php");
	
    if(isset($_POST['user_acc_id_change_pass']) && isset($_POST['change_pass1'])){

        $user_acc_id_change_pass = $_POST['user_acc_id_change_pass'];
        $change_pass1 = $_POST['change_pass1'];
        $hashed_pass = md5($change_pass1);
		
			
                        $sql1 = "SELECT * FROM user_acc WHERE  user_acc_id='".$user_acc_id_change_pass."' AND passwd='".$change_pass1."'";

                        $result2 = $conn->query($sql1);

                        if(mysqli_num_rows($result2)>0)

                        {

                             $sql2 = "UPDATE user_acc SET passwd='$change_pass1' where user_acc_id='$user_acc_id_change_pass'";
                
                                if ($conn->query($sql2) === TRUE) 
                				{
                					echo "1" ;			
                			
                				} else 
                				{
                					echo "0";
                				}

                        }else
                        {
                            
                            $sql3 = "UPDATE user_acc SET passwd='$hashed_pass' where user_acc_id='$user_acc_id_change_pass'";
                
                                if ($conn->query($sql3) === TRUE) 
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