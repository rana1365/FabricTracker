<?php
session_start();
require_once("login/db_session_chk.php");

$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$user_type=$_SESSION['user_type'];
$select_sql_for_user="SELECT `profile_picture` FROM `user_login` WHERE `user_name`='$user_name'";
$result= mysqli_query($con, $select_sql_for_user) or die(mysqli_error($con));
$row=mysqli_fetch_assoc($result);
?>
<aside class="main-sidebar">
		  <!-- sidebar: style can be found in sidebar.less -->
		  <section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					  <div class="pull-left image">
						<img src="images/thanos1.jpg" class="img-circle" alt="User Image">
					  </div>
					  <div class="pull-left info">
						<p>Accessories</p>
						<a><i class="fa fa-circle text-success"></i> Online</a>
					  </div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">

					  <li class="header"> REPORTS </li>
					  <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
					  <!-- <li><a href="sales.php"><i class="fa fa-money"></i> <span>Sales</span></a></li> -->
					  <!-- <li class="header">MANAGE</li> -->
					  <li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
					  <li class="treeview" id="main_product_menu">

					  			<a href="#">
								  <i class="fa fa-barcode"></i>
								  <span>Settings</span>
								  <span class="pull-right-container">
											<i class="fa fa-angle-left pull-right"></i>
								  </span>
								</a>
								<ul class="treeview-menu">

								  <li><a onClick="load_page('all_it_asset_forms/json/json_file_parsing_script.php')"><i class="fa fa-circle-o"></i>Json Show</a></li>

								</ul> <!-- End of <ul class="treeview-menu"> -->

					  </li> <!-- End of <li class="treeview" id="main_product_menu"> -->

				</ul> <!-- End of <ul class="sidebar-menu" data-widget="tree"> -->

		  </section>
		  <!-- /.sidebar -->
</aside> <!-- End of <aside class="main-sidebar"> -->
