<?php	include("db/dbconnection.php");        $id = $_GET['id'];     	    $sql2 = "SELECT * FROM intern_info WHERE username ='$id'";    $result2 = $conn->query($sql2);	    while($row2 = $result2->fetch_array())     {        $req_hrs = $row2["required_hours"];    }    $sql1 = "SELECT * FROM user_acc WHERE username ='$id'";    $result1 = $conn->query($sql1);        while($row1 = $result1->fetch_array())     {        $sql2 = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id ='".$row1["user_acc_id"]."'";		$result2 = mysqli_query($conn, $sql2);        $row2 = $result2->fetch_assoc();                $sql3 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id ='".$row1["user_acc_id"]."'";	    $result3 = mysqli_query($conn, $sql3);        $row3 = $result3->fetch_assoc();                            $sql4 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id ='".$row1["user_acc_id"]."'";	    $result4 = mysqli_query($conn, $sql4);        $row4 = $result4->fetch_assoc();                                $penalty = $row3["extra_hours"];        $deduction = $row4["extra_hours"];        $remaining_rs = $req_hrs - $row2["hrs_added"] - $deduction + $penalty;                       if($remaining_rs < 0){                        $remaining_rs1 = 0;             echo $remaining_rs1;        }else{             echo $remaining_rs;        }    }        $conn->close();?>