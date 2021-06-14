<div class="popup-bg center-content">
	<div class="popup p-4">
		<div>Czy na pewno chcesz zamknąć to zamówienie?</div>
		<div class="text-center text-light mt-3">
			<a onclick="close_order(<?= $order_id ?>); close_popup()"
			   class="btn btn-primary mr-2">Tak</a>
			<a onclick="close_popup()" class="btn btn-danger">Nie</a>
		</div>
	</div>
</div>
