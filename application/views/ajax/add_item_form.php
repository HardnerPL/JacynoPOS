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
			<input type="text" class="form-control" id="count-input" placeholder="Ilość">
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
