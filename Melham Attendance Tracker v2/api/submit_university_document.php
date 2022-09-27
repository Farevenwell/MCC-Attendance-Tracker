<?php





	include("db/dbconnection.php");

    if(isset($_POST['user_acc_id']) && isset($_POST['doc_title']) && isset($_POST['file_format']) && isset($_POST['date_submitted']) && isset($_POST['deadline']) && isset($_POST['gdrive_link'])){



        $user_acc_id = $_POST['user_acc_id'];

		$doc_title = $_POST['doc_title'];

        $file_format = $_POST['file_format'];

        $date_submitted = $_POST['date_submitted'];
        
        $deadline = $_POST['deadline'];

		$gdrive_link = $_POST['gdrive_link'];
		
		$ojt_email = $_POST['ojt_email'];
		
		$ojt_name = $_POST['ojt_name'];

        $now = date_create()->format('Y-m-d');

		

		

	            $sql1 = "INSERT INTO university_documents (coordinator_name,coordinator_email,user_acc_id, document_title, file_format, date_submitted, deadline, gdrive_link, status, signed_by, date_signed) VALUES ('$ojt_name','$ojt_email','$user_acc_id','$doc_title','$file_format','$date_submitted','$deadline','$gdrive_link','Pending','not yet signed','not yet signed')";

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