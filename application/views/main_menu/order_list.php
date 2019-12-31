<div id="main-menu-table" class="row h-auto overflow-scroll">
	<div class="col-12">
		<div class="row text-center">
			<div class="col-3">
				#
			</div>
			<div class="col-3">
				Stolik
			</div>
			<div class="col-3">
				Godzina
			</div>
		</div>
		<hr class="m-0">
		<?php
		foreach ($orders as $order) {
			$data['order'] = $order;
			$this->view('main_menu/order_list_row', $data); ?>
			<hr class="m-0">
		<?php } ?>
	</div>
</div>
