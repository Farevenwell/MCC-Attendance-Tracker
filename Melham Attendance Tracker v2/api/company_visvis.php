<?php
	include("db/dbconnection.php");
    
    $sql = "SELECT * FROM intern_info where company='VisVis Travel & Tours'  ORDER By intern_info_id ";
    $result = $conn->query($sql);
	
	$row = mysqli_num_rows($result);
	
	echo $row;
	$conn->close();
?>