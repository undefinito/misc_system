<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- TODO: rearrange into boxes of separate concerns and repurpose menu list -->
<div class="container space-top-20">
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-sm-6 col-md-12">
					<!-- MENU BOX -->
					<div class="box box-default box-solid">
						<div class="box-body">
							<div class="list-group space-bottom-none" data-list="menu">
								<a href="#info_tab" class="list-group-item active" data-toggle="tab">
									<i class="fa fa-user"></i>
									Information
								</a>
								<a href="#secu_tab" class="list-group-item" data-toggle="tab">
									<i class="fa fa-lock"></i>
									Security
								</a>
							</div>			
							<!-- list-group -->
						</div>
						<!-- box-body -->
					</div>
					<!-- box -->
				</div>
				<!-- col -->
						
				<div class="col-sm-6 col-md-12">
					<!-- IMMUTABLE INFO -->
					<div class="box box-default box-solid">
						<div class="box-body text-left">

							<!-- TODO: better arrangement of immutable info -->
							<div class="row">
								<label class="col-xs-6"> Username </label>
								<div class="col-xs-6">
									<span> <?php echo empty($_SESSION['user_data']['username']) ? '-' : $_SESSION['user_data']['username'] ?> </span>
								</div>
							</div>
									
							<div class="row">
								<label class="col-xs-6"> Account created </label>
								<div class="col-xs-6">
								<span> <?php echo empty($_SESSION['user_data']['user_since']) ? '-' : $_SESSION['user_data']['user_since'] ?> </span>
								</div>
							</div>
								
							<div class="row">
								<label class="col-xs-6"> Last updated </label>
								<div class="col-xs-6">
									<small id="last_update_disp"> <?php echo empty($_SESSION['user_data']['last_update_formatted']) ? '-' : $_SESSION['user_data']['last_update_formatted'] ?> </small>
								</div>
							</div>

						</div>
					</div>
					<!-- box -->
				</div>
				<!-- col -->
					
			</div>
			<!-- row -->

		</div>
		<!-- col -->
		<div class="col-md-9">
			<!-- CONTENT BOXES -->
			<div class="tab-content">
				<div id="alert" class="alert" hidden></div>

				<div id="info_tab" class="box box-warning box-solid tab-pane active">
					<div class="box-header with-border">
						<h4 class="box-title bold">
							<i class="fa fa-user"></i>
							Information
						</h4>
						<div class="box-tools">
							<div class="btn-toolbar pull-right">
								<button id="info_save_btn" type="button" class="btn btn-sm btn-default hidden">
									<i class="fa fa-save"></i>
									Save
								</button>
							</div>
							<!-- btn-toolbar -->
						</div>
					</div>
					<!-- box-header -->
					<div class="box-body">
						
						<div class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-2">First Name</label>
								<div class="col-md-10">
									<input 
										type="text" 
										name="fname" 
										value="<?php echo empty($_SESSION['user_data']['first_name']) ? '' : $_SESSION['user_data']['first_name'] ?>"
										placeholder="<?php echo empty($_SESSION['user_data']['first_name']) ? '' : $_SESSION['user_data']['first_name'] ?>"
										data-orig="<?php echo empty($_SESSION['user_data']['first_name']) ? '' : $_SESSION['user_data']['first_name'] ?>"
										class="form-control" />
								</div>
							</div>
								
							<div class="form-group">
								<label class="control-label col-md-2">Middle Name</label>
								<div class="col-md-10">
									<input 
										type="text" 
										name="mname" 
										value="<?php echo empty($_SESSION['user_data']['middle_name']) ? '' : $_SESSION['user_data']['middle_name'] ?>"
										placeholder="<?php echo empty($_SESSION['user_data']['middle_name']) ? '' : $_SESSION['user_data']['middle_name'] ?>"
										data-orig="<?php echo empty($_SESSION['user_data']['middle_name']) ? '' : $_SESSION['user_data']['middle_name'] ?>"
										class="form-control" />
								</div>
							</div>
								
							<div class="form-group">
								<label class="control-label col-md-2">Last Name</label>
								<div class="col-md-10">
									<input 
										type="text" 
										name="lname" 
										value="<?php echo empty($_SESSION['user_data']['last_name']) ? '' : $_SESSION['user_data']['last_name'] ?>"
										placeholder="<?php echo empty($_SESSION['user_data']['last_name']) ? '' : $_SESSION['user_data']['last_name'] ?>"
										data-orig="<?php echo empty($_SESSION['user_data']['last_name']) ? '' : $_SESSION['user_data']['last_name'] ?>"
										class="form-control" />
								</div>
							</div>
						</div>
						<!-- form-horizontal -->

					</div>
					<!-- box-body -->
				</div>
				<!-- box -->
				
				<div id="secu_tab" class="tab-pane">
					
					<div class="callout callout-warning">
						<i class="fa fa-thumb-tack"></i>
						Password must be between <b>4</b> and <b>50</b> characters!
					</div>

					<div class="box box-warning box-solid">
						<div class="box-header with-border">
							<h4 class="box-title bold">
								<i class="fa fa-lock"></i>
								Security
							</h4>
							<div class="box-tools">
								<div class="btn-toolbar pull-right">
									<button id="secu_save_btn" type="button" class="btn btn-sm btn-default hidden">
										<i class="fa fa-save"></i>
										Save
									</button>
								</div>
								<!-- btn-toolbar -->
							</div>
						</div>
						<!-- box-header -->
						<div class="box-body">

							<div class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-md-2">
										Old Password
										<i data-check="old" class="fa fa-check text-green hidden"></i>
									</label>
									<div class="col-md-10">
										<div class="input-group">
											<input type="password" name="old_pw" class="form-control" />
											<a data-view="pw" class="input-group-addon clickable">
												<i class="fa fa-eye"></i>
											</a>
										</div>
									</div>
								</div>
									
								<div class="form-group">
									<label class="control-label col-md-2">
										New Password
										<i data-check="new" class="fa fa-check text-green hidden"></i>
									</label>
									<div class="col-md-10">
										<div class="input-group">
											<input type="password" name="new_pw" class="form-control" readonly="readonly" />

											<a data-view="pw" class="input-group-addon clickable">
												<i class="fa fa-eye"></i>
											</a>
										</div>
									</div>
								</div>
									
								<div class="form-group">
									<label class="control-label col-md-2">
										Confirm New Password
										<i data-check="confirm" class="fa fa-check text-green hidden"></i>
									</label>
									<div class="col-md-10">
										<div class="input-group">
											<input type="password" data-confirm="new_pw" class="form-control" readonly="readonly" />

											<a data-view="pw" class="input-group-addon clickable">
												<i class="fa fa-eye"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<!-- form-horizontal -->

						</div>
						<!-- box-body -->
					</div>
					<!-- box -->
					
				</div>
				<!-- #secu_tab -->

			</div>
			<!-- tab-content -->
		</div>
		<!-- col -->
	</div>
	<!-- row -->
</div>
<!-- container -->