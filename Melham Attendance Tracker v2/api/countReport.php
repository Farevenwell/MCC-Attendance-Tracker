<?php

	include("db/dbconnection.php");

    $id = $_GET["id"];

    $sql = "SELECT * FROM reported_intern WHERE report_count = '1' AND user_acc_id = '$id' ORDER By user_acc_id";

    $result = $conn->query($sql);
	
	$row = mysqli_num_rows($result);

	echo $row;

    $conn->close();
?>