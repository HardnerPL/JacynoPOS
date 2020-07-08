<div class="popup-bg center-content">
	<div class="popup w-100">
		<div class="p-4">
			<h2 class=""><?= $item->item_name ?></h2>
			<input type="text" class="form-control rounded-0 text-center" id="comment-input"
				   placeholder="Komentarz" value="<?= $item->item_comment ?>">
			<?php if ($item->item_type == 'pizza') { ?>
				<div class="text-center mt-2">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="" id="to-go-checkbox"
							<?php
							if (isset($item->to_go_id)) {
								echo 'checked';
							}
							?>>
						<label class="form-check-label" for="to-go-checkbox">
							Wynos
						</label>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="row no-gutters text-light">
			<div class="col-6">
				<a onclick="confirm_edit_item_popup(<?= $item->order_item_id ?>)"
				   class="p-2 btn btn-primary w-100 rounded-0"><h5>Zatwierdź</h5></a>
			</div>
			<div class="col-6">
				<a onclick="close_popup()" class="p-2 btn btn-danger w-100 rounded-0"><h5>Anuluj</h5></a>
			</div>
		</div>
	</div>
</div>
