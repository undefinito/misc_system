<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="login-box">
	<div class="login-logo">
		<b>Misc</b> System
	</div>
	<!-- /.login-logo -->
	
	<?php if ( ! empty($invalid_auth)): ?>
	<div class="alert alert-danger">
		Wrong <b>username</b> or <b>password</b>
	</div>
	<?php endif ?>

	<div class="login-box-body">
		<div id="login_alert" hidden></div>
		<form id="login_frm" action="<?php echo base_url('auth/login') ?>" method="post">
			<div class="form-group has-feedback">
				<input class="form-control" name="u" placeholder="Username" type="text">
				<span class="fa fa-user fa-lg form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input class="form-control" name="pw" placeholder="Password" type="password">
				<span class="fa fa-lock fa-lg form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<button id="sign_in_btn" type="button" class="btn btn-warning btn-sm btn-block btn-flat">
						<i class="fa fa-sign-in fa-lg"></i>
						Sign In
					</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->