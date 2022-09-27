<?php


	include("db/dbconnection.php");
	
	date_default_timezone_set('Asia/Manila');
	
        $user_acc_id_intern = $_POST['user_acc_id_intern'];
        $user_acc_id_staff_admin = $_POST['user_acc_id_staff_admin'];
        $intern_status = "Offboarding";
        $Approved = "Approved";
        
        

        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');
        $date = date('F j, Y', strtotime($currentDate)) ." at ".date('g:i A', strtotime($currentTime));
        
                       
                        $sql1 = "UPDATE user_acc t1 
									JOIN requested_intern_status t2 ON (t1.user_acc_id = t2.user_acc_id) JOIN intern_info t3 ON (t1.username = t3.username)  
									SET t3.intern_status = '$intern_status',
										t2.requested_status = '$Approved',
										t2.approved_decline_by = '$user_acc_id_staff_admin',
										t2.date_approved_decline = '$date'

									WHERE t2.requested_id='$user_acc_id_intern'";
									
						if ($conn->query($sql1) === TRUE) 
						{
							echo "1" ;			
					
						} else 
						{
							echo "0";
						}

		
        $conn->close();
    
	
	

?>