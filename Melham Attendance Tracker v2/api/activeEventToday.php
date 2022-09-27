<?php

	include("db/dbconnection.php");

    date_default_timezone_set('Asia/Manila');

    $currentDate = date("Y-m-d H:i:s");

    $sql = "SELECT * FROM announcement WHERE start <= '$currentDate' AND end >= '$currentDate' ORDER By id";

    $result = $conn->query($sql);

	
	$row = mysqli_num_rows($result);


	echo $row;

    $conn->close();
?>