<?php

	include("db/dbconnection.php");
	
  
    
    
    if(isset($_POST['co_lead_id']) && isset($_POST['team_name1'])){

        $co_lead_id = $_POST['co_lead_id'];
        $team_name1 = $_POST['team_name1'];	
        $position = 2;		
			

                $sql1 = "UPDATE user_acc t1 
							JOIN team t2 
							SET t1.position = '$position', 
								t2.co_leader_id = '$co_lead_id'
							WHERE t1.user_acc_id = '$co_lead_id' AND t2.team_name = '$team_name1'";
							
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