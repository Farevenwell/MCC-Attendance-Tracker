<?php

	include("db/dbconnection.php");
	

       
        if(isset($_POST['user_acc_id']) && isset($_POST['deductedby']) && isset($_POST['deduct_hrs']) && isset($_POST['deduct_hrs_reason'])){

            $id = $_POST['user_acc_id'];
            $deductedby = $_POST['deductedby'];
            $deduct_hrs = $_POST['deduct_hrs'];		
            $deduct_hrs_reason = $_POST['deduct_hrs_reason'];
            $deducted = 'Deducted';
    
    
            
            
                    $sql1 = "INSERT INTO hours_added (user_acc_id, hours_added, deduction_penalty_reason, deducted_penalty_by, deducted_penalty) VALUES ('$id', '$deduct_hrs', '$deduct_hrs_reason', '$deductedby', '$deducted')";
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