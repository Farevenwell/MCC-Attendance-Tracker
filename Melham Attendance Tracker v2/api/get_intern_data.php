<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT * FROM intern_info, user_acc WHERE intern_info.username=user_acc.username AND user_acc.user_acc_id = '$id'";



   $result = $conn->query($query);

   

    

    while ($row = $result->fetch_array()) {

      

       

        $intern = $row["user_acc_id"]. "|" . $row["app_id"] . "|" . $row["firstname"] . "|" . $row["middle_name"] . "|" . $row["lastname"] . "|" . $row["street"] . "|" . $row["barangay"] . "|" . $row["city"] . "|" . $row["birthdate"] . "|" . $row["religion"] . "|" . $row["sex"] . "|" . $row["civil_status"] . "|". $row["username"]. "|" . $row["mobile_no"]. "|" . $row["company"] . "|" . $row["department"] . "|" . $row["intern_status"] . "|" . $row["startdate"] . "|" . $row["estimated_end_date"] . "|" .  $row["required_hours"] . "|" . $row["gdrive_link"] . "|" . $row["start_shift"] . "|" .  $row["end_shift"] . "|" . $row["profile_pic"] . "|" . $row["shift"]. "|" . $row["province"] . "|" . $row["school"] . "|" . $row["schedule"];

        

       

    }

        echo $intern;

  

    $conn->close();

?>