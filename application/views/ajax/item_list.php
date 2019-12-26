<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 9:27 PM
 */

foreach ($items as $item) {
	echo "<li class='list-inline-item'><a href='#' onclick='load_item_form($item->item_id)' class='btn btn-primary btn-square mb-2'>$item->item_name</a></li>";
}
