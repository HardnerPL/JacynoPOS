<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 11:11 PM
 */
?>

<div class="col-12 h-100 overflow-scroll">
	<?php foreach ($order_items as $item) { ?>
		<div class="row no-gutters">
			<div class="col-10 p-1"
				 onclick="load_edit_item_form(<?= $item->order_id . ", " . $item->item_id ?>)">
				<div>
					<div><b><?= $item->item_count . " x " . $item->item_name ?></b></div>
				</div>
				<div>
					Cena: <?= $item->item_price ?> zł
					<b class="float-right mr-2"><?= $item->price?> zł</b>
				</div>
				<div>
					<?= $item->comment ?>
				</div>
			</div>
			<div class="col-2">
				<a onclick="confirm_delete_item_popup(<?= $item->order_id . ", " . $item->item_id ?>)" href="#"
				   class="btn btn-danger w-100 h-100 rounded-0 center-content">
					<i class="far fa-trash-alt fa-sticky-note text-light"></i>
				</a>
			</div>
		</div>
		<hr class="m-0">
	<?php } ?>
</div>
