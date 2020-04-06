<div id="main-menu-table" class="row h-70 overflow-scroll">
	<div class="col-12 p-0">
		<hr class="m-0">
		<?php
		foreach ($orders as $order) {
			$data['order'] = $order;
			$this->view('waiter/main_menu/order_list_row', $data); ?>
			<hr class="m-0">
		<?php } ?>
	</div>
</div>
