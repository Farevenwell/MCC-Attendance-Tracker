<?php 

	$servername="localhost";

	$username="u532861242_admin";

	$password="y!P(FWS!2]DYfNz^";

	$database="u532861242_timev2";

	

	$conn=mysqli_connect($servername, $username, $password, $database);

			

	if(!$conn){

		die("Connection failed!". mysqli_connect_error());

	}



    $id = (int)$_GET['id']; 



    $sql2 = "SELECT * FROM user_acc WHERE user_acc_id ='$id'";



    $result2 = $conn->query($sql2);



    if($row2 = $result2->fetch_assoc()) {

        $email = $row2["username"];

    }



    $query = "SELECT *

    FROM user_acc, intern_info WHERE user_acc.username=intern_info.username AND user_acc.username = '$email'";



    $result5 = $conn->query($query);

   

    

    while ($row = $result5->fetch_array()) {

      

       

        $intern = $row["intern_info_id"]. "|" . $row["firstname"]. "|" . $row["middle_name"]. "|" . $row["lastname"]. "|" . $row["profile_pic"]. "|" . $row["intern_status"];

        

        

    }

      

    echo $intern;

   $conn->close();





?>