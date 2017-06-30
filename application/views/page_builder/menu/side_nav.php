<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<header class="main-header">
	<!-- Logo -->
	<a href="<?php echo base_url('savings_monitor') ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>Sv</b>M</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Savings</b>Monitor</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo asset_url('img/anonymous.png') ?>" class="user-image" alt="User Image">
						<span class="hidden-xs"><?php echo empty($_SESSION['user_data']['full_name']) ? '[namae]' : $_SESSION['user_data']['full_name'] ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="<?php echo asset_url('img/anonymous.png') ?>" class="img-circle" alt="User Image">

							<p>
								<?php echo empty($_SESSION['user_data']['full_name']) ? '[namae]' : $_SESSION['user_data']['full_name'] ?>
								<small>Member since <?php echo empty($_SESSION['user_data']['user_since']) ? '[namae]' : $_SESSION['user_data']['user_since'] ?></small>
							</p>
						</li>
						<!-- Menu Body -->
						<li class="user-body">
							<div class="row">
								<div class="col-xs-6 text-center">
									<a href="<?php echo base_url('account') ?>">Account</a>
								</div>
								<div class="col-xs-6 text-center">
									<a href="#">Settings</a>
								</div>
							</div>
							<!-- /.row -->
						</li>
					</ul>
				</li>
				<li>
					<a href="<?php echo base_url('logout') ?>">
						<i class="fa fa-power-off"></i>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>

<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar" style="height: auto;">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo asset_url('img/anonymous.png') ?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo empty($_SESSION['user_data']['full_name']) ? '[namae]' : $_SESSION['user_data']['full_name'] ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>


		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu tree" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
				<?php if ( @is_array($_menu_arr) ): ?>
				<?php foreach ($_menu_arr as $i => $item): ?>
					<?php if ($item['link'] == $current_link): ?>
						<li class="active">
					<?php else: ?>
						<li>
					<?php endif ?>
						<a href="<?php echo base_url($item['link']) ?>">
							<i class="<?php echo 'fa ',$item['icon'] ?>"></i>
							<span><?php echo $item['menu'] ?></span>
						</a>
					</li>
				<?php endforeach ?>
			<?php endif ?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
