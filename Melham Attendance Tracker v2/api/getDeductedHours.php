<?php
	include("db/dbconnection.php");
    
    $id = $_GET['id']; 
    

    $sql2 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id ='$id'";
	$result2 = mysqli_query($conn, $sql2);
    $row2 = $result2->fetch_assoc();
    
    if($row2["extra_hours"]==null)
    {
        echo '0';
    }else{
    
        echo $row2["extra_hours"];        
    }       

        
$conn->close();
?>