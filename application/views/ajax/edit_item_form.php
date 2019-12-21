<div class="center-content">
	<div>
		<div class="form-group">
			<label for="count">Ilość</label>
			<input type="text" class="form-control" id="count-input" placeholder="Ilość" value="<?= $order_item->item_count ?>">
		</div>
		<div class="form-group">
			<label for="comment">Komentarz</label>
			<input type="text" class="form-control" id="comment-input" placeholder="Komentarz" value="<?= $order_item->comment ?>">
		</div>
		<div class="text-center">
			<button onclick="confirm_edit_order_item(<?= $order_item->item_id ?>)" class="btn btn-primary">Zatwierdź</button>
		</div>
	</div>
</div>
