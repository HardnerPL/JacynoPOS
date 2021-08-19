<div id="order-row-<?= $order->order_id ?>" class="row no-gutters text-center <?php
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
	<div class="col-2 p-1 center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_id % 100 . ' / ' . $order->order_table ?></div>
	<div class="col-2 p-1 center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= date('H:i', strtotime($order->order_datetime)) ?></div>
	<div class="col center-content"
		 onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')">
		<span class="fa-stack fa-1x">
			<i class="fas fa-circle fa-stack-2x <?= $order->drinks_delivered ? 'text-success' : 'text-danger' ?>"></i>
			<i class="fas fa-wine-glass fa-stack-1x text-light"></i>
		</span>
	</div>
	<div class="col-5">
		<div class="row waiter-actions-row no-gutters">
			<div class="col h-100">
				<a onclick="checkout_order_popup(<?= $order->order_id ?>)"
				   class="btn <?= $order->order_paid ? 'btn-warning' : 'btn-grey' ?> w-100 h-100 rounded-0 p-0 center-content">
					<i class="fas fa-dollar-sign text-light"></i>
				</a>
			</div>
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
			<div class="col">
				<a onclick="edit_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-success w-100 rounded-0 p-3">
					<i class="far fa-edit text-light"></i>
				</a>
			</div>
			<div class="col">
				<a onclick="confirm_close_order_popup(<?= $order->order_id ?>)"
				   class="btn btn-danger w-100 rounded-0 p-3">
					<i class="far fa-trash-alt text-light"></i>
				</a>
			</div>
		</div>
	</div>
</div>
