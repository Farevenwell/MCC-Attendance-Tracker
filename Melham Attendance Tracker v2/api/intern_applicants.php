<?php

	

	include("db/dbconnection.php");

    

    $permission = 0;

    $sql = "SELECT * FROM user_acc, intern_info where intern_info.username=user_acc.username AND user_acc.usertype='Intern' AND user_acc.permission!='".$permission."'";

    

    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {

      

      $response['data'] = array();

      // output data of each row

      

      while($row = $result->fetch_array()) {


          $sql2 = "SELECT * FROM intern_applicant_logs WHERE user_id='".$row['user_acc_id']."' " ;
          $result2 = $conn->query($sql2);
          
          while($row2 = $result2->fetch_array()) {
                $sql3 = "SELECT * FROM user_acc WHERE user_acc_id='".$row2['staff_id']."' " ;
                
                $result3 = $conn->query($sql3);
                
                while($row3 = $result3->fetch_array()) {
                    $view_permission = array();
                    $view_permission["Approved/Rejected By"] = $row3["firstname"]." ".$row3["middle_name"]." ".$row3["lastname"];
                    $view_permission["ID"] = $row["intern_info_id"];

                    $view_permission["Application ID"] =  $row["app_id"];
                    $view_permission["Date"] =  $row2["date"];

                    $view_permission["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];
                    

                    
                    

                    if($row["permission"] == 2)

                    {
                        $view_permission["Status"] = "<label class='badge badge-danger'><strong>Rejected</strong></label>";
                    
                    }else if($row['permission'] == 1){
                        $view_permission["Status"] = "<label class='badge badge-success'><strong>Approved</strong></label>";
                    } 
                    

                    

                    array_push($response['data'], $view_permission);
                }
          }

	  }

      echo json_encode($response);

     

      

    } else {

      echo json_encode(array('data'=>''));

    }

    $conn->close();

?>