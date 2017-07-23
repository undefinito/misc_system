<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content">
	
	<div class="row">
		<div class="col-lg-12">
			<div id="page_alert" hidden> </div>
			<!-- #page_alert -->

			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title bold">
						<i class="fa fa-university"></i>
						Accounts
					</h4>
					<div class="box-tools">
						
						<a data-toggle="modal" data-target="#action_modal" data-action="add_account" data-id="<?php echo @intval($_SESSION['user_data']['id']) ?>" class="btn btn-default btn-sm">
							<i class="fa fa-plus-square fa-fw"></i>
							Add Account
						</a>

					</div>
				</div>
				<div class="box-body">
					<table id="accounts_tbl" class="table display">
						<thead>
							<th class="col-account">Account #</th>
							<th class="col-name">Account Name</th>
							<th class="col-amount">Current Amount</th>
							<th class="col-activity">Last Activity</th>
						</thead>
					</table>
				</div>
			</div>

		</div>
		<!-- col -->
	</div>
	<!-- row -->

</section>
<!-- content -->

<div id="action_modal" class="modal fade" data-keyboard="false" data-backdrop="static"></div>
<!-- #action_modal -->