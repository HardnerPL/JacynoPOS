<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 11:11 PM
 */
?>

<div class="overflow-scroll h-75">
	<h1 class="text-center">Szczegóły</h1>
	<hr>

	<?php
	foreach ($order_items as $item) {
		?>
		<div>
			<div class="row">
				<div class="col-9">
					<div>
						<div><b><?= $item->item_name ?></b></div>
					</div>
					<div>
						<?= $item->item_count . " x " . $item->item_price ?>
						<b class="float-right"><?= $item->price . " zł" ?></b>
					</div>
					<div>
						<?= $item->comment ?>
					</div>
				</div>
				<div class="col-3">
					<a onclick="load_edit_item_form(<?= $item->order_id . ", " . $item->item_id ?>)" href="#"
					   class="btn btn-primary mb-2"><i
							class="far fa-sticky-note text-light"></i></a>
					<a onclick="confirm_delete_order_item(<?= $item->order_id . ", " . $item->item_id ?>)" href="#"
					   class="btn btn-danger mb-2"><i
							class="fas fa-trash-alt text-light"></i></a>
				</div>
			</div>
		</div>
		<hr>
		<?php
	}
	?>
</div>
