<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- JQuery -->
<script type="text/javascript" src="<?php echo asset_url('js/jquery-2.1.4.min.js') ?>"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- AdminLTE JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/admin_lte/js/app.min.js') ?>"></script>
<!-- DataTables JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/datatables/datatables.min.js') ?>"></script>
<!-- Inputmask JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/inputmask/jquery.inputmask.bundle.min.js') ?>"></script>
<!-- Filter_input JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/filter_input/filter_input.js') ?>"></script>
<!-- Moment JS -->
<script type="text/javascript" src="<?php echo asset_url('libs/momentjs/moment.js') ?>"></script>
<!-- Common JS Functions -->
<script type="text/javascript" src="<?php echo asset_url('js/common_func.js') ?>"></script>

<script type="text/javascript">
	var baseurl = <?php echo base_url(); ?>;
	var user_id = <?php echo json_encode(empty($_SESSION['user_data']['id']) ? '' : $_SESSION['user_data']['id']) ?>;
	var user_name = <?php echo json_encode(empty($_SESSION['user_data']['username']) ? '' : $_SESSION['user_data']['username']) ?>;
</script>

<!-- Page-specific JS -->
<?php if ( ! empty($js_paths) && is_array($js_paths)): ?>
	<?php foreach ($js_paths as $key => $value): ?>
		<?php switch ($key):
			default: ?>
			<?php if (is_array($value)): ?>

				<?php foreach ($value as $v): ?>
					<?php if (file_exists(asset_path("/js/page/{$key}/{$v}.js"))): ?>
					<script type="text/javascript" src="<?php echo asset_url("js/page/{$key}/{$v}.js") ?>"></script>
					<?php else: ?>
					<script type="text/javascript">
						console.warn(<?php echo json_encode("{$v}.js not found") ?>);
					</script>
					<?php endif ?>
				<?php endforeach ?>
						
			<?php elseif (file_exists(asset_path("/js/page/{$key}/{$value}.js"))): ?>
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