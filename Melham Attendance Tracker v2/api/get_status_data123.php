<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT *

    FROM user_acc WHERE user_acc_id = '".$id."'";



    $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["user_acc_id"]. "|" . $row["firstname"]. "|" . $row["middle_name"]. "|" . $row["lastname"]. "|" . $row["profile_pic"]. "|" . $row["passwd"];

        

        

    }

       

        echo $intern;

 $conn->close();

?>