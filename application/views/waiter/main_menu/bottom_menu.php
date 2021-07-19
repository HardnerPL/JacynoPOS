<div class="row no-gutters fixed-bottom center-content h-10">
	<div class="col-6 h-100 p-0">
		<select class="h-100 custom-select rounded-0" id="table-input">
			<option selected value="0">Stolik...</option>
			<?php foreach ($tables as $table) {
				echo "<option value=\"$table\">$table</option>";
			} ?>
		</select>
	</div>
	<div class="col-6 h-100 p-0">
		<a onclick="add_order()" href="#" class="btn btn-primary w-100 h-100 rounded-0 center-content">
			<i class="fas fa-plus btn-icon"></i>
		</a>
	</div>
</div>
