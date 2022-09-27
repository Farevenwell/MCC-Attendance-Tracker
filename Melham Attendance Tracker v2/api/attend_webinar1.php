

<?php 

    $id = (int)$_GET['id'];

   include("db/dbconnection.php");

            
        $sql = "SELECT * FROM attended_webinar WHERE webinar_id='".$id."'";
			$result = $conn->query($sql);
			
			if(mysqli_num_rows($result)>0)
			{
				echo '2';
			}

  
 $conn->close();

?>