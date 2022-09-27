<?php
if(isset($_POST['application_id'],
         $_POST['first_name'],
         $_POST['middle_initial'],
         $_POST['last_name'],
         $_POST['email'],
         $_POST['mobile_number'],
         $_POST['date_of_birth'],
         $_POST['gender'],
         $_POST['street'],
         $_POST['barangay'],
         $_POST['city'],
         $_POST['civil_status'],
         $_POST['department'],
         $_POST['google_drive_link'],
         $_POST['number_of_hours'],
         $_POST['starting_date'],
         $_POST['end_date'],
         $_POST['starting_shift'],
         $_POST['company'],
         $_POST['religion'],
         $_POST['province'],
         $_POST['shift'],
         $_POST['end_shift']))
{
    include("db/dbconnection.php");

    $id = $_POST['application_id'];
    $fname = $_POST['first_name'];
    $mi = $_POST['middle_initial'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $mnumber = $_POST['mobile_number'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $street = $_POST['street'];
    $bgry = $_POST['barangay'];
    $city = $_POST['city'];
    $cstatus = $_POST['civil_status'];
    $dept = $_POST['department'];
    $gdrive = $_POST['google_drive_link'];
    $nhours = $_POST['number_of_hours'];
    $sdate = $_POST['starting_date'];
    $edate = $_POST['end_date'];
    $stime = $_POST['starting_shift'];
    $etime = $_POST['end_shift'];
    $religion = $_POST['religion'];
    $company = $_POST['company'];
    $mobiileNumber = $_POST['mobile_number'];
    $username = $_POST['email'];
    $province = $_POST['province'];
    $shift = $_POST['shift'];
    $password = randomPass();
    $intern_status = "Pending";
    $usertype = "Intern";
    $position = "0";
    $permission = "0";

    $hashed_pass = md5($password);


    $sql1 = "SELECT username FROM user_acc WHERE username='".$username."'";
    $sql2 = "INSERT INTO user_acc (firstname, lastname, middle_name, username, passwd, usertype, shift, position, permission) VALUES ('$fname', '$lname', '$mi', '$username', '$hashed_pass', '$usertype', '$shift', '$position', '$permission')";
    $sql3 = "INSERT INTO intern_info (username, app_id, street, barangay, city, province, birthdate, sex, religion, civil_status, company, department, intern_status, startdate, required_hours, gdrive_link, estimated_end_date, start_shift, end_shift, mobile_number) VALUES ('$username', '$id', '$street', '$bgry', '$city', '$province', '$dob', '$gender', '$religion', '$cstatus', '$company', '$dept', '$intern_status', '$sdate', '$nhours', '$gdrive', '$edate', '$stime', '$etime', '$mobiileNumber')";

    $result = $conn->query($sql1);

    if (mysqli_num_rows($result) > 0)
    {
      echo "2";
    } else
    {
      if ($conn->query($sql2) === TRUE)
    	{
    		if ($conn->query($sql3) === TRUE)
        {
          $myfile = fopen("password.txt", "w");
          $txt = $password."\n";
          fwrite($myfile, $txt);
          fclose($myfile);

          echo "1";
        } else
        {
          echo $conn -> error;
        }
    	} else
    	{
    		echo $conn -> error;
    	}
    }

    $conn->close();
    exit();


    }

function randomPass()
{
    $length = rand(10,20);
    $randomCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ=-+_)(*&^%$#@!';
    $stringLength = strlen($randomCharacters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $randomCharacters[rand(0, $stringLength - 1)];
    }

    return $randomString;
}
?>
