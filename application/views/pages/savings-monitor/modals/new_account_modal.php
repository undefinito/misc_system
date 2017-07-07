<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-dialog modal-black">
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">
			<i class="fa fa-close"></i>
		</button>
		<p>
			<i class="fa fa-thumb-tack"></i>
			Only <u>letters</u> and <abbr data-toggle="tooltip" data-trigger="hover" title="-">hyphens</abbr> are allowed as the <b>Account Name</b>.
		</p>
	</div>
	<div class="modal-content">
				

		<div class="modal-header">
			<h4 class="modal-title">
				<i class="fa fa-asterisk"></i>
				New Account

				<div class="btn-toolbar pull-right">
					<button class="btn btn-sm btn-flat btn-outline">
						<i class="fa fa-save"></i>
						Save
					</button>
					<button type="button" class="btn btn-sm btn-flat btn-outline" data-dismiss="modal">
						Cancel
					</button>
				</div>
			</h4>
		</div>
		<!-- modal-header -->
		<div class="modal-body">
					
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-lg-3">Account Name</label>
					<div class="col-lg-9">
						<input type="text" name="acct_name" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-lg-3">Initial amount</label>
					<div class="col-lg-5">
						<div class="input-group">
							<span class="input-group-addon text-green">
								<i class="fa fa-money"></i>
							</span>
							<input type="text" name="initial_amt" class="form-control bold text-green" placeholder="0.00" />
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- modal-body -->
		<div class="modal-footer"></div>
		<!-- modal-footer -->
	</div>
	<!-- modal-content -->
</div>
<!-- modal-dialog -->
