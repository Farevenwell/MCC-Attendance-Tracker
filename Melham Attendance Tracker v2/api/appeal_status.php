<?php





	include("db/dbconnection.php");


	





        $id = $_GET["id"];





        $sql = "SELECT * FROM intern_info WHERE intern_info_id='$id'";


    


        $result = $conn->query($sql);	


	


        if ($result->num_rows > 0) {


        


        while($row = $result->fetch_array()) 


        {


            $email = $row["username"];


            $status = $row["intern_status"];


        }


        }





        $sql2 = "SELECT * FROM user_acc WHERE username = '$email'";


    


        $result2 = $conn->query($sql2);	


	


        if ($result2->num_rows > 0) {


        


        while($row2 = $result2->fetch_array()) 


        {


            $user_id = $row2["user_acc_id"];


        }


        }





            $sql = "UPDATE intern_info SET intern_status='$intern_status' where intern_info_id='$id'";


              if ($conn->query($sql) === TRUE) 


              {


                    $sql1 = "DELETE FROM reported_intern WHERE user_acc_id='$user_id'";


                    if ($conn->query($sql1) === TRUE) 


                    {


                         if($status == "Multiple Reports")


                         {





						$name = $email;


  	                    require_once __DIR__.'/vendor/autoload.php';


	


	                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);





                        $mail->SMTPDebug = 0;


                        $mail->isSMTP();


                        $mail->Host = 'smtp.gmail.com';


                        $mail->Port = 587;


                        $mail->SMTPAuth = true;


                        $mail->SMTPSecure = 'tls';                       


                        $mail->Username = 'uip.tracker.v2@gmail.com';


                        $mail->Password = 'stiyvmpsdyirygfq';








                        // Recipients


                        $mail->setFrom('uip.tracker.v2@gmail.com', 'Melham Construction Corporation');


                        $mail->addAddress($email);


	                    $mail->addReplyTo('uip.tracker.v2@gmail.com','Melham Construction Corporation');





	                    //message


	


	


	                    $mail->isHTML(true);	


	                    $message = "<div style='width:90%;'><h4><b><p>Hello ".$name.",<br><br>Your account is now unbanned and you can also login in attendance tracker website. <br><br>You can now continue your activity.<br><br>Please be good with your teammates to avoid this kind of incident in the future.<br><br>Thank you and have a good day!<br><br>Sincerly,<br><br><u>Feric G. Decenan</u><br><i>ADMIN</i></p></b></h4></div>";


	


                        // Content


                        $mail->Subject = "ACCOUNT UNBANNED";


                        $mail->Body    = $message.'<br><br><br><footer><div style="text-align: center; font-size: 12px;color:black; height:30px; width: 100%;"><p>Copyright &copy; '.date("Y").' Melham Construction Corporation | Project IT-30 Team</p></div></footer>';;


                        $mail->send();


						





						echo "1";








                         }else{                


                            echo "1";	 


                         } 


                    }


                    else{


                        echo "1";


                    }           


              } else 


              {


                echo "0";


              }


			


        


        


        $conn->close();


    


	


?>