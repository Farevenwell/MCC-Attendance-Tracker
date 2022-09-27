<html>
  <link rel='stylesheet' href='css/sweetalert.css'>

<?php

date_default_timezone_set("Asia/Manila");

require_once('bdd.php');


 if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end'])){

$title = $_POST['title'];

	$start = $_POST['start'];
	$end = $_POST['end'];
	$date = date('Y-m-d H:i:s');
	$user_id = 0;

	if($date > $start){
		echo '<script>alert("Error, You cannot add new event to previous dates!"); window.location.href = "event.php" </script>';
	}else
	{
		$sql = "INSERT INTO announcement(user_acc_id, title, start, end) values ('$user_id', '$title', '$start', '$end')";
		echo '<script>alert("Event added successful!"); window.location.href = "event.php" </script>';		
	}


	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();


	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
}

	


header('Location: '.$_SERVER['HTTP_REFERER']);


?>

  <script src='js/sweetalert.min.js'></script>
</html>
