<?php 



    $id = (int)$_GET['id']; 

    include("db/dbconnection.php");

    $query = "SELECT *

    FROM webinar WHERE webinar_id = '".$id."'";



   $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["title_name"]. "|" . $row["webinar_desc"] . "|" . $row["meeting_link"] . "|" . $row["speaker"] . "|" . $row["meeting_date"] . "|" . $row["meeting_time"]. "|" . $row["webinar_id"]. "|" . $row["registration_fee"];

        

       

    }

        echo $intern;

  
 $conn->close();

?>