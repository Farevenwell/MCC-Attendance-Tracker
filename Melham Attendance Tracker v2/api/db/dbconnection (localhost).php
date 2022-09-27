<?php
        header('Access-Control-Allow-Origin: *');
        
		$servername="localhost";

		$username="root";

		$password="";

		$database="u532861242_timev2";
		//Create connection

		

		$conn=mysqli_connect($servername, $username, $password, $database);

		

		//Check connection

		

		if(!$conn){

			die("Connection failed!". mysqli_connect_error());

		}

?>