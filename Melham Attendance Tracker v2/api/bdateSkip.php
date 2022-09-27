<?php

date_default_timezone_set('Asia/Manila');
include("db/dbconnection.php");

$currentDate = date('Y-m-d');

$id = $_GET["id"];

$sql = "UPDATE user_acc SET view_date ='$currentDate' WHERE user_acc_id = '$id'";

if ($conn->query($sql) === TRUE)
{
  echo "1";  
}else{
  echo "0";
}

$conn->close;

?>