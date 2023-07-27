  <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>I</b>AM</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b> ZZAL </b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top navbar-fixed-top">
          <!-- Sidebar toggle button-->
          
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
          </a>
          
          <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="img/<?php echo $row['profile_picture'] ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">User Accounts</span>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                              <img src="img/<?php echo $row['profile_picture'] ?>" class="img-circle" alt="User Image">
                              <p>
                                 <?php echo $user_name?>
                              </p>
                          </li> <!-- End of <li class="user-header"> -->
                          <li class="user-footer">
                              <div class="pull-left">
                                <a href="user_profile_update_form.php" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
                              </div> <!-- End of <div class="pull-left"> -->
                              <div class="pull-right">
                                <a href="login/logout.php" class="btn btn-default btn-flat">Sign out</a>
                              </div> <!-- End of <div class="pull-right"> -->
                          </li> <!-- End of <li class="user-footer"> -->
                        </ul> <!-- End of <ul class="dropdown-menu"> -->
                  </li> <!-- End of <li class="dropdown user user-menu"> -->
                </ul> <!-- End of <ul class="nav navbar-nav"> -->
          </div> <!-- End of <div class="navbar-custom-menu"> -->
      </nav>
  </header>