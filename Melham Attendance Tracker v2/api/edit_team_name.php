<?php


	include("db/dbconnection.php");
	
        $team_name_id = $_POST['team_name_id'];
    
        $change_team_name1233 = $conn->real_escape_string($_POST['change_team_name123']);
        $change_team_name12333 = strtoupper($change_team_name1233);
        $change_team_name123 = trim($change_team_name12333);




					$sql1 = "UPDATE team SET  team_name='$change_team_name123' where team_id='$team_name_id'";
					if ($conn->query($sql1) === TRUE) 
					{
						echo "1" ;			
				
					} else 
					{
						echo "0";
					}


        
		
        $conn->close();
    
	
	

?>