<?php 



    $id = (int)$_GET['id']; 

   
include("db/dbconnection.php");

    $query = "SELECT *

    FROM team WHERE leader_id = '".$id."'";



     $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["team_id"];

        

       

    }

    if(!empty($intern)){

       

        echo $intern;

    }else{

        echo "0";

    }

       

  
$conn->close();


?>