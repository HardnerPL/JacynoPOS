<div id="order-row-<?= $order->order_id . $order->order_status ?>" class="row text-center <?php
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
	<div class="col center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_id ?></div>
	<div class="col center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_table ?></div>
	<div class="col center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_time ?></div>
	<div class="col">
		<a onclick="load_order_menu(<?= $order->order_id ?>)" href="#"
		   class="btn btn-primary btn-square w-100 rounded-0 p-0 center-content">
			<i class="far fa-sticky-note"></i>
		</a>
	</div>
	<div class="col-12 collapse text-left" id=<?= 'order-info-' . $order->order_id ?>>
		<div class="row no-gutters">
			<div class="col-6">
				<a onclick="checkout_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-warning w-100 rounded-0 p-3">
					<i class="fas fa-dollar-sign text-light"></i>
				</a>
			</div>
			<div class="col-6">
				<a onclick="confirm_close_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-danger w-100 rounded-0 p-3">
					<i class="far fa-trash-alt text-light"></i>
				</a>
			</div>
		</div>
	</div>
</div>
