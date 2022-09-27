<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT * FROM intern_info, user_acc WHERE user_acc.username = intern_info.username AND user_acc_id = '".$id."'";



    $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern =  $row["department"];

        

        

    }

       

        echo $intern;

 $conn->close();

?>