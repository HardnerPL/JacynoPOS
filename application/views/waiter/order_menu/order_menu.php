<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/28/2019
 * Time: 1:03 PM
 */
?>
<div id="order-menu-list" class="row h-60">
	<div class="col-12 h-100 overflow-scroll p-0">
		<?php foreach ($order_items as $item) { ?>
			<div class="row no-gutters">
				<div class="col-10 p-1">
					<div>
						<div><b><?= $item->item_name ?></b></div>
					</div>
					<div>
						Cena: <?= $item->item_price ?> zł
						<b class="float-right mr-2"><?= $item->price ?> zł</b>
					</div>
				</div>
				<div class="col-2">
					<a onclick="confirm_delete_item_popup(<?= $item->order_item_id ?>)" href="#"
					   class="btn btn-danger w-100 h-100 rounded-0 center-content">
						<i class="fas fa-trash-alt"></i>
					</a>
				</div>
			</div>
			<hr class="m-0">
		<?php } ?>
	</div>
</div>

