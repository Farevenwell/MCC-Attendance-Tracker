<?php 

    header('Content-Type: application/json');

    header('Access-Control-Allow-Origin: *');



    $id = $_GET['id']; 

    include("db/dbconnection.php");

    $query = "SELECT *

    FROM user_acc

    WHERE user_acc_id = '".$id."'";



   $result = $conn->query($query);

	

    

    while ($row = $result->fetch_array()) {

		

		if(!empty($row["profile_pic"]))

		{

			$get_username = $row["firstname"]. "|" . $row["lastname"]. "|" . $row["usertype"]. "|" . $row["profile_pic"];

		}

		else

		{

			$default = 'default.jpg';

			$get_username = $row["firstname"]. "|" . $row["lastname"]. "|" . $row["usertype"]. "|" . $default;

		}

		

        

       

    }

        echo $get_username;

  $conn->close();
?>