<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 8:53 PM
 */
foreach ($categories as $row) {
	echo "<li class='list-inline-item'><a href='#' onclick='load_item_list($row->category_id)' class='btn btn-primary btn-square mb-2'>$row->category_name</a></li>";
}
