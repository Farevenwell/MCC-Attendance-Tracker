<?php 

   include("db/dbconnection.php");

    $query = "SELECT * FROM smtp_gmail_guide ORDER BY smtp_id DESC LIMIT 1";



    $result = $conn->query($query);

    while ($row = $result->fetch_array()) 
    {

        $smtp_gmail = $row["smtp_gmail"]. "|" . $row["smtp_random"];


    }

        echo $smtp_gmail;

 $conn->close();

?>