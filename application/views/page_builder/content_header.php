<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if ( ! empty($_content_header)): ?>
	
<section class="content-header">

	<h1>
		<?php echo empty($_content_header['title']) ? '[title]' : $_content_header['title'] ?>
			
		<?php if ( ! empty($_content_header['subtitle'])): ?>
			<small><?php echo empty($_content_header['subtitle']) ? '[subtitle]' : $_content_header['subtitle'] ?></small>
		<?php endif ?>
	</h1>

	<ol class="breadcrumb">
	<?php foreach ($_content_header['breadcrumb'] as $i => $row): ?>

			<?php if (@intval($row['is_active']) > 0): ?>
			<li class="active">
			<?php else: ?>
			<li>
			<?php endif ?>
			
			<?php if (@intval($row['is_active']) == 0 && ! empty($row['link'])): ?>
				<a href="<?php echo base_url($row['link']) ?>">
			<?php endif ?>
					<i class="fa <?php echo empty($row['icon']) ? 'fa-question' : $row['icon'] ?>"></i>
					<?php echo $row['text'] ?>
				</a>
			<?php if (@intval($row['is_active']) == 0 && ! empty($row['link'])): ?>
			<?php endif ?>
			</li>

	<?php endforeach ?>
	</ol>
		
</section>

<?php endif ?>
