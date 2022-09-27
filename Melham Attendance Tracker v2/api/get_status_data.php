<?php 



    $id = (int)$_GET['id']; 

    include("db/dbconnection.php");

    $query = "SELECT *

    FROM user_acc, intern_info WHERE user_acc.username=intern_info.username AND intern_info_id = '".$id."'";



    $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["intern_info_id"]. "|" . $row["firstname"]. "|" . $row["middle_name"]. "|" . $row["lastname"]. "|" . $row["profile_pic"]. "|" . $row["intern_status"];

        

        

    }

       

        echo $intern;

 $conn->close();



?>