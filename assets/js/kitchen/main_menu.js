$(document).ready(function () {
	load_main_menu();
	window.setInterval(function() {
		refresh_order_items();
	}, 15000)
})

function load_main_menu() {
	$.get("kitchen/kitchen_main_menu/load_main_menu", function (data) {
		$("#container").html(data);
		square_buttons();
	})
}

function refresh_order_items() {
	$.get("kitchen/kitchen_main_menu/order_list", function (data) {
		$("#kitchen-order-list").replaceWith(data);
		square_buttons();
	})
}

function item_ready_popup(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_ready_popup/" + order_item_id, function (data) {
		$("body").append(data);
	})
}

function item_ready(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_ready/" + order_item_id, function () {
		$("#item-row-" + order_item_id).addClass('bg-light-green');
		$("#btn-" + order_item_id).attr('onclick',
			'item_delivered_popup(' + order_item_id + ')');
	})
}

function item_delivered_popup(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_delivered_popup/" + order_item_id, function (data) {
		$("body").append(data);
	})
}

function item_delivered(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_delivered/" + order_item_id, function () {
		$("#item-row-" + order_item_id).remove();
	})
}
