
<div class="col-12 h-100">
	<div class="row h-15">
		<div class="col-12 h-100 center-content">
			<h2 class="m-0"><?= $item->item_name ?></h2>
		</div>
	</div>
	<div class="row h-25">
		<div class="col-12 p-0">
			<div class="row no-gutters h-100">
				<div class="col-3 h-100">
					<a onclick="change_item_count(-1)" href="#" class="btn btn-danger rounded-0 w-100 h-100 center-content">-</a>
				</div>
				<div class="col h-100">
					<input type="number" class="form-control h-100 rounded-0 text-center" id="count-input"
						   placeholder="Ilość" value="<?= $item->item_count ?>">
				</div>
				<div class="col-3 h-100">
					<a onclick="change_item_count(1)" href="#" class="btn btn-success rounded-0 w-100 h-100 center-content">+</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row h-25">
		<div class="col-12 h-100 p-0">
			<input type="text" class="form-control h-100 rounded-0 text-center" id="comment-input"
				   placeholder="Komentarz" value="<?= $item->comment ?>">
		</div>
	</div>
	<div class="row h-15">
		<a onclick="confirm_edit_item_popup(<?= $item->item_id ?>)" href="#" class="btn btn-success rounded-0 w-100 h-100 center-content">Dodaj</a>
	</div>
</div>
