<div class="popup-bg center-content">
	<div class="popup p-4">
		<div><?php echo $message ?></div>
		<div class="text-center text-light mt-3">
			<a onclick="<?php echo $yes ?>"
			   class="btn btn-primary mr-2">Tak</a>
			<a onclick="<?php echo $no ?? 'close_popup()' ?>" class="btn btn-danger">Nie</a>
		</div>
	</div>
</div>
