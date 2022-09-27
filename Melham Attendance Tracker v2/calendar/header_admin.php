<header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header" style="margin:15px;">
                    <ul class="nav navbar-nav navbar-right">

                   <a href="admin" style="color: white;text-decoration: none;margin-top:10px;">
                    <b>  <i class="glyphicon glyphicon-calendar">Calendar</i>
                    </a></b>

                       <a href="admin_request"  style="color: white;text-decoration: none;margin-top:10px;"> &nbsp;&nbsp;&nbsp;&nbsp;
               <i class="glyphicon glyphicon-list-alt "></i> Appointment Request
                        </a></b>

                        <a a href="#" data-toggle="modal" data-target="#modal_Add_User" style="color: white;text-decoration: none;margin-top:10px;"> &nbsp;&nbsp;&nbsp;&nbsp;
                <i class="glyphicon glyphicon-user "></i> Add User
                         </a></b>



          <!--      <a href="archive" style="color: white;text-decoration: none;">&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>  <i class="glyphicon glyphicon-ok-sign hidden"></i>
                  </a></b> -->

                 <!--  <a href="#" style="color: white;text-decoration: none;">&nbsp;&nbsp;&nbsp;&nbsp;
                  <b>  <i class="glyphicon glyphicon-bell "></i> Notifications
                  </a></b> -->


                </ul>
                  </div>

            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;text-decoration: none;margin-right: 40px;">
                      <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['member_first'];?>

                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
              <li><!-- start notification -->
                <a href="profile">
                    <i class="glyphicon glyphicon-user text-green"></i> Profile
                  </a>
                          </li><!-- end notification -->

                          <li><!-- start notification -->
                            <a href="logout.php">
                              <i class="glyphicon glyphicon-off text-red"></i> Logout
                            </a>
                          </li><!-- end notification -->


                        </ul>
                      </li>

                    </ul>
                  </li>


                </ul>
              </div><!-- /.navbar-custom-menu -->
        </nav>
      </header>
