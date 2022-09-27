<?php

	include("db/dbconnection.php");
	

       
        if(isset($_POST['user_acc_id']) && isset($_POST['deductedby']) && isset($_POST['deduct_hrs']) && isset($_POST['deduct_hrs_reason']) && isset($_POST['web_id1'])){

            $id = $_POST['user_acc_id'];
            $deductedby = $_POST['deductedby'];
            $deduct_hrs = $_POST['deduct_hrs'];		
            $deduct_hrs_reason = $_POST['deduct_hrs_reason'];
            $deducted = 'Deducted';
            $status_payment = 'Hours Added';
            $web_id = $_POST['web_id1'];
    
            
            
                    $sql1 = "INSERT INTO hours_added (user_acc_id, hours_added, deduction_penalty_reason, deducted_penalty_by, deducted_penalty) VALUES ('$id', '$deduct_hrs', '$deduct_hrs_reason', '$deductedby', '$deducted')";
                    if ($conn->query($sql1) === TRUE) 
                    {
                        $sql1 = "UPDATE attended_webinar SET status_payment='$status_payment' where webinar_id='$web_id'";
                            if ($conn->query($sql1) === TRUE) 
                            {
                                echo "1";	             
                            } else 
                            {
                                echo "0";
                            }		
                
                    } else 
                    {
                        echo "0";
                    }
                
            
            $conn->close();
        }
    
	
?>