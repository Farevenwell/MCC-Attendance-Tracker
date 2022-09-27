<?php

	include("db/dbconnection.php");
	

       
        if(isset($_POST['user_acc_id']) && isset($_POST['penaltyby']) && isset($_POST['penalty_hrs']) && isset($_POST['penalty_hrs_reason'])){

            $id = $_POST['user_acc_id'];
            $penaltyby = $_POST['penaltyby'];
            $penalty_hrs = $_POST['penalty_hrs'];		
            $penalty_hrs_reason = $_POST['penalty_hrs_reason'];
            $deducted_penalty = 'Penalty';
    
    
            
            
                    $sql1 = "INSERT INTO hours_added (user_acc_id, hours_added, deduction_penalty_reason, deducted_penalty_by, deducted_penalty) VALUES ('$id', '$penalty_hrs', '$penalty_hrs_reason', '$penaltyby', '$deducted_penalty')";
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