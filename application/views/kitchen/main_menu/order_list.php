<div id="kitchen-order-list" class="row h-85">
	<div class="col-12 overflow-scroll h-100">
		<?php
		foreach ($order_items as $item) { ?>
			<div class="row border h-25 <?php if ($item->item_status == 'ready') echo 'bg-light-green' ?>"
				 id="item-row-<?= $item->order_item_id ?>">
				<div class="col-2 p-0">
					<img src="<?= $item->item_image ?>" alt="Image" width="100%" class="">
				</div>
				<div class="col-2 p-0 border-right border-left">
					<div class="row no-gutters h-50 border-bottom">
						<div class="col-12 center-content">
							<h1><?= $item->item_time ?></h1>
						</div>
					</div>
					<div class="row no-gutters h-50">
						<div class="col-12 center-content">
							<h1><?= $item->order_table ?></h1>
						</div>
					</div>
				</div>
				<div class="col p-2 border-right">
					<h1><?= $item->item_name ?></h1>
					<h4 class="font-weight-normal"><?= $item->item_comment ?></h4>
				</div>
				<div class="col-2 p-0">
					<?php
					if ($item->item_status == 'ready') { ?>
						<a id="btn-<?= $item->order_item_id ?>"
						   onclick="item_delivered_popup(<?= $item->order_item_id ?>)"
						   class="btn p-0 m-0 btn-success text-light w-100 center-content rounded-0 h-100">
							<i class="fas fa-check"></i>
						</a>
					<?php } else { ?>
						<a id="btn-<?= $item->order_item_id ?>" onclick="item_ready_popup(<?= $item->order_item_id ?>)"
						   class="btn p-0 m-0 btn-success text-light w-100 center-content rounded-0 h-100">
							<i class="fas fa-check"></i>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</div>
