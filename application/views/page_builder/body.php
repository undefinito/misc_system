<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php // EDIT DEPENDING ON SYSTEM-SPECIFIC LAYOUT/TEMPLATE ?>

<!DOCTYPE html>
<html>
	<?php echo empty($header)?'':$header ?>
<body <?php echo empty($body_class)?'':"class='{$body_class}'" ?>>
<div class="wrapper">
	<?php echo empty($body)?'':$body ?>
	
</div>

	<?php echo empty($footer)?'':$footer ?>
	<?php echo empty($js)?'':$js ?>
</body>
</html>