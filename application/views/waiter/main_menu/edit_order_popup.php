<div id="edit_order_popup" class="popup-bg center-content">
	<div class="popup">
		<div class="p-4">
			<h2 class="mb-2">Zamówienie <?= $order->order_id % 100 ?></h2>
			<div class="form-group">
				<label for="edit-comment-input">Komentarz</label>
				<input type="text" class="form-control text-center" id="edit-comment-input"
					   placeholder="Komentarz" value="<?= $order->order_comment ?>">
			</div>
			<div class="form-group">
				<label for="edit-table-input">Stolik</label>
				<input type="text" class="form-control form-control text-center" id="edit-table-input"
					   placeholder="Stolik" value="<?= $order->order_table ?>">
			</div>
		</div>
		<div class="row no-gutters text-light">
			<div class="col-6">
				<a onclick="confirm_edit_order_popup(<?= $order_id ?>)"
				   class="p-2 btn btn-primary w-100 h-100 rounded-0"><h5>Tak</h5></a>
			</div>
			<div class="col-6">
				<a onclick="close_popup()" class="p-2 btn btn-danger w-100 h-100 rounded-0"><h5>Anuluj</h5></a>
			</div>
		</div>
	</div>
</div>
