<head>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>

<?php
    //include connection
    include('config.php');
    //check if code is existing in the database
    if(!isset($_GET["code"])){
        exit("Cant find page");
    }
    //getting the code from the url
    $code = $_GET["code"];
    //qeury for getting email
    $getEmailQuery = mysqli_query($con, "SELECT email FROM resetpasswords WHERE code='$code'");
    
    if(mysqli_num_rows($getEmailQuery) == 0){
        echo "<html><body><img style='background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: 100%;' src='https://www.sktthemes.org/wp-content/uploads/2020/03/The-Link-You-Followed-Has-Expired.jpg'/></body></html>";
        exit();
    }
  
    //confirm password input trapping
    if (isset($_POST["password"])){
        $pw = $_POST["password"];
        $c_pw = $_POST["c_password"];

        if($pw != $c_pw)
        {
             echo '<script>
            setTimeout(function() {
                swal({
                    title: "Password unmatch!",
                    text: "Password did not match.",
                    type: "error"
                }, function() {
                   
                });
            }, 1000);
        </script>';
        
        }else{

        //encrypt inputted new password 
        $pw = md5($pw);
        
        
        $row = mysqli_fetch_array($getEmailQuery);
        $email = $row["email"];
        //query to update password 
        $query = mysqli_query($con, "UPDATE user_acc SET passwd='$pw' WHERE username='$email'");

        if($query){
            //delete code and email after updating the password from the resetpasswords table.
            $query = mysqli_query($con, "DELETE FROM resetpasswords WHERE code='$code'");

            echo '<script>
            setTimeout(function() {
                swal({
                    title: "Password changed!",
                    text: "Password succesfully been changed.",
                    type: "success"
                }, function() {
                    window.location = "index.html";
                });
            }, 1000);
        </script>';  

            exit();
           
        }else{
            exit("Something went wrong");
        }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=1024">
    <script src="https://kit.fontawesome.com/bea467c0c7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
	<link rel="shortcut icon" href="assets/images/favicon.ico" />
    <title>Attendance Tracker V2 - Password Reset</title>
  </head>
  <style>
	 .input-field select {
		background: none;
		outline: none;
		border: none;
		line-height: 1;
		font-weight: 600;
		font-size: 1.1rem;
		color: #333;
		width:400px;
		margin-right:42px;
		}
		form.sign-in-form3 {
		z-index: 2;
		}

	  </style>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

          <form  class="sign-in-form" enctype="multipart/form-data" id="entry-form" method="POST" >

			<img src="assets/images/company_logo.png" alt="Logo" style="width: 100px; height: 100px; border: 2px solid white; border-radius: 100px;">
            <br>
            <h2 class="title">Enter your new password</h2>
            <div class="input-field">
              <i class="fas fa-eye" id="togglePassword"></i>
              <input type="password"  id="pwd" name="password" placeholder="New password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{10,}" title="Password must be 10 or more characters with atleast 1 uppercase, lowercase, and number."  required/>
			  
            </div>
            <div class="input-field">
              <i class="fas fa-eye" id="toggle_C_Password"></i>
              <input type="password"  id="c_pwd" name="c_password" placeholder="Confirm password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{10,}" title="Password must be 10 or more characters with atleast 1 uppercase, lowercase, and number." required/>
			  
            </div>
            <button type="submit" class="btn solid" name="submit" id="submit_id_login"><strong>CONFIRM</strong></button>
			
          </form>
        </div>
    </div>
          <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Login</h3>
            <p>
              Please click the button to login page
            </p>
            <button class="btn transparent" onclick="window.location.href = 'https://melham-time-tracker-v2.rf.gd/main/';">
              Login
            </button>
          </div>
          <img src="img/reset.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Please login in here if you have an existing account!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/wave.svg" class="image" alt="" />
        </div>
      </div>
</div>
    <script> 
        //hide inputs from password fields function
        const togglePassword1 = document.querySelector('#togglePassword');
        const togglePassword2 = document.querySelector('#toggle_C_Password');

        const password1 = document.querySelector('#pwd');
        const password2 = document.querySelector('#c_pwd');
 
            togglePassword1.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                password1.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });

            togglePassword2.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                password2.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
    </script>

	<style>
		.hide {
		  display: none;
		}
		</style>
  </body>
</html>

