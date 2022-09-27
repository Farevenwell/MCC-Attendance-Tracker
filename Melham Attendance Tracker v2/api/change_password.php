<?php
    header("Content-Type: application/json; charset=UTF-8");

    include("db/dbconnection.php");
    
    if(isset($_POST['pass'])){
        
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
    else if(isset($_POST['password'], $_POST['new-password'], $_COOKIE['user_id'])){

        $old_pwd = md5($conn->real_escape_string($_POST['password']));
        $new_pwd = md5($conn->real_escape_string($_POST['new-password']));
        $uid = $_COOKIE['user_id'];

        $sql = "UPDATE user_acc SET passwd='$new_pwd' WHERE user_acc_id='$uid' AND passwd='$old_pwd'";

        if($conn->query($sql) === TRUE){
            echo "1";
        }
        else{
            echo "Error description: " . $sql -> error;
        }

        $conn->close();
    }
    else{
        echo "0";
    }
?>
