<?php
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM intern_info where intern_status='Unassigned'  ORDER By intern_info_id ";
    $result = $conn->query($sql);
	$row = mysqli_num_rows($result);

        $sql1 = "SELECT * FROM intern_info where intern_status='Ongoing'  ORDER By intern_info_id ";
        $result1 = $conn->query($sql1);
        $row1 = mysqli_num_rows($result1);
    
            $sql2 = "SELECT * FROM intern_info where intern_status='Offboarding'  ORDER By intern_info_id ";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_num_rows($result2);
                
                $sql3 = "SELECT * FROM intern_info where intern_status='Completed'  ORDER By intern_info_id ";
                $result3 = $conn->query($sql3);
                $row3 = mysqli_num_rows($result3);
                
            
                    $sql4 = "SELECT * FROM intern_info where intern_status='Terminated'  ORDER By intern_info_id ";
                    $result4 = $conn->query($sql4);
                    $row4 = mysqli_num_rows($result4);
                   
 
	
	
	echo $row. "|" .$row1. "|" .$row2. "|" .$row3. "|" .$row4 ;
?>