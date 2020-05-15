function load_order_menu(order_id) {
	if (!order_id) order_id = "";
	$.ajax({
		url: "waiter/order_menu/load_order_menu/" + order_id,
		success: function (data) {
			$("#container").html(data);
			window.current_menu = "order_menu";
		}
	})
}

function update_price() {
	$.ajax({
		url: "waiter/order_menu/get_price",
		type: "post",
		dataType: "text",
		success: function (value) {
			$("#price").html("Cena: " + value + "zł");
		}
	})
}

function load_edit_item_form(order_id, item_id) {
	$.ajax({
		url: "waiter/order_menu/load_edit_item_form",
		type: "post",
		data: {
			order_id: order_id,
			item_id: item_id
		},
		success: function (data) {
			$("#order-menu-list").html(data);
			window.current_menu = "edit_item_form";
		}
	})
}

function delete_order_item(order_item_id) {
	$.ajax({
		url: "waiter/order_menu/delete_order_item",
		type: "post",
		data: {
			order_item_id: order_item_id,
		},
		success: function (data) {
			load_order_menu();
			update_price();
		}
	})
}

function edit_item(item_id) {
	$.ajax({
		url: "waiter/order_menu/edit_item",
		type: "post",
		data: {
			item_id: item_id,
			item_count: $("#count-input").val(),
			item_comment: $("#comment-input").val()
		},
		dataType: "text",
		success: function () {
			load_order_menu();
			update_price();
		}
	})
}
function confirm_order(order_id) {
	$.ajax({
		url: "waiter/order_menu/confirm_order/" + order_id
	})
}

function confirm_delete_item_popup(order_id, order_item_id) {
	$.get("waiter/order_menu/confirm_delete_item_popup/" + order_id + '/' + order_item_id, function (data) {
		$("body").append(data);
	})
}

function confirm_edit_item_popup(item_id) {
	$.ajax({
		url: "waiter/order_menu/confirm_edit_item_popup",
		type: "post",
		data: {
			item_id: item_id
		},
		dataType: "text",
		success: function (data) {
			$("body").append(data)
			$("#item_count").html($("#count-input").val());
			$("#item_comment").html($("#comment-input").val());
			$(".popup-bg").removeClass('d-none');
		}
	})
}

function confirm_order_popup(order_id) {
	$.get("waiter/order_menu/confirm_order_popup/" + order_id, function (data) {
		$("body").append(data);
	})
}

