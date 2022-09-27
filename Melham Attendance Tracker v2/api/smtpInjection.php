<?php

 $sql = "SELECT * FROM smtp_gmail_guide LIMIT 1";

 $result = $conn->query($sql);

 while($row = $result->fetch_array()) {
     
     $smtpEmail = $row["smtp_gmail"];
     $smtpPass = $row["smtp_random"];
 }
    

?>