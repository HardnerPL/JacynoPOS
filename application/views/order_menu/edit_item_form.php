
<div class="col-8 offset-2 center-content">
	<div>
		<div class="form-group">
			<label for="count">Ilość</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button onclick="change_item_count(-1)" type="button" class="btn btn-primary">-</button>
				</div>
			<input type="number" class="form-control" id="count-input" placeholder="Ilość"
				   value="<?= $order_item->item_count ?>">
				<div class="input-group-append">
					<button onclick="change_item_count(1)" type="button" class="btn btn-primary">+</button>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="comment">Komentarz</label>
			<input type="text" class="form-control" id="comment-input" placeholder="Komentarz"
				   value="<?= $order_item->comment ?>">
		</div>
		<div class="text-center">
			<button onclick="confirm_edit_item_popup(<?= $order_item->item_id ?>)" class="btn btn-primary">Zatwierdź
			</button>
		</div>
	</div>
</div>
