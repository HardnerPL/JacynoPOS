<div class="popup-bg center-content">
	<div class="popup p-4">
		<div>Czy na pewno chcesz zmienić ten przedmiot na:</div>
		<div>
			<div>
				<div><b><?= $item->item_name ?></b></div>
			</div>
			<div id="item_count">
			</div>
			<div id="item_comment">
			</div>
		</div>
		<div class="text-center text-light mt-3">
			<a onclick="edit_item(<?= $item->order_item_id ?>); close_popup()" class="btn btn-primary mr-2">Tak</a>
			<a onclick="close_popup()" class="btn btn-danger">Nie</a>
		</div>
	</div>
</div>
