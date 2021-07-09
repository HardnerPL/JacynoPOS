<div id="kitchen-order-list" class="row overflow-scroll">
	<?php
	$i = 0;
	foreach ($orders as $order_items) {
		foreach ($order_items as $key => $item) { ?>
			<div class="kitchen-tile col-3 p-0 border-bottom
			<?php
			if ($item->item_status == 'ready') {
				echo 'bg-light-green';
			} else if ($item->category_name == 'Pizza') {
				echo 'bg-light-orange';
			} else if ($item->category_name == 'Zupy') {
				echo 'bg-light-purple';
			}
			echo ' ';
			if ($key + 1 == count($order_items)) {
				echo 'thick-border-right';
			} else {
				echo 'border-right';
			}
			?>"
				 id="item-row-<?= $item->order_item_id ?>"
				 onclick="<?php echo $item->item_status == 'ready' ? "item_delivered_popup($item->order_item_id)" : "item_ready_popup($item->order_item_id)" ?>"
				data-category="<?php echo $item->category_name ?>" <?php if (!empty($item->late)) echo 'data-late="true"'?>>
				<div class="row no-gutters h-100">
					<div class="col-3 p-0 border-right center-content">
						<div class="d-flex flex-column h-100">
							<div class="center-content flex-1 border-bottom">
								<b><?= $item->item_time ?></b>
							</div>
							<div class="center-content flex-1 border-bottom">
								<b><?= $item->order_table ?></b>
							</div>
							<div class="center-content flex-1">
								<b>#<?= $item->order_id % 100 ?></b>
							</div>
						</div>
					</div>
					<div class="col p-2">
						<div class="title"><?php
							echo $item->item_name;
							if (isset($item->to_go_id) && !empty($item->to_go_id)) {
								echo " (Wynos)";
							}
							?></div>
						<h6 class="font-weight-normal"><?= $item->item_comment ?></h6>
					</div>
				</div>
			</div>
		<?php }
	} ?>
</div>
<div id="select-controls" class="fixed-bottom row no-gutters d-none">
	<div class="col-6">
		<div class="btn btn-primary center-content w-100 h-100 rounded-0">Tak</div>
	</div>
	<div class="col-6">
		<div onclick="hide_selects()" class="btn btn-danger center-content w-100 h-100 rounded-0">Nie</div>
	</div>
</div>
</div>
