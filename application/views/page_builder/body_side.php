<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
	<?php echo empty($header)?'':$header ?>
<body <?php echo empty($body_class)?'':"class='{$body_class}'" ?>>
	<div class="wrapper">
		<div class="content-wrapper">
			<?php echo empty($body)?'':$body ?>
		</div>
		<!-- content-wrapper -->
	</div>
	<!-- wrapper -->

	<?php echo empty($footer)?'':$footer ?>
	<?php echo empty($js)?'':$js ?>
</body>
</html>