<?php

	include("db/dbconnection.php");
	$data['data'] = array();

	if(isset($_GET['specific_uid'])){
		$uid = $_GET['specific_uid'];
		$SQL = "SELECT document_id AS id, document_title AS title, file_format AS format, date_submitted AS submitted, deadline, gdrive_link AS gdrive, coordinator_name AS coordinator, coordinator_email AS email, status, signed_by AS signby_uid, date_signed, CONCAT_WS(' ', user_acc.firstname,user_acc.middle_name,user_acc.lastname) AS fullname FROM university_documents  INNER JOIN user_acc ON university_documents.user_acc_id = user_acc.user_acc_id WHERE university_documents.user_acc_id=$uid";
		$MYSQL_QUERY = $conn->query($SQL);

		while($row = $MYSQL_QUERY->fetch_array()){
			$result = array();

			$result['intern-name'] = $row['fullname'];
			$result['file-format'] = $row['format'];
			$result['date-submitted'] = $row['submitted'];
			$result['document-title'] = $row['title'];
			$result['document-deadline'] = $row['deadline'];
			$result['gdrive-link'] = "<a href=".$row["gdrive"]." target='_blank' style='text-decoration: none'>G-DRIVE LINK</a>";
			$result['coordinator-name'] = $row['coordinator'];
			$result['coordinator-email'] = $row['email'];
			

			if($row['signby_uid'] != "not yet signed"){
				$subSQL = "SELECT CONCAT_WS(' ', firstname, middle_name, lastname) AS signby FROM user_acc WHERE user_acc_id=".$row['signby_uid'];
				$MYSQL_SUBQUERY = $conn->query($subSQL);

				while($sub_row = $MYSQL_SUBQUERY->fetch_array()){
					$result['signed-by'] = $sub_row['signby'];
				}
				$result['document-status'] = $row['status'];
				$result['date-signed'] = $row['date_signed'];
				$result['action'] = "<label class='badge badge-info'>Signed</label>";
			}
			else{
			    $result['document-status'] = $row['status'];
				$result['signed-by'] = $row['signby_uid'];
				$result['date-signed'] = $row['date_signed'];
				$result['action'] = "<a onclick='signDocument(". $row['id'] .")'><button  class='btn-sm btn-gradient-success me-2' title='click to sign this document'>Sign</button></a>";
			}

			

			array_push($data['data'], $result);
		}
		echo json_encode($data);
	}

	else{

	    $SQL = "SELECT DISTINCT(user_acc_id) AS uid FROM university_documents";

	    $MYSQL_QUERY = $conn->query($SQL);

	    while($row = $MYSQL_QUERY->fetch_array()){
	       $result = array();
	       $uid = $row['uid'];



	       $subSQL = "SELECT (SELECT CONCAT_WS(' ', firstname, middle_name, lastname) FROM user_acc WHERE user_acc_id=$uid) AS fullname, (SELECT COUNT(status) FROM `university_documents` WHERE status='Pending' AND user_acc_id=$uid) AS numUnsigned, (SELECT COUNT(status) FROM `university_documents` WHERE status='Signed' AND user_acc_id=$uid) AS numSigned";

	       $MYSQL_SUBQUERY = $conn->query($subSQL);

	       while($sub_row = $MYSQL_SUBQUERY->fetch_array()){
	           $result['fullname'] = $sub_row['fullname'];
	           $result['unsigned'] = $sub_row['numUnsigned'];
	           $result['signed'] = $sub_row['numSigned'];
			   $result['action'] = "<a onclick='viewSpecificInternUnivDocs(". $uid .")'><button  class='btn-sm btn-gradient-success me-2' type='submit' value='View'>View</button></a>";
	       }

	       array_push($data['data'], $result);
	    }
		echo json_encode($data);
	}

  $conn->close();

?>
