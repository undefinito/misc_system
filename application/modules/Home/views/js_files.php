<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- JQuery -->
<script type="text/javascript" src="<?php echo asset_url('js/jquery-2.1.4.min.js') ?>"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- AdminLTE JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/admin_lte/dist/js/app.min.js') ?>"></script>

<?php if ( ! empty($js_paths) && is_array($js_paths)): ?>
	<?php foreach ($js_paths as $key => $value): ?>
		<?php switch ($key):
			default: ?>
			<script type="text/javascript" src="<?php echo asset_url("js/{$key}/{$value}.js") ?>"></script>
		<?php break; ?>
			
		<?php endswitch ?>
	<?php endforeach ?>
<?php else: ?>
	<script type="text/javascript">
		console.warn('JS for page not found');
	</script>
<?php endif ?>