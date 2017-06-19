<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

	<section class="content">
		
		<div class="jumbotron bg-none">
			<h1>Welcome <b><?php echo empty($_SESSION['user_data']['first_name']) ? '[user name]' : $_SESSION['user_data']['first_name'] ?></b> !</h1>
		</div>
		<!-- jumbotron -->
		
		<div class="row">
			<div class="col-xs-12">
				
				<!-- SYSTEMS -->
				<?php foreach ($systems_list as $i => $system): ?>
					
					<?php if (($i%3)==0): ?>
						<div class="row">
					<?php endif ?>
					
						<div class="col-lg-4">
							<div class="box box-default box-solid">
								<a href="<?php echo base_url($system['url']) ?>" class="shine">
									<div class="box-header with-border">
										<b class="box-title"><?php echo $system['title'] ?></b>
										<span  class="label bg-purple pull-right">
											<i class="fa fa-arrow-right"></i>
										</span>
									</div>
								</a>
								<div class="box-body">
									<?php echo $system['description'] ?>
								</div>
							</div>
							<!-- box -->
						</div>
						<!-- col -->

					<?php if ((($i+1)%3)==0): ?>
						</div>
						<!-- row -->
					<?php endif ?>

				<?php endforeach ?>


			</div>
			<!-- col -->
		</div>
		<!-- row -->

	</section>
	<!-- content -->

</div>
<!-- container -->