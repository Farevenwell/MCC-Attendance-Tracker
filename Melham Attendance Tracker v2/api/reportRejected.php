<?php
	date_default_timezone_set('Asia/Manila');
	   
    include("db/dbconnection.php");
 
    $id = $_GET["id"];

    $sql = "DELETE FROM reported_intern WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "1";
    }
    
    $conn->close();

?>