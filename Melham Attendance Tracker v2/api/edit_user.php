<?php





	include("db/dbconnection.php");
        //fetch the inputs
        $user_acc_id = $_POST['user_acc_id'];

        $usertype = $_POST['usertype'];

        $firstname = $_POST['firstname'];

		$lastname = $_POST['lastname'];

        $middle_name = $_POST['middle_name'];

		$user_name = $_POST['email'];

        $department = $_POST['department'];

        $company = $_POST['company'];

        $team = $_POST['team'];

        $staff_position = $_POST['position'];

		$pwd = $_POST['pwd'];

		$profile_pic = $_FILES['profile_pic']['name'];

        $position = 0;

		$permission = 0;

        $hashed_pass = md5($pwd);



		  $randomno = rand(0,100000);

		  $renames = 'upload'.$randomno;

		  

		  $newName= $renames.$profile_pic;

		  $target_dir = "uploaded_profile/";

		  $target_file = $target_dir . $newName;

		  

		  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			

		  // Valid file extensions

		  $extensions_arr = array("jpg","jpeg","png","gif");



          if(!empty($_FILES["profile_pic"]["name"]))

          {

				if( in_array($imageFileType,$extensions_arr) )

				{



					compressImage($_FILES["profile_pic"]["tmp_name"], $target_file, 20);



                    $query = "SELECT * FROM user_acc WHERE user_acc_id='".$user_acc_id."'";

						$result = $conn->query($query);

					if ($result->num_rows > 0) {

						while ($row = $result->fetch_array()) {

							$image = $row['profile_pic'];

							$file= 'uploaded_profile/'.$image;

							unlink($file);

						}

					}



                    $sql1 = "SELECT * FROM user_acc WHERE  user_acc_id='".$user_acc_id."' AND passwd='".$pwd."'";

                        $result2 = $conn->query($sql1);

                        

                        if(mysqli_num_rows($result2)>0)

                        {

                             $sql2 = "UPDATE user_acc SET firstname='$firstname', lastname='$lastname', middle_name='$middle_name', username='$user_name', passwd='$pwd', usertype='$usertype', profile_pic='$newName' where user_acc_id='$user_acc_id'";

                                if ($conn->query($sql2) === TRUE) 

                                {
                             $sql3 = "UPDATE staff_info SET company='$company', department='$department', team_handled='$team', staff_position='$staff_position' where username='$user_name'";

                                if ($conn->query($sql3) === TRUE) 

                                {

                                    echo "1" ;			

                            

                                } else 

                                {

                                    echo "0";

                                }
                                }

                        }

                        else

                        {

                                $sql3 = "UPDATE user_acc SET firstname='$firstname', lastname='$lastname', middle_name='$middle_name', username='$user_name', passwd='$hashed_pass', usertype='$usertype', profile_pic='$newName' where user_acc_id='$user_acc_id'";

                                if ($conn->query($sql3) === TRUE) 

                                {
                              $sql5 = "UPDATE staff_info SET company='$company', department='$department', team_handled='$team', staff_position='$staff_position' where username='$user_name'";

                                if ($conn->query($sql5) === TRUE) 

                                {                                   

                                    echo "1" ;			

                            

                                } else 

                                {

                                    echo "0";

                                }
                                }

                        }

				}

				else

				{

					echo "3";

				}

          }

          else

          {

              $sql4 = "SELECT * FROM user_acc WHERE  user_acc_id='".$user_acc_id."' AND passwd='".$pwd."'";

			$result3 = $conn->query($sql4);

			

			if(mysqli_num_rows($result3)>0)

			{

				    $sql5 = "UPDATE user_acc SET firstname='$firstname', lastname='$lastname', middle_name='$middle_name', username='$user_name', passwd='$pwd', usertype='$usertype' where user_acc_id='$user_acc_id'";

                            if ($conn->query($sql5) === TRUE) 

                            {
                             $sql3 = "UPDATE staff_info SET company='$company', department='$department', team_handled='$team', staff_position='$staff_position' where username='$user_name'";

                                if ($conn->query($sql3) === TRUE) 

                                {

                                echo "1" ;			

                        

                            } else 

                            {

                                echo "0";

                            }
                            }

			}

			else

			{

                        $sql6 = "UPDATE user_acc SET firstname='$firstname', lastname='$lastname', middle_name='$middle_name', username='$user_name', passwd='$hashed_pass', usertype='$usertype' where user_acc_id='$user_acc_id'";

                            if ($conn->query($sql6) === TRUE) 

                            {

                                echo "1" ;			

                        

                            } else 

                            {

                                echo "0";

                            }

            }

          }



        

		

        $conn->close();

    



		function compressImage($source, $destination, $quality) {



			$info = getimagesize($source);

	

			if ($info['mime'] == 'image/jpeg') {

				$image = imagecreatefromjpeg($source);

			} elseif ($info['mime'] == 'image/gif') {

				$image = imagecreatefromgif($source);

			} elseif ($info['mime'] == 'image/png') {

				$image = imagecreatefrompng($source);

			}

	

			imagejpeg($image, $destination, $quality);

	

		}	

	



?>