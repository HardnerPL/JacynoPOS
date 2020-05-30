$(document).ready(function () {
	load_main_menu();
})

function load_main_menu() {
	$.get("kitchen/kitchen_main_menu/load_main_menu", function (data) {
		$("#container").html(data);
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
