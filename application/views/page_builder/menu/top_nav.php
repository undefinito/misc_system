<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="<?php echo base_url(); ?>" class="navbar-brand"><b>Misc</b> System</a>
			</div>
			<!-- /.navbar-collapse --> 
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu top-menu-fix">
				<ul class="nav navbar-nav">
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="<?php echo asset_url('img/anonymous.png') ?>" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?php echo empty($full_name) ? '[user full name]' : $full_name ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="<?php echo asset_url('img/anonymous.png') ?>" class="img-circle" alt="User Image">

								<p>
								<?php echo empty($full_name) ? '[user full name]' : $full_name ?>
								<small>Member since <?php echo empty($date_created) ? '[date]' : $date_created ?></small>
								</p>
							</li>
							<!-- Menu Body -->
							<li class="user-body">
								<div class="row">
								<div class="col-xs-4 text-center">
									<a href="#">Admin</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Friends</a>
								</div>
								</div>
								<!-- /.row -->
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
							</li>
						</ul>
					</li>

					<li>
						<a href="<?php echo base_url('logout') ?>" title="Log out">
							<i class="fa fa-power-off"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- /.navbar-custom-menu -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	</header>