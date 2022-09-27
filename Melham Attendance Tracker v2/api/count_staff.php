<?php

	include("db/dbconnection.php");

    $time = time();

    $sql = "SELECT * FROM user_acc WHERE last_login > '$time' AND usertype != 'Intern' ORDER By user_acc_id";

    $result = $conn->query($sql);

	
	$row = mysqli_num_rows($result);


	echo $row;

    $conn->close();
?>