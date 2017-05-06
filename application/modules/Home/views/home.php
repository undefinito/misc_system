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
		<form action="<?php echo base_url('auth/login') ?>" method="post">
			<div class="form-group has-feedback">
				<input class="form-control" name="u" placeholder="Username" type="text">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input class="form-control" name="pw" placeholder="Password" type="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-4 col-xs-offset-4">
					<button type="submit" class="btn btn-warning btn-sm btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->