<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT *

    FROM team_project WHERE team_project_id = '".$id."'";



    $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $project_data = $row["team_project_id"]. "|" . $row["task_name"] . "|" . $row["date_assigned"] . "|" . $row["file_formats"]. "|" . $row["gdrive_link"];

        

       

    }

        echo $project_data;

  
 $conn->close();

?>