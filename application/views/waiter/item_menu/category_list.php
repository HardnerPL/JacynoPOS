<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 8:53 PM
 */
?>
<div id="item-menu-main" class="row h-85">
	<div class="col-12 px-1">
		<div class="row no-gutters">
			<?php foreach ($categories as $row) { ?>
				<div class="col-4 col-sm-3 col-md-2 p-1">
					<a onclick="load_item_list(<?= $row->category_id ?>)"
					   class="btn btn-primary btn-square rounded-0 center-content p-0 btn-wrap text-light"><?= $row->category_name ?></a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
