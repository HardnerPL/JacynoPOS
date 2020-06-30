<div class="popup-bg center-content">
	<div class="popup p-4">
		<div class="col-12">
			<div class="row">
				<div class="col-12 h-100 center-content">
					<h2 class="m-0"><?= $item->item_name ?></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12 h-100 p-0">
					<input type="text" class="form-control h-100 rounded-0 text-center" id="comment-input"
						   placeholder="Komentarz" value="<?= $item->item_comment ?>">
				</div>
			</div>
			<div class="text-center text-light mt-3">
				<a onclick="confirm_edit_item_popup(<?= $item->order_item_id ?>)"
				   class="btn btn-primary mr-2">Zatwierdź</a>
				<a onclick="close_popup()" class="btn btn-danger">Anuluj</a>
			</div>
		</div>
	</div>
</div>
