			
<?php
	include("db/dbconnection.php");
	$id = (int)$_GET['id']; 

    $sql = "SELECT * FROM user_acc, intern_info where user_acc.username=intern_info.username AND intern_info.intern_info_id='".$id."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
          
      while($row = $result->fetch_array()) {


      $sql = "SELECT * FROM user_acc WHERE username = '".$row["username"]."'";   
	  $result = $conn->query($sql);

	  if($row1 = $result->fetch_assoc()) {
		$user_id = $row1["user_acc_id"];
	  }
	            

		$sql5 = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id = '$user_id'";
    
		$result5 = mysqli_query($conn, $sql5);
        $row5 = $result5->fetch_assoc();
        $hrs_added = round($row5["hrs_added"], 1);


        $sql3 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id = '$user_id'";
	    $result3 = mysqli_query($conn, $sql3);
        $row3 = $result3->fetch_assoc();
		$penalty = $row3["extra_hours"];		
        
        $sql4 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id = '$user_id'";
	    $result4 = mysqli_query($conn, $sql4);
        $row4 = $result4->fetch_assoc();        
        $deduction = $row4["extra_hours"];
        
        if($hrs_added == 0)
        {
            $hrs_added = 0;
        }
        if($penalty == 0)
        {
            $penalty = 0;
        }
        if($deduction == 0)
        {
            $deduction = 0;
        }

        $hrs_rendered = $hrs_added + $deduction - $penalty;
		$hrs_left = $row["required_hours"] - $hrs_added - $deduction + $penalty;









        echo'<div class="row gutters-sm">';
        echo'<div class="col-md-4 mb-3">';
                echo'<div class="card">';
                  echo'<div class="card-body">';
                    echo'<div class="d-flex flex-column align-items-center text-center">';
                      echo'<img src="api/uploaded_profile/'.$row["profile_pic"].'" alt="Admin" style="width: 200px; height: 200px; border-radius:50%">';
                        echo'<div class="mt-3">';
                        echo'<h4>'.$row["firstname"].' '.$row["middle_name"].' '.$row["lastname"].'</h4>';
                          echo'<p class="text-secondary mb-1">'.$row["app_id"].'</p>';
                          echo'<p class="text-muted font-size-sm">'.$row["department"].'</p>';
                          echo'</div>';
                        echo'</div>';
                      echo' </div>';
                    echo'</div>';
					echo '<hr>';
                  echo'<div class="card mt-3">';
                  echo'<ul class="list-group list-group-flush">';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">REQUIRED HOURS</h6>';
                        echo'<span class="text-secondary">'.$row["required_hours"].' hrs</span>';
                        echo'</li>';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">RENDERED HOURS</h6>';
                        echo'<span class="text-secondary">'.$hrs_rendered.' hrs</span>';
                        echo'</li>';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">REMAINING HOURS</h6>';
                        echo'<span class="text-secondary">'.$hrs_left.' hrs</span>';
                        echo'</li>';				  
				  echo'</ul></div><hr>';
                 echo'<div class="card mt-3">';
                  echo'<ul class="list-group list-group-flush">'; 
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">DEDUCTED HOURS</h6>';
                        echo'<span class="text-secondary">-'.$deduction.' hrs</span>';
                        echo'</li>';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">PENALTY HOURS</h6>';
                        echo'<span class="text-secondary">+'.$penalty.' hrs</span>';
                        echo'</li>';                  
                  echo'</ul></div><hr>';                   
				echo'<div class="card mt-3">';
                  echo'<ul class="list-group list-group-flush">';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                         $star_date = $row['startdate'];   
                         $star_date1 = date('F d, Y ', strtotime($star_date));

                      echo'<h6 class="mb-0">START DATE</h6>';
                        echo'<span class="text-secondary">'.$star_date1.'</span>';
                        echo'</li>';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';

                         $end_date = $row['estimated_end_date'];   
                         $end_date1 = date('F d, Y ', strtotime($end_date));
                      echo'<h6 class="mb-0">END DATE</h6>';
                        echo'<span class="text-secondary">'.$end_date1.'</span>';
                        echo'</li>';
					echo'</ul></div><hr>';
				echo'<div class="card mt-3">';
                  echo'<ul class="list-group list-group-flush">';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">START SHIFT</h6>';
                        echo'<span class="text-secondary">'.$row["start_shift"].'</span>';
                        echo'</li>';
                      echo'<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo'<h6 class="mb-0">END SHIFT</h6>';
                        echo'<span class="text-secondary">'.$row["end_shift"].'</span>';
                        echo'</li>';
                      echo'</ul>';
                    echo'</div>';
                  echo'</div>';
                
                
                echo'<div class="col-md-8 ">';
                echo'<div class="card mb-3">';
                  echo'<div class="card-body">';
                    echo'<div class="row gutters-sm">';
                      echo'<div class="col-sm-6 mb-3">';
                            
                        echo'<div class="row">';
                       echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Name:</h6>';
                                  echo'</div>';
                                   echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["firstname"].' '.$row["middle_name"].' '.$row["lastname"].'';
                                    echo'</div></center>';
                                  echo'</div>';
                                  echo'<hr>';
                                echo'<div class="row">';
                                echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Email:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["username"].'';
                                            echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';
                                echo'<div class="row">';
                                echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Mobile No.:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo' '.$row["mobile_no"].'';
                                          echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';
                               echo'<div class="row">';
                                echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Street:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["street"].'';
                                        echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';

                               echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Barangay:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["barangay"].'';
                                        echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';

                               echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">City:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["city"].'';
                                        echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';

                               echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Province:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["province"].'';
                                        echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';
                              echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Duty Scheduled:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["schedule"].'';
                                        echo'</div>';
                                    echo'</div></center>';
                                  echo'<hr>';
                               
                              
                               echo'</div>';
          
                                echo'<div class="col-sm-6 mb-4">';
                            
                         
                                $Birthdate = $row['birthdate'];   
                                $Birthdate1 = date('F d, Y ', strtotime($Birthdate));

                         echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Birthdate:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$Birthdate1.'';
                                        echo'</div>';
                                    echo'</div>';
                                  echo'<hr>';

                               echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Gender :</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["sex"].'';
                                        echo'</div>';
                                    echo'</div>';
                                  echo'<hr>';

                               echo'<div class="row">';
                               echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Civil Status:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["civil_status"].'';
                                        echo'</div>';
                                    echo'</div>';
                                  echo'<hr>';

                               echo'<div class="row">';
                          echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Religion:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["religion"].'';
                                          echo'</div>';
                                    echo'</div>';
                                  echo'<hr>';
                                echo'<div class="row">';
                                echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Company:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["company"].'';
                                            echo'</div>';
                                    echo'</div>';
                                  echo'<hr>';
                                echo'<div class="row">';
                                echo'<center><div class="col-sm-7">';
                                echo'<h6 class="mb-0">Dept:</h6>';
                                  echo'</div>';
                                    echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["department"].'';
                                          echo'</div>';
                                    echo'</div>';
                                  echo'<hr>';
                                  echo'<div class="row">';
                                  echo'<center><div class="col-sm-7">';
                                  echo'<h6 class="mb-0">G-Drive:</h6>';
                                  echo'</div>';
                                      echo'<div class="col-sm-12 text-secondary">';
                                      echo'<a href="'.$row["gdrive_link"].' "style="text-decoration: none" target="_blank">G-DRIVE LINK</a>';
                                              echo'</div>';
                                      echo'</div>';
                                    echo'<hr>';
                                
                                 echo'<div class="row">';
                                    echo'<center><div class="col-sm-7">';
                                         echo'<h6 class="mb-0">University:</h6>';
                                  echo'</div>';
                                   echo'<div class="col-sm-12 text-secondary">';
                                  echo''.$row["school"];
                                    echo'</div></center>';
                                  echo'</div>';
                                  echo'<hr>';
                                
                                echo'</div>';
                                
                        
                          echo'<div class="row">';
                        echo'<div class="col-sm-12" text-center">';
                        echo'<a class="btn btn-dark " btn-md href="view_intern.html">BACK</a>&nbsp; &nbsp';
                          echo'</div>';
                            echo'</div>';
                            
                          echo'</div>';
                        echo'</div>';
                      echo'</div>';
                     echo'</div>';
		  
	  }
		
      
    } else {
      echo "0 results";
    }
    $conn->close();
?>

