<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- JQuery -->
<script type="text/javascript" src="<?php echo asset_url('js/jquery-2.1.4.min.js') ?>"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- AdminLTE JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/admin_lte/dist/js/app.min.js') ?>"></script>
<?php var_dump($js_paths) ?>

<script type="text/javascript">
	var baseurl = <?php echo base_url(); ?>
</script>

<?php if ( ! empty($js_paths) && is_array($js_paths)): ?>
	<?php foreach ($js_paths as $key => $value): ?>
		<?php switch ($key):
			default: ?>
			<?php if (file_exists(FCPATH."assets/js/page/{$key}/{$value}.js")): ?>
			<script type="text/javascript" src="<?php echo asset_url("js/page/{$key}/{$value}.js") ?>"></script>
			<?php else: ?>
			<script type="text/javascript">
				console.warn(<?php echo json_encode("{$value}.js not found") ?>);
			</script>
			<?php endif ?>
		<?php break; ?>
			
		<?php endswitch ?>
	<?php endforeach ?>
<?php else: ?>
	<script type="text/javascript">
		console.warn('JS for page not found');
	</script>
<?php endif ?>