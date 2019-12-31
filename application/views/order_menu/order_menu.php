<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/28/2019
 * Time: 1:03 PM
 */
?>

<div id="order-menu-navbar" class="row h-auto">
	<div class="col-12 h-100 p-0">
		<div class="row no-gutters h-100">
			<div class="col h-100">
				<a href="#" onclick="load_main_menu()" class="btn btn-dark w-100 h-100 rounded-0 center-content">
					<i class="fas fa-home btn-icon"></i>
				</a>
			</div>
			<div class="col h-100">
				<a href="#" onclick="load_last_page()" class="btn bg-dark-red text-light w-100 h-100 rounded-0 center-content">
					<i class="fas fa-arrow-left btn-icon"></i>
				</a>
			</div>
		</div>
	</div>
</div>
<div id="order-menu-main" class="row vh-60">
	<script>load_order_menu_category_list()</script>
</div>
<div id="order-menu-info" class="h-auto center-content row">
	<div class="col-12 p-0 h-100">
		<div class="h-25 text-center">
			<h2 id="price" class="m-0">
				<script>
                    update_price()
				</script>
			</h2>
		</div>
		<div class="h-75">
			<a href="#" onclick="edit_order_menu(<?= $current_order ?>)"
			   class="btn btn-primary rounded-0 center-content w-100 h-100">
				<i class="fas fa-edit btn-icon"></i>
			</a>
		</div>
	</div>
</div>
