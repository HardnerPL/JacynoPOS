<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 9:27 PM
 */
?>
<div class="col-12">
	<div class="row no-gutters">
<?php foreach ($items as $item) { ?>
	<div class="col-4 p-1">
		<a href=#" onclick="load_item_form(<?= $item->item_id ?>)"
		   class="btn btn-primary btn-square rounded-0 center-content p-0"><?= $item->item_name ?></a>
	</div>
<?php } ?>
	</div>
</div>
