<div id="order-row-<?= $order->order_id ?>" class="row text-center <?php
	switch($order->order_status) {
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
	<div class="col center-content" onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_id ?></div>
	<div class="col center-content" onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_table ?></div>
	<div class="col center-content" onclick="trigger_collapse('<?= 'order-info-' . $order->order_id ?>')"><?= $order->order_time ?></div>
	<div class="col">
		<a onclick="load_order_menu(<?= $order->order_id ?>)" href="#" class="btn btn-primary btn-square w-100 rounded-0 p-0 center-content">
			<i class="far fa-sticky-note"></i>
		</a>
	</div>
	<div class="col-12 collapse text-left" id=<?= 'order-info-' . $order->order_id ?>>
		<div class="m-2">
			Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
			squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
			sapiente ea proident.
		</div>
		<div class="row no-gutters">
			<div class="col-4">
				<a href="#" class="btn btn-primary w-100 rounded-0">
					<i class="far fa-sticky-note text-light"></i>
				</a>
			</div>
			<div class="col-4">
				<a href="#" class="btn btn-danger w-100 rounded-0">
					<i class="far fa-sticky-note text-light"></i>
				</a>
			</div>
			<div class="col-4">
				<a href="#" class="btn btn-warning w-100 rounded-0">
					<i class="far fa-sticky-note text-light"></i>
				</a>
			</div>
		</div>
	</div>
</div>
