<div class="popup-bg center-content">
	<div class="popup w-100">
		<div class="p-4 text-center">
			<div class="mb-1">
				<b>Kody do zamówienia <?= $order_id ?></b>
			</div>
			<div class="row">
				<?php
				foreach ($codes as $code) { ?>
					<div class="col-6">
						<b>
							<?= $code->count . " x " . $code->name . " " . $code->price ?> zł
						</b>
					</div>
					<div class="col-6">
						<?php
						$string = '';
						if ($code->count > 1) {
							$string .= $code->count . ' x ';
						}
						$string .= $code->code . ' KOD';
						if ($code->dynamic_price == true) {
							$string .= ' ' . $code->price . " OK";
						}

						echo $string;
						?>
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
