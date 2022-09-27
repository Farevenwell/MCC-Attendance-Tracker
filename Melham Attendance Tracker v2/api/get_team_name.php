<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT *

    FROM team WHERE leader_id = '".$id."'";



   $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["team_id"]. "|" . $row["team_name"];

        

       

    }

       

        echo $intern;
$conn->close();
?>