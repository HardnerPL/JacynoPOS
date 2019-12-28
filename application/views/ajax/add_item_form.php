<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 9:51 PM
 */

?>

<div class="center-content">
	<div>
		<div class="form-group">
			<label for="count">Ilość</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<button onclick="change_item_count(-1)" type="button" class="btn btn-primary">-</button>
				</div>
				<input type="number" class="form-control" id="count-input" placeholder="Ilość" value="1">
				<div class="input-group-append">
					<button onclick="change_item_count(1)" type="button" class="btn btn-primary">+</button>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="comment">Komentarz</label>
			<input type="text" class="form-control" id="comment-input" placeholder="Komentarz">
		</div>
		<div class="text-center">
			<button onclick="add_item(<?= $item_id ?>)" class="btn btn-primary">Dodaj</button>
		</div>
	</div>
</div>
