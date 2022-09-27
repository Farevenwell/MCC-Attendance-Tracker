<?php

require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['id'])){


	$id = $_POST['id'];

	$sql = "DELETE FROM announcement WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 echo($bdd->errorInfo());
	 die ('Error prepare');
	 echo "<script>alert('Data added Successfully');</script>" ;
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}elseif (isset($_POST['title']) && isset($_POST['id'])){

	$id = $_POST['id'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];


	$sql = "UPDATE announcement SET  title = '$title', start = '$start',end = '$end'  WHERE id = $id ";


	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
header('Location: event.php');


?>
