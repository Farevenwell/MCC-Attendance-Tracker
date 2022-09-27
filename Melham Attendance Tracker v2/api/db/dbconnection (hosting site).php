<?php
        header('Access-Control-Allow-Origin: *');
        
		$servername=""; //hostname

		$username=""; //mysql username

		$password=""; //mysql password

		$database=""; //mysql database name
		//Create connection

		

		$conn=mysqli_connect($servername, $username, $password, $database);

		

		//Check connection

		

		if(!$conn){

			die("Connection failed!". mysqli_connect_error());

		}

?>