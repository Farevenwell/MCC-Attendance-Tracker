<?php

	include("db/dbconnection.php");
	

        $team_id = $_POST['team_id'];
        $leader_id = $_POST['leader_id'];	
        $former_lead_id = $_POST['former_lead_id'];	
        $position = 0;
        $new_lead = 1;		

            $sql = "UPDATE team SET leader_id='$leader_id' where team_id='$team_id'";
              if ($conn->query($sql) === TRUE) 
              {
                $sql1 = "UPDATE user_acc SET position='$new_lead' where user_acc_id='$leader_id'";
                    if ($conn->query($sql1) === TRUE) 
                    {
                        $sql13 = "UPDATE user_acc SET position='$position' where user_acc_id='$former_lead_id'";
                            if ($conn->query($sql13) === TRUE) 
                            {
                                echo "1";
                            } else {
                                echo "2";
                            }
                    } else {
                        echo "2";
                    }			
            
              } else 
              {
                echo "0";
              }
			
        
        
        $conn->close();
    
	
?>