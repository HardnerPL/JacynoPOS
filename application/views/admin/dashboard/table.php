<?php
	$sum = 0;
?>
<div class="container pt-3">
	<form class="form-inline" method="GET" action="">
		<div class="form-group mb-2 mr-2">
			<input class="form-control" name="date" type="date">
		</div>
		<button class="btn btn-primary mb-2" type="submit">Zobacz</button>
	</form>

	<table class="table">
		<thead>
		<tr>
			<th scope="col">Typ</th>
			<th scope="col">Ilość</th>
			<th scope="col">Wartość</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($categories as $category) {
			$sum += $category->value
			?>
			<tr>
				<th scope="row"><?php echo $category->type ?></th>
				<td><?php echo $category->count ?></td>
				<td><?php echo $category->value ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<div class="text-center">
		<b>Suma: <?php echo $sum ?> zł</b>
	</div>
</div>
