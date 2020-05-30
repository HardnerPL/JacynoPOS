<div class="popup-bg center-content">
	<div class="popup p-4">
		<div>Czy na pewno chcesz zatwierdzić to danie?</div>
		<div class="text-center text-light mt-3">
			<?= $order_item_id ?>
			<a onclick="item_ready(<?= $order_item_id ?>); close_popup()"
			   class="btn btn-primary mr-2">Tak</a>
			<a onclick="close_popup()" class="btn btn-danger">Nie</a>
		</div>
	</div>
</div>
