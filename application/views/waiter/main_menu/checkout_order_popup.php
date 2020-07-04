<div class="popup-bg center-content">
	<div class="popup">
		<div class="p-4 text-center">
			<div class="mb-1">
				<b>Kody do zamówienia <?= $order_id ?></b>
			</div>
			<div class="row">
				<?php
				foreach ($codes as $code) { ?>
					<div class="col-12 text-center">
						<?= $code->item_count . " x " . $code->item_code . " KOD" ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="row no-gutters">
			<div class="col-12">
				<a onclick="close_popup()" class="btn btn-success w-100 rounded-0 text-light">Okej</a>
			</div>
		</div>
	</div>
</div>
