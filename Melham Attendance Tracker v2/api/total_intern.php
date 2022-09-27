<?php
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM user_acc where usertype='Intern'  ORDER By user_acc_id ";
    $result = $conn->query($sql);
	
	$row = mysqli_num_rows($result);
	
	echo $row;
	$conn->close();
?>