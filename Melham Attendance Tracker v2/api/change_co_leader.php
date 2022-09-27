<?php



	include("db/dbconnection.php");

	



        $team_id = $_POST['team_id'];

        $co_leader_id = $_POST['co_leader_id'];	

        $former_co_lead_id = $_POST['former_co_lead_id'];	

        $position = 0;

        $new_co_lead = 2;		



            $sql = "UPDATE team SET co_leader_id='$co_leader_id' where team_id='$team_id'";

              if ($conn->query($sql) === TRUE) 

              {

                $sql1 = "UPDATE user_acc SET position='$new_co_lead' where user_acc_id='$co_leader_id'";

                    if ($conn->query($sql1) === TRUE) 

                    {

                        $sql13 = "UPDATE user_acc SET position='$position' where user_acc_id='$former_co_lead_id'";

                            if ($conn->query($sql13) === TRUE) 

                            {

                                echo "1";

                            } else {

                                echo "2";

                            }

                    } else {

                        echo "2";

                    }			

            

              } else 

              {

                echo "0";

              }

			

        

        

        $conn->close();

    

	

?>