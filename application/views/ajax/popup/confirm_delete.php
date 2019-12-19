<div class="popup-bg center-content">
	<div class="popup p-4">
		<div>Czy na pewno chcesz usunąć?</div>
		<br>
		<div class="text-center text-light">
			<a onclick="delete_order(<?= $delete_id ?>); close_popup()" class="btn btn-primary mr-2">Tak</a>
			<a onclick="close_popup()" class="btn btn-danger">Nie</a>
		</div>
	</div>
</div>
