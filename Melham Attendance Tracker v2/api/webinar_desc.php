<?php 





    $id = $_GET['id']; 


   


    $query = "SELECT *


    FROM webinar


    WHERE webinar_id = '".$id."'";





    $search_result= filterTable($query);


	


    


    while ($row = $search_result->fetch_assoc()) {


		


        $webinar_desc = $row["webinar_desc"];


       


    }


        echo nl2br($webinar_desc);


    


    function filterTable($query){


        $connect = mysqli_connect("localhost", "u532861242_admin", "y!P(FWS!2]DYfNz^", "u532861242_timev2");


        $filter_Result = mysqli_query($connect, $query);


        


        return $filter_Result;


    }





?>