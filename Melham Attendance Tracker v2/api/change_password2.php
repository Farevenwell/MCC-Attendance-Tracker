<?php
    header("Content-Type: application/json; charset=UTF-8");
    
    if(isset($_POST['pass'])){
        
        include("db/dbconnection.php");

        $pwd = md5($conn->real_escape_string($_POST['pass']));

        $sql = "SELECT * FROM user_acc WHERE BINARY passwd = '$pwd'";
        $result = $conn->query($sql);
        $response = array();

        if ($result->num_rows > 0) {
            array_push($response, "1");
        }
        else{
            array_push($response, "0");
        }

        $conn->close();

	    echo json_encode($response);
    }
?>
