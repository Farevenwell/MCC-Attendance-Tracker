<?php 
   $id = (int)$_GET['id'];

    include("db/dbconnection.php");
  
   
  
    $sql = "SELECT * FROM user_acc, staff_info  WHERE user_acc.username = staff_info.username AND user_acc.user_acc_id = '$id'";

    $result = $conn->query($sql);
    
    while($row = $result->fetch_array()){ 

        $user_data = $row["user_acc_id"]. "|" . $row["firstname"] . "|" . $row["middle_name"] . "|" . $row["lastname"] . "|" . $row["username"]. "|" . $row["passwd"]. "|" . $row["usertype"]. "|" . $row["profile_pic"]. "|" . $row["department"]. "|" . $row["company"]. "|" . $row["staff_position"]. "|" . $row["team_handled"];
        

    }
    
        echo $user_data;
  
    $conn->close();
?>