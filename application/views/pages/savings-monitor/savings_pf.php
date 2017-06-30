<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content">
	
	<div class="row">
		<div class="col-lg-12">

			<div class="box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title bold">
						<i class="fa fa-university"></i>
						Accounts
					</h4>
					<div class="box-tools">
						
						<a data-toggle="modal" data-target="#action_modal" data-action="add_account" class="btn btn-default">
							<i class="fa fa-plus-square fa-fw"></i>
							Add Account
						</a>

					</div>
				</div>
				<div class="box-body">
					<table id="accounts_tbl" class="table">
						<thead>
							<th class="col-account">Account #</th>
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