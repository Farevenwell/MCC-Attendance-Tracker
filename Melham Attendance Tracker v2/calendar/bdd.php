<?php

try

{

	$bdd = new PDO('mysql:host=localhost;dbname=u532861242_timev2;charset=utf8', 'u532861242_admin','y!P(FWS!2]DYfNz^');

}

catch(Exception $e)

{

        die('Error : '.$e->getMessage());

}



/*$con=mysqli_connect('localhost','root','','calendar');

mysqli_set_charset($con,'utf8');

// Check connection

if (mysqli_connect_errno())

  {

  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();

  }*/





/*$bdd = mysqli_connect('localhost', 'root', '', 'ars');

  if($bdd->connect_error){

    die("Fatal Error: Can't connect to database: ". $bdd->connect_error);

  }*/

?>

