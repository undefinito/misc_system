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
				<?php 
					$_col_count = 2;
					foreach ($systems_list as $i => $system): ?>
					
					<?php if (($i%$_col_count)==0): ?>
						<div class="row">
					<?php endif ?>
					
						<div class="<?php echo "col-lg-",@intval(12/$_col_count) ?>">
							
							<?php 
								$r_num = rand(0,4);
								$color = array('bg-red','bg-yellow','bg-purple','bg-blue','bg-aqua');
							 ?>

							<a href="<?php echo base_url($system['url']) ?>">
								<div class="small-box <?php echo $color[$r_num] ?>">
									<div class="inner">
										<h3><?php echo $system['title'] ?></h3>

										<p><?php echo $system['description'] ?></p>
									</div>
									<div class="icon">
										<i class="fa <?php echo empty($system['icon']) ? 'fa-server' : $system['icon'] ?>"></i>
									</div>
								</div>
							</a>

						</div>
						<!-- col -->

					<?php if ((($i+1)%$_col_count)==0): ?>
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