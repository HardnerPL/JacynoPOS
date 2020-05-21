<div class="row h-85">
	<div class="col-12 overflow-scroll h-100">
		<?php
		foreach ($order_items as $item) { ?>
			<div class="row">
				<div class="col-2 p-0">
					<img src="<?= $item->item_image ?>" alt="Image" width="100%" class="btn-square border">
				</div>
				<div class="col-2 p-0">
					<div class="row no-gutters h-50 border">
						<div class="col-12 center-content">
							<b><?= $item->order_id ?></b>
						</div>
					</div>
					<div class="row no-gutters h-50 border">
						<div class="col-12 center-content">
							<b><?= $item->item_time ?></b>
						</div>
					</div>
				</div>
				<div class="col p-0 border">
					<b><?= $item->item_name ?></b><br>
					<?= $item->item_comment ?>
				</div>
				<div class="col-2 p-0 border">
					<a class="btn p-0 m-0 btn-success text-light w-100 center-content rounded-0 btn-square">
						<i class="fas fa-check"></i>
					</a>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
</div>
