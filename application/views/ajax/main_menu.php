<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/28/2019
 * Time: 12:28 PM
 */
?>
<div class="row center-content m-4">
	<h1>Lista zamówień</h1>
</div>
<div class="row overflow-scroll h-75">
	<div class="col-12">
		<div class="row text-center">
			<div class="col-2">
				#
			</div>
			<div class="col-2">
				Stolik
			</div>
			<div class="col-4">
				Godzina
			</div>
			<div class="col-4">
				Opcje
			</div>
		</div>
		<hr>
		<?php
		foreach ($orders as $order) {
			$collapse_id = 'order-info-' . $order->order_id ?>
			<div class="row text-center">
				<div class="col-2"><?= $order->order_id ?></div>
				<div class="col-2"><?= $order->order_table ?></div>
				<div class="col-4"><?= $order->order_time ?></div>
				<div class="col-4">
					<a class="btn btn-dark" data-toggle="collapse" data-target="#<?= $collapse_id ?>" role="button"
					   aria-expanded="false" aria-controls="<?= $collapse_id ?>">
						<i class="fas fa-info text-light"></i>
					</a>
					<a onclick="load_order_menu(<?= $order->order_id ?>)" href="#" class="btn btn-primary"><i
							class="far fa-sticky-note text-light"></i></a>
					<a onclick="confirm_delete_order(<?= $order->order_id ?>)" href="#" class="btn btn-danger">
						<i class="fas fa-trash-alt text-light"></i>
					</a>
				</div>
				<div class="col-12 collapse text-left" id=<?= $collapse_id ?>>
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
					squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
					sapiente ea proident.
				</div>
			</div>
			<hr>
			<?php
		}
		?>
	</div>
</div>
<div class="row h-auto center-content">
	<div class="offset-md-2 col-6">
		<div class="row">
			<div class="col-6">
				<input type="text" class="form-control" id="table-input" placeholder="Stolik">
			</div>
			<div class="col-6">
				<button onclick="add_order()" type="submit" class="btn btn-primary">Dodaj</button>
			</div>
		</div>
	</div>
</div>
