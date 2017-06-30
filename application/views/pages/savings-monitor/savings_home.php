<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<section class="content">

	<div class="row">
		
		<div class="col-lg-4">
			<div class="info-box bg-blue">
				<span class="info-box-icon">
					<i class="fa fa-money"></i>
				</span>

				<div class="info-box-content">
					<span class="info-box-text">Accounts</span>
					<span class="info-box-number"><?php echo @intval($_count['account']) ?></span>
				</div>
			</div>
			<!-- ACCOUNTS info-box -->
		</div>
		<!-- col -->

		<div class="col-lg-4">
			<div class="info-box bg-orange">
				<span class="info-box-icon">
					<i class="fa fa-tasks"></i>
				</span>

				<div class="info-box-content">
					<span class="info-box-text">Total Transactions</span>
					<span class="info-box-number"><?php echo @intval($_count['transaction']) ?></span>
				</div>
			</div>
			<!-- ACCOUNTS info-box -->
		</div>
		<!-- col -->

		<div class="col-lg-4">
			<div class="info-box bg-gray">
				<span class="info-box-icon">
					<i class="fa fa-question"></i>
				</span>

				<div class="info-box-content">
					<span class="info-box-text">Some other 3rd thing</span>
					<span class="info-box-number"><?php echo @intval($_count['3rd']) ?></span>
				</div>
			</div>
			<!-- ACCOUNTS info-box -->
		</div>
		<!-- col -->

	</div>
	<!-- row -->

	<!-- TODO: Graphs row - graphs and charts displaying accounts activity (incomes vs expenses) -->
	<div class="row">

		<div class="col-md-6">
			<div class="box box-primary box-solid" style="min-height: 300px;">
				<div class="box-body">
					<h1 class="text-center" style="margin-top: 15%;">[graph about accounts activity]</h1>
				</div>
			</div>	
		</div>
		<!-- col -->

		<div class="col-md-6">
			<div class="box box-primary box-solid" style="min-height: 300px;">
				<div class="box-body">
					<h1 class="text-center" style="margin-top: 15%;">[graph about accounts income]</h1>
				</div>
			</div>	
		</div>
		<!-- col -->

	</div>
	<!-- row -->

</section>
<!-- content -->