<div class="popup-bg center-content">
	<div class="popup p-4">
		<div>Czy potwierdzasz wydanie tego przedmiotu?</div>
		<div class="text-center text-light mt-3">
			<a onclick="deliver_item(<?= $order_item_id ?>); close_popup()"
			   class="btn btn-primary mr-2">Tak</a>
			<a onclick="close_popup()" class="btn btn-danger">Nie</a>
		</div>
	</div>
</div>
