<?php 

    header('Content-Type: application/json');

    header('Access-Control-Allow-Origin: *');

    

    $id = $_GET['id']; 

    include("db/dbconnection.php");

    $query = "SELECT *

    FROM user_acc, intern_info

    WHERE intern_info.username=user_acc.username AND user_acc.user_acc_id = '".$id."'";



    $result = $conn->query($query);

	

    

    while ($row = $result->fetch_array()) {

		

		if(!empty($row["profile_pic"]))

		{

			$get_username = $row["firstname"]. "|" . $row["lastname"]. "|" . $row["intern_status"]. "|" . $row["profile_pic"] . "|" . $row["birthdate"] . "|" . $row["view_date"];

		}

		else

		{

			$default = 'default.jpg';

			$get_username = $row["firstname"]. "|" . $row["lastname"]. "|" . $row["intern_status"]. "|" . $default;

		}

		

        

       

    }

        echo $get_username;

  $conn->close()
?>