    <?php

    require_once('bdd.php');
    date_default_timezone_set("Asia/Manila");

    $sql = "SELECT id, title, start, end FROM announcement ";

    $req = $bdd->prepare($sql);
    $req->execute();

    $events = $req->fetchAll();


    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Attendance Tracker V2</title>
    <!-- plugins:css -->
	
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
	<link href='css/custom.css' rel='stylesheet' />
    <link rel="stylesheet" href="css/theme2.css"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
	
    <link href='css/fullcalendarxx.min.css' rel='stylesheet' />
    <link href='css/sweetalert.css' rel='stylesheet' />
    <link rel="stylesheet" href="../css/loading.css"> 
<style>
              /* width */
      ::-webkit-scrollbar {
        width: 9px;
        background-color:#ffffff
      }
      
    
       
      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #0071BD; 
        border-radius: 10px;
      }
      
      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #0364a5; 
      }
</style>		



  </head>
  <body onload="initClock()">
	    <div id="topbar1" class="container">
			<i>Loading...</i>
		</div>	
        <div style="display:none;" id="sidebar1" class="container">
			<i>Loading...</i>
		</div>
        <div style="display:none;" id="main1" class="container">
			<i>Loading...</i>
		</div>
    <div class="container-scroller">
      
      <nav id="topbar" class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row " >
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="../main.html"><img src="../assets/images/logo.png" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="../main.html" ><img src="../assets/images/logo-mini.png" alt="logo" /></a>
        </div>
        
        <div class="navbar-menu-wrapper d-flex align-items-stretch" >
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" >
            <span class="mdi mdi-menu" ></span>
          </button>
        <div class="search-field d-none d-md-block ">
            <div class="d-flex align-items-center h-100">
              <div class="input-group">   
                <a href="#">
                    <button class='btn-lg btn me-6' style="background-color:#0071BD" ><strong style="color:#f7f7f7">CALENDAR EVENT</strong></button>
                </a>
              </div>
            </div>
          </div>
          <div class="search-field d-block d-sm-none">
            <div class="d-flex align-items-center h-100">
              <div class="input-group">   
                <a href="#">
                    <button class='btn-lg btn me-6' style="padding: 17px 14px 17px 14px; background-color:#0071BD" ><strong style="color:#f7f7f7">CALENDAR EVENT</strong></button></a>
              </div>
            </div>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            
            <li class="nav-item nav-profile dropdown" id="profile_intern_only">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="assets/images/faces/default.jpg" id="display_profile_picture1" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black" id="display_profile_fullname1"></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
               <a class="dropdown-item" href="../change_password.html" style="color:#000000">
                <i class="mdi mdi-key me-2 text-warning"></i> Change Password </a>
                <div class="dropdown-divider"></div>  
           
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" id="logout" style="color:#000000">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown" id="profile_admin_only">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="assets/images/faces/default.jpg" id="display_profile_picture_admin1" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black" id="display_profile_fullname_admin1"></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" id="logout1" style="color:#000000">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                
              </a>
            </li>
           
     

          </ul>
<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>          
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar2">
          <ul class="nav">
            <li class="nav-item nav-profile"  id="profile_for_intern">
              <a href="../profile.html" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/default.jpg" id="display_profile_picture" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2" id="display_profile_fullname"></span>
                  <span class="text-secondary text-small" id="display_profile_intern_status"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item nav-profile" id="profile_for_admin">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/default.jpg" id="display_profile_picture_admin" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2" id="display_profile_fullname_admin"></span>
                  <span class="text-secondary text-small" id="display_profile_usertype"></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../main.html">
                <span class="menu-title"><strong>Dashboard</strong></span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
             <li id="all_online" class="nav-item">
              <a class="nav-link" href="../online_today.html">
                <span class="menu-title"><strong>Online Users</strong></span>
                <i class="mdi menu-icon" ></i>(<span id="count_online" style="font-weight: bold;">0</span>)
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="../community_forum.html">
                <span class="menu-title"><strong>Community Forum</strong></span>
                <i class="mdi mdi-message-text menu-icon"></i>
              </a>
            </li> 
             <li id="intern_online" class="nav-item">
              <a class="nav-link" href="../team_online_today.html">
                <span class="menu-title"><strong>Team Monitoring</strong></span>
                <i class="mdi mdi-account-multiple menu-icon" ></i>
              </a>
            </li>  
            <li class="nav-item" >
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title"><strong>Project</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-audiobook menu-icon "></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
				          <li class="nav-item" id="all_project"> <a class="nav-link" href="../all_project.html"><strong>All Project</strong></a></li>
                  <li class="nav-item" id="team_project"> <a class="nav-link" href="../team_project.html"><strong>Team Project</strong></a></li>
                  <li class="nav-item" id="weekly_report"> <a class="nav-link" href="../weekly_report.html"><strong>View Weekly Report</strong></a></li>
                  <li class="nav-item" id="view_team_project"> <a class="nav-link" href="../view_team_project.html" ><strong>View Team Project</strong></a></li>
                  <li class="nav-item" id="view_project"> <a class="nav-link" href="../view_project.html"><strong>View Project</strong></a></li>
                  <li class="nav-item" id="submit_team_project"> <a class="nav-link" href="../submit_team_project.html"><strong>Submit Team Project</strong></a></li>
                  <li class="nav-item" id="submit_project"> <a class="nav-link" href="../submit_project.html"><strong>Submit Project</strong></a></li>
                </ul>
              </div>
            </li>
			<li class="nav-item" id="manage_team">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
                <span class="menu-title"><strong>Manage Team</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-box menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic5">
                <ul class="nav flex-column sub-menu">
				  <li class="nav-item" > <a class="nav-link" href="../view_team.html"><strong>View Team</strong></a></li>
				  <li class="nav-item" > <a class="nav-link" href="../add_team.html" ><strong>Add Team</strong></a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item" id="manage_time">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
                <span class="menu-title"><strong>Manage Time</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-timer menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic6">
                <ul class="nav flex-column sub-menu">
				  <li class="nav-item" > <a class="nav-link" href="../view_hours.html"><strong>View Time</strong></a></li>
				  <li class="nav-item" > <a class="nav-link" href="../add_hours.html" ><strong>Add Hours</strong></a></li>
                </ul>
              </div>
            </li>
			<li class="nav-item" id="manage_intern">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic3">
                <span class="menu-title"><strong>Manage Intern</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-book-multiple menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic3">
                <ul class="nav flex-column sub-menu">
				  <li class="nav-item" > <a class="nav-link" href="../view_intern.html"><strong>View Intern</strong></a></li>
                </ul>
              </div>
            </li>
			<li class="nav-item" id="manage_user">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
                <span class="menu-title"><strong>Manage User</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-contacts menu-icon "></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item" id="view_for_admin"> <a class="nav-link" href="../view_user.html"><strong>View User</strong></a></li>
                  <li class="nav-item" id="add_for_admin"> <a class="nav-link" href="../add_user.html"><strong>Add User</strong></a></li>
                  <li class="nav-item" id="view_for_staff"> <a class="nav-link" href="../view_user_intern.html"><strong>View User</strong></a></li>
                  <li class="nav-item" id="add_for_staff"> <a class="nav-link" href="../add_intern.html"><strong>Add User</strong></a></li>
                </ul>
              </div>				
            </li>
			<li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title"><strong>Intern leave</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-exit-to-app menu-icon "></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item" id="apply_leave"> <a class="nav-link" href="../apply_leave.html"><strong>Apply Leave</strong></a></li>
                  <li class="nav-item" id="leave_status"> <a class="nav-link" href="../leave_status.html"><strong>Leave Status</strong></a></li>
				          <li class="nav-item" id="pending"> <a class="nav-link" href="../pending.html"><strong>Pending</strong></a></li>
				          <li class="nav-item" id="logs"> <a class="nav-link" href="../leave_logs.html"><strong>Logs</strong></a></li>
                </ul>
              </div>				
            </li>
			<li class="nav-item" id="webinar">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
                <span class="menu-title"><strong>Webinar</strong></span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-web menu-icon "></i>
              </a>
              <div class="collapse" id="ui-basic4">
                <ul class="nav flex-column sub-menu">
				  <li class="nav-item" > <a class="nav-link" href="../view_webinar.html"><strong>View Webinar</strong></a></li>
                  <li class="nav-item" > <a class="nav-link" href="../add_webinar.html"><strong>Add Webinar</strong></a></li>
                </ul>
              </div>
            </li>
			<li class="nav-item" id="permission">
              <a class="nav-link" href="../permission.html">
                <span class="menu-title"><strong>Permission</strong></span>
                <i class="mdi mdi-clipboard-outline menu-icon"></i>
              </a>
            </li>
                <li class="nav-item" id="university_docs">
              <a class="nav-link" href="view_submitted_university_documents.html">
                <span class="menu-title"><strong>Intern University Docs</strong></span>
                <i class="mdi mdi-library-books menu-icon"></i>
              </a>
            </li>
            <li class="nav-item" id="report_for_admin">
              <a class="nav-link" href="../report_for_admin.html">
                <span class="menu-title"><strong>Report</strong></span>
                <i class="mdi mdi-alert-box menu-icon"></i>
              </a>
            </li>
			
			      <li class="nav-item" id="report_for_intern">
              <a class="nav-link" href="../report_for_intern.html">
                <span class="menu-title"><strong>Report</strong></span>
                <i class="mdi mdi-alert-box menu-icon"></i>
              </a>
            </li>
            <li class="nav-item sidebar-actions" >
              <span class="nav-link">
                <div class="border-bottom" id="take_attendance">
                  <h6 class="font-weight-normal mb-3" >Take Attendance</h6>
                </div>
				        <a  href="../take_attendance.html" id="take_attendance1" class="btn btn-block btn-lg btn mt-4" style="display: none; background-color:#0071BD" >
                  <strong style="color:#f7f7f7">ATTENDANCE</strong> 
                          </a>
				        <a  href="../take_attendance_2.html" id="take_attendance2" class="btn btn-block btn-lg btn mt-4" style="display: none; background-color:#0071BD" >
                  <strong style="color:#f7f7f7">ATTENDANCE</strong> 
                          </a>
				        <a href="../take_attendance_3.html" id="take_attendance3" class="btn btn-block btn-lg btn mt-4" style="display: none; background-color:#0071BD" >
                  <strong style="color:#f7f7f7">ATTENDANCE</strong> 
                          </a>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Documentation</p>
                  </div>
                </div>
              </span>
            </li>
            <li class="nav-item" id="developers">
              <a class="nav-link" href="../developers.html">
                <span class="menu-title"><strong>Developers</strong></span>
                <i class="mdi mdi-group menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div id="main" class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-info text-white me-2">
                  <i class="mdi mdi-exit-to-appmdi mdi-camera-timer"></i>
                </span> Calendar Event </span>
              </h3>
			  </div>

            <div style="position: center "class="col-md-12">
             <center id="error"><i>If nothing appears, please refresh the page.</i></center>
                <div  class="box box-success">
                    <div  class="box-body">
                        <div class="row">
                            <div  class="col-md-12">
                                <table id="example1" class="table table-bordered table-hover" style="margin-right:-10px">



                                    <div style="background:white" id="calendar" class="col-centered">
                                    </div>


                                </table>

                            </div><!--col end -->
                       
                        </div><!--row end-->

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col (right) -->


            <!-- /.row -->
<?php include('modal.php');?>



          
			<!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base1.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
	
  </body>

  <script type="text/javascript" src="js/caleandar.js"></script>
  <script type="text/javascript" src="js/demo.js"></script>
<?php include('modal.php');?>


    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- FullCalendar -->
    <script src='js/moment.min.js'></script>
    <!-- <script src='js/fullcalendar.min.js'></script> -->
            <script src='js/fullcalendarxx.min.js'></script>
    <script src='js/sweetalert.min.js'></script>


                <script src='packages/list/main.js'> </script>


    <script>

    setTimeout(function(){
        document.getElementById('error').style.display = 'none';
    },10000);
	document.addEventListener("DOMContentLoaded", function(event) {
		setTimeout(function(){
            document.getElementById("topbar1").style.display = 'none';
            document.getElementById("topbar").style.opacity = '1';
            document.getElementById("sidebar1").style.display = 'block';

		    
            setTimeout(function(){
                document.getElementById("sidebar1").style.display = 'none';
                document.getElementById("sidebar2").style.opacity = '1';
                document.getElementById("main1").style.display = 'block';
		    
                setTimeout(function(){
                    document.getElementById("main1").style.display = 'none';
                    document.getElementById("main").style.opacity = '1';


		        },100);
            },1000);
		},1000);

	});
      function getCookie(cName) {
        const name = cName + "=";
        const cDecoded = decodeURIComponent(document.cookie); //to be careful
        const cArr = cDecoded .split('; ');
        let res;
        cArr.forEach(val => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
        })
        return res;
        }
          
        function eraseCookie(name) {   
        document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
        
        var user_name = getCookie('user_name');
        var pwd = getCookie('pwd');
        var uty = getCookie('uty');
		var user_id = getCookie('user_id');
		var position = getCookie('position');
        //alert(usr + " " + pwd + " " + uty);
        
        if(user_name == undefined){
          window.location.replace('index.html');
        }
		function checkShift(user_name){
			$.ajax({    //create an ajax request to display.php			
			type: "GET",
			url: "../api/checkTimeShift.php?email="+user_name,                         
			success: function(response){    		
			if(response==1)
			{
				document.getElementById('take_attendance1').style.display="block";
			}
			else if(response==2)
			{
				document.getElementById('take_attendance2').style.display="block";
			}else {
				document.getElementById('take_attendance3').style.display="block";
			}
		
			}
			});
		
		}
        
      $(document).ready(function(){
            $("#logout").click(function(){
              eraseCookie("user_name");
              eraseCookie("pwd");
              eraseCookie("uty");
              eraseCookie("user_id");
              alert("Thank you for using the app.");
              window.location.replace('../index.html');
            });

            $("#logout1").click(function(){
              eraseCookie("user_name");
              eraseCookie("pwd");
              eraseCookie("uty");
              eraseCookie("user_id");
              alert("Thank you for using the app.");
              window.location.replace('../index.html');
            });

            $.ajax({    //create an ajax request to display.php
              type: "GET",
              url: "../api/get-current-login-data.php?id="+ user_id,             
              dataType: "html",   //expect html to be returned                
              success: function(response){
                var response1 = response.split("|");
                
                $("#display_profile_fullname").html(response1[1]); 
                $("#display_profile_fullname1").html(response1[0] + ' ' + response1[1]); 
                $("#display_profile_intern_status").html(response1[2]); 
                $("#display_profile_picture").attr('src',"../api/uploaded_profile/" + response1[3]); 
                $("#display_profile_picture1").attr('src',"../api/uploaded_profile/" + response1[3]); 
                //alert(response);
              }
            });

            $.ajax({    //create an ajax request to display.php
              type: "GET",
              url: "../api/get-current-login-data1.php?id="+ user_id,             
              dataType: "html",   //expect html to be returned                
              success: function(response){
                var response1 = response.split("|");
                
                $("#display_profile_fullname_admin").html(response1[1]); 
                $("#display_profile_fullname_admin1").html(response1[0] + ' ' + response1[1]); 
                $("#display_profile_usertype").html(response1[2]); 
                $("#display_profile_picture_admin").attr('src',"../api/uploaded_profile/" + response1[3]); 
                $("#display_profile_picture_admin1").attr('src',"../api/uploaded_profile/" + response1[3]); 
                //alert(response);
              }
            });            
            
          });
        
        if(uty == 'Intern')
        {
 if(position == 1)
        {
          $("#all_project").hide();
          $("#team_project").hide();
          $("#admin_card").hide();
          $("#view_for_admin").hide();
          $("#manage_team").hide()
          $("#manage_time").hide()
          $("#manage_user").hide()
          $("#manage_intern").hide()
          $("#webinar").hide()
          $("#permission").hide()
          $("#add_for_admin").hide();
          $("#pending").hide();
          $("#logs").hide();
          $("#report_for_admin").hide();
          $("#admin_only").hide();
          $("#admin_only1").hide();
          $("#view_co_team").hide();
          $("#no_team").hide();
          $("#view_member_team").hide();
          $("#profile_for_admin").hide();
          $("#profile_admin_only").hide();
          $("#admin_only2").hide();
          $("#university_docs").hide();
        }
        else if(position == 2)
        {
          $("#all_project").hide();
          $("#team_project").hide();
          $("#admin_card").hide();
          $("#view_for_admin").hide();
          $("#manage_team").hide()
          $("#manage_time").hide()
          $("#manage_user").hide()
          $("#manage_intern").hide()
          $("#webinar").hide()
          $("#permission").hide()
          $("#add_for_admin").hide();
          $("#pending").hide();
          $("#logs").hide();
          $("#report_for_admin").hide();
          $("#admin_only").hide();
          $("#admin_only1").hide();
          $("#submit_team_project").hide();
          $("#view_team").hide();
          $("#no_team").hide();
          $("#view_member_team").hide();
          $("#profile_for_admin").hide();
          $("#profile_admin_only").hide();
          $("#admin_only2").hide();
          $("#university_docs").hide();
        }
        else if(position == 3)
        {
          $("#all_project").hide();
          $("#team_project").hide();
          $("#admin_card").hide();
          $("#view_for_admin").hide();
          $("#manage_team").hide()
          $("#manage_time").hide()
          $("#manage_user").hide()
          $("#manage_intern").hide()
          $("#webinar").hide()
          $("#permission").hide()
          $("#add_for_admin").hide();
          $("#pending").hide();
          $("#logs").hide();
          $("#report_for_admin").hide();
          $("#admin_only").hide();
          $("#admin_only1").hide();
          $("#submit_team_project").hide();
          $("#weekly_report").hide();
          $("#view_team_project").hide();
          $("#view_co_team").hide();
          $("#view_team").hide();
          $("#no_team").hide();
          $("#profile_for_admin").hide();
          $("#profile_admin_only").hide();
          $("#admin_only2").hide();
          $("#university_docs").hide();
        }
        else if (position == 0){
          $("#all_project").hide();
          $("#team_project").hide();
          $("#admin_card").hide();
          $("#view_for_admin").hide();
          $("#manage_team").hide()
          $("#manage_time").hide()
          $("#manage_user").hide()
          $("#manage_intern").hide()
          $("#webinar").hide()
          $("#permission").hide()
          $("#add_for_admin").hide();
          $("#pending").hide();
          $("#logs").hide();
          $("#report_for_admin").hide();
          $("#admin_only").hide();
          $("#admin_only1").hide();
          $("#submit_team_project").hide();
          $("#weekly_report").hide();
          $("#view_team_project").hide();
          $("#view_co_team").hide();
          $("#view_team").hide();
          $("#view_member_team").hide();
          $("#team").hide();
          $("#profile_for_admin").hide();
          $("#profile_admin_only").hide();
          $("#admin_only2").hide();
          $("#university_docs").hide();

        }
        }else if(uty == 'Admin'){

        $("#intern_online").hide();  
        $("#view_team_project").hide();
        $("#view_project").hide();
        $("#submit_team_project").hide();
        $("#submit_project").hide();
        $("#intern_card").hide();
        $("#view_for_staff").hide();
        $("#add_for_staff").hide();
        $("#apply_leave").hide();
        $("#leave_status").hide();
        $("#report_for_intern").hide();
        $("#take_attendance").hide();
        $("#take_attendance1").hide();
        $("#weekly_report").hide();
        $("#announce").hide();
        $("#intern_only").hide();
        $("#intern_only1").hide();
        $("#profile_for_intern").hide();
        $("#profile_intern_only").hide();
        $("#take_attendance2").hide();
        $("#take_attendance3").hide();
        $("#take_attendance4").hide();        
        }
        else if(uty == 'Staff'){
         $("#intern_online").hide();
        $("#view_team_project").hide();
        $("#view_project").hide();
        $("#submit_team_project").hide();
        $("#submit_project").hide();
        $("#intern_card").hide();
        $("#view_for_admin").hide();
        $("#add_for_admin").hide();
        $("#apply_leave").hide();
        $("#leave_status").hide();
        $("#report_for_intern").hide();
        $("#take_attendance").hide();
        $("#take_attendance1").hide();
        $("#weekly_report").hide();
        $("#announce").hide();
        $("#intern_only").hide();
        $("#intern_only1").hide();
        $("#profile_for_intern").hide();
        $("#profile_intern_only").hide();
        $("#take_attendance2").hide();
        $("#take_attendance3").hide();
        $("#take_attendance4").hide();           
        }else{
		  if(user_name == undefined){
			  window.location.replace('../index.html');
		  }else{
            window.location.href='../main.html';
          }            
        }
        checkShift(user_name);
	
	///////////////
	
        $(document).ready(function() {
            $('#calendar').fullCalendar({
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            header: {
                left: 'prev,next',
                center: 'title',
                //right: 'month,agendaWeek,agendaDay,listDay,listWeek,listMonth',
                right: 'today,month,listWeek,listMonth',
            },
            views: {
                listDay: { buttonText: 'List day' },
                listWeek: { buttonText: 'List week' },
                listMonth: { buttonText: 'List month' },
                month: { buttonText: 'Month' },
                today: { buttonText: 'Today' },
                agendaWeek: { buttonText: 'Week' },
            },
            editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        timeFormat:"h:mma",
        defaultView:'month',
        scrollTime: '08:00', // undo default 6am scrollTime
        eventOverlap:false,
        allDaySlot: false,


				
                select: function(start, end) {
				if(uty == "Admin" || uty == "Staff"){

                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
				}
                },
                eventRender: function(event, element) {
				if(uty == "Admin" || uty == "Staff"){
                    element.bind('dblclick', function() { //gawin mong CLICK yung parameter para maging single
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        //$('#ModalEdit #start').val(event.start);
                        $('#ModalEdit #start').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalEdit #end').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                    //	$('#ModalEdit #end').val(event.end);
                        $('#ModalEdit').modal('show');
                          //var formattedTime = $.fullCalendar.formatDates(event.start, event.end, "HH:mm { - HH:mm}");

                        });
				}

                },

                eventDrop: function(event, delta, revertFunc) { // si changement de position

                    edit(event);

                },
                eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                    edit(event);

                },

                eventMouseover: function(Event, jsEvent) {
                    var tooltip = '<div style="width:auto;height:20%;color:black;background:#E5E5E5;position:absolute;z-index:10001;border-radius:5px;top: -300%;left:50%; padding:5px 10px;margin-left:-60px;bottom: 150%;font-size: 15px;" class="tooltip" >' +'<b>WHAT :</b>&nbsp;'+ Event.title + '<br><b>DURATION :</b>&nbsp;'+(moment(Event.start).format('hh:mm A'))+'&nbsp;-&nbsp;'+(moment(Event.end).format('hh:mm A'))+'<br><b>STATUS:</b> '+Event.status+'<br><b>OTHER DETAILS:</b> Please check the announcement in discord or check the announcement in dashboard panel.</div>';

                    var $tooltip = $(tooltip).appendTo('body');

                    $(this).mouseover(function(e) {
                        $(this).css('z-index', 10000);
                        $tooltip.fadeIn('500');
                        $tooltip.fadeTo('10', 1.9);
                    }).mousemove(function(e) {
                        $tooltip.css('top', e.pageY + 10);
                        $tooltip.css('left', e.pageX + 20);
                    });
                },

                eventMouseout: function(Event, jsEvent) {
                    $(this).css('z-index', 8);
                    $('.tooltip').remove();
                },


                events: [
                <?php foreach($events as $event):
					
					$c_date = date("Y-m-d");
					$c_time = date("H:i:s");
					
					$sd = new DateTime($event['start']);
					$ed = new DateTime($event['end']);
					
					$start_date = $sd->format('Y-m-d');
					$end_date = $ed->format('Y-m-d');
					
					$start_time = $sd->format('H:i:s');
					$end_time = $ed->format('H:i:s');
					
					if($c_date == $start_date)
					{
						if($c_time >= $end_time)
						{
							$status="Ended";
							$color="#FF0000";
						}else if($c_time >= $start_time && $c_time <= $end_time)
						{
							$status="Happening Now";
							$color="#008000";
							
						}else if($c_time < $start_time){
							
							$status="Upcoming";
							$color="#0071c5";
							
						}else{
							$status="Happening Now";
							$color="#008000";
						}
					}else if($c_date > $end_date){
						
						$status="Ended";
						$color="#FF0000";
					}
					else{
						$status="Upcoming";
						$color="#0071c5";
					}
					
                    $start = explode(" ", $event['start']);
                    $end = explode(" ", $event['end']);
                    if($start[1] == '00:00:00'){
                        $start = $start[0];
                    }else{
                        $start = $event['start'];
                    }
                    if($end[1] == '00:00:00'){
                        $end = $end[0];
                    }else{
                        $end = $event['end'];
                    }
                    ?>
                    {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
						status: '<?php echo $status; ?>',
                        color: '<?php echo $color; ?>',
                    },
                <?php endforeach; ?>
                ]
            });


            function edit(event){
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if(event.end){
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                }else{
                    end = start;
                }

                id =  event.id;

                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;

                $.ajax({
                    url: 'editEventDate.php',
                    type: "POST",
                    data: {Event:Event},
                    success: function(rep) {
                        if(rep == 'OK'){
                            //alert('Saved');
                            swal("Done!","Successfully MOVED!","success");
                        }else{
                            //alert('Could not be saved. try again.');
                            swal("Cancelled", "Could not be saved. Please try again", "error");
                        }
                    }
                });
            }



        });

    </script>
    <script>

            $.ajax({
				type: "POST",
				url: "../api/updateOnline.php?id="+user_name, 				
				success: function(){ 
                    
				}
				
			});

</script>
<script>

        $.ajax({
				type: "GET",
				async: false,
				url: "../api/count_online.php", 				
				success: function(response){ 

					    $("#count_online").html(response); 
                    
				}
				
			});
      


</script>
	    <script>
            $.ajax({
				type: "GET",
				async: false,
				url: "../api/updateCalendar.php?id="+user_name, 				
				success: function(response){}				
			});
		</script>
</html>