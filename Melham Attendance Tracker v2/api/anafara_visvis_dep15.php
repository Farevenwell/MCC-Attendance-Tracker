<?php
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM intern_info where department='Over all Officer-in-Charge'  ORDER By intern_info_id ";
    $result = $conn->query($sql);
	
	$row = mysqli_num_rows($result);
	
	echo $row;
	$conn->close();
?>