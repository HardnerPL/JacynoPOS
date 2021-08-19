$(document).ready(function () {
	load_main_menu();
})

function load_main_menu() {
	$.get("waiter/main_menu/load_main_menu", function (data) {
		$("#container").html(data);
		square_buttons();
		clearInterval(window.refresh_interval);
		window.refresh_interval = window.setInterval(load_main_menu, 10000)
	})
}

function add_order() {
	$.ajax({
		url: "waiter/main_menu/add_order",
		type: "post",
		data: {
			table: $("#table-input").val()
		},
		dataType: "text",
		success: function () {
			load_order_menu();
		}
	})
}

function load_main_menu_row(row_id) {
	$.get("waiter/main_menu/load_order_list_row/" + row_id, function (data) {
		$("#order-row-" + row_id).replaceWith(data);
		square_buttons();
	})
}

function delete_main_menu_row(row_id) {
	$("#order-row-" + row_id).next("hr").remove();
	$("#order-row-" + row_id).remove();
}

function confirm_close_order_popup(order_id) {
	$.get("waiter/main_menu/confirm_close_order_popup/" + order_id, function (data) {
		$("body").append(data);
	})
}

function close_order(order_id) {
	$.get("waiter/main_menu/close_order/" + order_id);
	load_main_menu();
}

function checkout_order_popup(order_id) {
	$.get("waiter/main_menu/checkout_order_popup/" + order_id, function (data) {
		$("body").append(data);
	})
}

function edit_order_popup(order_id) {
	$.get("waiter/main_menu/edit_order_popup/" + order_id, function (data) {
		$("body").append(data);
	})
}

function confirm_edit_order_popup(order_id) {
	$.get("waiter/main_menu/confirm_edit_order_popup/" + order_id, function (data) {
		$("#edit_order_popup").addClass("d-none");
		$("body").append(data);
		$("#comment").html($("#edit-comment-input").val())
		$("#table").html($("#edit-table-input").val())
	})
}

function edit_order(order_id) {
	$.ajax({
		url: "waiter/main_menu/edit_order/" + order_id,
		type: "post",
		data: {
			order_comment: $("#edit-comment-input").val(),
			order_table: $("#edit-table-input").val()
		},
		success: function () {
			load_main_menu_row(order_id);
		}
	})
}

function deliver_utensils_popup(order_id) {
	$.get("waiter/main_menu/confirm_utensils_delivery_popup/" + order_id, function (data) {
		$("body").append(data);
	})
}

function deliver_utensils(order_id) {
	$.get("waiter/main_menu/deliver_utensils/" + order_id);
	close_popup();
	$('#deliver-utensils-btn-' + order_id).remove();
}

function checkout_order(order_id) {
	$.get("waiter/main_menu/checkout_order/" + order_id);
	close_popup();
	load_main_menu();
}
