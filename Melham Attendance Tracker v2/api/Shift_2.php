<?php
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM user_acc where shift='2' AND permission='1'  ORDER By user_acc_id ";
    $result = $conn->query($sql);
	
	$row = mysqli_num_rows($result);
	
	echo $row;
	
?>