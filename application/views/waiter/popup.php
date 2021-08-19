<div class="popup-bg center-content">
	<div class="popup p-4">
		<h3 class="text-center"><?php echo $title ?? '' ?></h3>
		<div><?php echo $message ?? '' ?></div>
		<div class="text-center text-light mt-3">
			<a onclick="<?php echo $yes ?>"
			   class="btn btn-primary mr-2"><?php echo $yes_message ?? 'Tak' ?></a>
			<a onclick="<?php echo $no ?? 'close_popup()' ?>" class="btn btn-danger"><?php echo $no_message ?? 'Nie' ?></a>
		</div>
	</div>
</div>
