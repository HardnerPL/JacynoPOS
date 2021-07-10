<div id="order-row-<?= $order->order_id ?>" class="row text-center <?php
switch ($order->order_status) {
	case 'new':
		echo 'bg-muted';
		break;
	case 'ready':
		echo 'bg-light-yellow';
		break;
	case 'delivered':
		echo 'bg-light-green';
		break;
}
?>">
	<div class="col center-content py-3"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_id % 100 ?></div>
	<div class="col center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_table ?></div>
	<div class="col center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_time ?></div>
	<div class="col-4">
		<div class="row no-gutters h-100">
			<div class="col h-100">
				<?php if (!$order->order_utensils) { ?>
					<a id="deliver-utensils-btn-<?php echo $order->order_id ?>"
					   onclick="deliver_utensils_popup(<?= $order->order_id ?>)" href="#"
					   class="btn btn-success w-100 h-100 rounded-0 p-0 center-content">
						<i class="fas fa-utensils"></i>
					</a>
				<?php } ?>
			</div>
			<div class="col h-100">
				<a onclick="load_order_menu(<?= $order->order_id ?>)" href="#"
				   class="btn btn-primary w-100 h-100 rounded-0 p-0 center-content">
					<i class="far fa-sticky-note"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="col-12 collapse text-left border-top border" id=<?= 'order-info-' . $order->order_id ?>>
		<div class="p-2">
			<?= $order->order_comment ?>
		</div>
		<div class="row no-gutters">
			<div class="col-4">
				<a onclick="edit_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-success w-100 rounded-0 p-3">
					<i class="far fa-edit text-light"></i>
				</a>
			</div>
			<div class="col-4">
				<a onclick="checkout_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-warning w-100 rounded-0 p-3">
					<i class="fas fa-dollar-sign text-light"></i>
				</a>
			</div>
			<div class="col-4">
				<a onclick="confirm_close_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-danger w-100 rounded-0 p-3">
					<i class="far fa-trash-alt text-light"></i>
				</a>
			</div>
		</div>
	</div>
</div>
