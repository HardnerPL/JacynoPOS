<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/28/2019
 * Time: 1:03 PM
 */
?>

<div id="order-menu-navbar" class="center-content h-auto">
	<a href="#" onclick="load_main_menu()" class="btn btn-dark mr-2">Home</a>
	<a href="#" onclick="load_last_page()" class="btn btn-dark">Back</a>
</div>
<div id="category_menu">
	<ul id="order-menu-main" class="h-100 list-inline">
		<script>load_order_menu_category_list()</script>
	</ul>
</div>
<div id="order-menu-info" class="h-auto center-content">
	<div class="text-center">
		<h2 id="price">
			<script>
                update_price()
			</script>
		</h2>
		<ul class="list-inline">
			<li class="list-inline-item">
				<a href="#" onclick="delete_order(<?= $current_order ?>)" class="btn btn-dark">Usuń</a>
			</li>
			<li class="list-inline-item">
				<a href="#" onclick="edit_order_menu(<?= $current_order ?>)" class="btn btn-dark">Edytuj</a>
			</li>
		</ul>
	</div>
</div>
