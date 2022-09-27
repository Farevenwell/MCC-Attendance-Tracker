<?php





	include("db/dbconnection.php");

	

    if(isset($_POST['user_acc_id']) && isset($_POST['reason']) && isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['leave_type'])){



        $user_acc_id = $_POST['user_acc_id'];

         $reason = $conn->real_escape_string($_POST['reason']);

		$from_date = $_POST['from_date'];

        $to_date = $_POST['to_date'];

		$leave_type = $_POST['leave_type'];

		$pending_leave = 'Pending';



		

		

	            $sql1 = "INSERT INTO intern_leave (user_acc_id, reason_leave, leave_from, leave_to, leave_type, leave_status) VALUES ('$user_acc_id', '$reason', '$from_date', '$to_date', '$leave_type', '$pending_leave')";

				if ($conn->query($sql1) === TRUE) 

				{

					echo "1" ;			

			

				} else 

				{

					echo "0";

				}

			

        

        $conn->close();

    }

	



?>