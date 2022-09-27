<?php


	include("db/dbconnection.php");
	
    if(isset($_POST['project_id']) && isset($_POST['task_name']) && isset($_POST['date_assigned']) && isset($_POST['file_formats']) && isset($_POST['gdrive_link'])){

        $project_id = $_POST['project_id'];
		$task_name = $_POST['task_name'];
        $date_assigned = $_POST['date_assigned'];
		$file_formats = $_POST['file_formats'];
		$gdrive_link = $_POST['gdrive_link'];
        $now = date_create()->format('Y-m-d');
		
		
        $sql1 = "UPDATE project SET task_name='$task_name', date_assigned='$date_assigned', date_submitted='$now', file_formats='$file_formats', gdrive_link='$gdrive_link' where project_id='$project_id'";
                if ($conn->query($sql1) === TRUE) 
				{
					echo "1";			
			
				} else 
				{
					echo "0";
				}
			
        
        $conn->close();
    }
	

?>