<?php		include("db/dbconnection.php");    $id = $_GET["id"];        if($id == "")    {        $sql = "SELECT * FROM intern_report, user_acc where intern_report.user_acc_id=user_acc.user_acc_id";    }else{        $sql = "SELECT * FROM intern_report, user_acc where intern_report.user_acc_id=user_acc.user_acc_id and user_acc.user_acc_id = '$id'";    }        $result = $conn->query($sql);        if ($result->num_rows > 0) {            $response['data'] = array();      // output data of each row            while($row = $result->fetch_array()) {		  $view_report = array();		  $view_report["ID"] = $row["report_id"];          $view_report["Name"] = $row["firstname"]." ".$row["middle_name"]." ".$row["lastname"];		  $view_report["Title Name"] = $row["report_subject"];          $view_report["Files"] = "<a href=".$row["gdrive_link"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";                    $view_report["ticket_id"] = $row["ticket_no"];                              if($id == "")          {            $view_report["Status"] = $row["report_status"];          }else          {              if($row["report_status"] == "Pending")              {                $view_report["Status"] = "<label class='badge badge-danger'>".$row["report_status"]."</label>";              }else              {                $view_report["Status"] = "<label class='badge badge-info'>".$row["report_status"]."</label>";              }          }          if($row["date_fixed"] == null)          {              $view_report["Date"] = "Not yet fixed";          }else{              $view_report["Date"] = $row["date_fixed"];          }		  		            array_push($response['data'], $view_report);          	  }      echo json_encode($response);               } else {      echo json_encode(array('data'=>''));    }    $conn->close();?>