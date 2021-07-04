<div id="kitchen-order-list" class="row overflow-scroll">
	<?php
	$i = 0;
	foreach ($order_items as $item) { ?>
		<div class="kitchen-tile col-4 p-0 border <?php if ($item->item_status == 'ready') echo 'bg-light-green' ?>"
			 id="item-row-<?= $item->order_item_id ?>">
			<div class="row no-gutters h-100">
				<div class="col-3 p-0 border-right border-left">
					<div class="row no-gutters h-50 border-bottom">
						<div class="col-12 center-content">
							<h5><?= $item->item_time ?></h5>
						</div>
					</div>
					<div class="row no-gutters h-50">
						<div class="col-12 center-content">
							<h5><?= $item->order_id % 100 ?></h5>
						</div>
					</div>
				</div>
				<div class="col p-2 border-right">
					<h2><?php
						echo $item->item_name;
						if (isset($item->to_go_id) && !empty($item->to_go_id)) {
							echo " (Wynos)";
						}
						?></h2>
					<h6 class="font-weight-normal"><?= $item->item_comment ?></h6>
				</div>
				<div class="btn-box col-2 p-0">
					<?php
					if ($item->item_status == 'ready') { ?>
						<a id="btn-<?= $item->order_item_id ?>"
						   onclick="item_delivered_popup(<?= $item->order_item_id ?>)"
						   class="delivered-btn btn p-0 m-0 btn-success text-light w-100 center-content rounded-0 h-100">
							<i class="fas fa-check"></i>
						</a>
					<?php } else { ?>
						<a id="btn-<?= $item->order_item_id ?>" onclick="item_ready_popup(<?= $item->order_item_id ?>)"
						   class="ready-btn btn p-0 m-0 btn-success text-light w-100 center-content rounded-0 h-100">
							<i class="fas fa-check"></i>
						</a>
						<div class="ready-select w-100 h-100 center-content d-none">
							<input id="ready-select-<?= $item->order_item_id ?>" type="checkbox" class="form-check-input m-0 w-100 h-100">
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
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
