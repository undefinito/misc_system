<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php // EDIT DEPENDING ON SYSTEM-SPECIFIC LAYOUT/TEMPLATE ?>

<!DOCTYPE html>
<html>
	<?php echo empty($header)?'':$header ?>
<body <?php echo empty($body_class)?'':"class='{$body_class}'" ?>>
	<?php echo empty($body)?'':$body ?>

	<?php echo empty($footer)?'':$footer ?>
	<?php echo empty($js)?'':$js ?>
</body>
</html>