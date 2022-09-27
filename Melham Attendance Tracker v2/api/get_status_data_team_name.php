<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT * FROM team, user_acc WHERE user_acc.user_acc_id = team.leader_id AND team.team_id = '".$id."'";



    $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["user_acc_id"]. "|" . $row["firstname"]. "|" . $row["middle_name"]. "|" . $row["lastname"]. "|" . $row["profile_pic"]. "|" . $row["team_name"];

        

        

    }

       

        echo $intern;

 $conn->close();

?>