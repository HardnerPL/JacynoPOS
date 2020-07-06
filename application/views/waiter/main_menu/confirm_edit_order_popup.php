<di class="popup-bg center-content">
	<div class="popup w-100">
		<div class="p-4">
			<h2 class="mb-2">Zamówienie <?= $order_id % 100 ?></h2>
			<div>
				<b>Komentarz:</b>
				<span id="comment">
				</span>
			</div>
			<div>
				<b>Stolik:</b>
				<span id="table">
				</span>
			</div>
		</div>
		<div class="row no-gutters text-light">
			<div class="col-6">
				<a onclick="edit_order(<?= $order_id ?>); close_popup()"
				   class="p-2 btn btn-primary w-100 rounded-0"><h5>Tak</h5></a>
			</div>
			<div class="col-6">
				<a onclick="close_popup()" class="p-2 btn btn-danger w-100 rounded-0"><h5>Anuluj</h5></a>
			</div>
		</div>
	</div>
</di>
