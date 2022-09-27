<?php
	include("db/dbconnection.php");
    
    $id = $_GET['id']; 
    
    
    $sql = "SELECT * FROM intern_info WHERE username ='$id'";
    $result = $conn->query($sql);
	
    while($row = $result->fetch_array()) 
    {
         echo $row["required_hours"]; 
    }
	

	$conn->close();
?>