<?php

	include("db/dbconnection.php");
    
    $id=$_GET["id"];

    $sql = "UPDATE project SET status = 'Already checked' WHERE project_id = '$id'";

    if ($conn->query($sql) === TRUE)
    {
        echo '1';
    }


    $conn->close();
?>