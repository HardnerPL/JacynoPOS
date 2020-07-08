function load_order_menu(order_id) {
	if (!order_id) order_id = "";
	$.ajax({
		url: "waiter/order_menu/load_order_menu/" + order_id,
		success: function (data) {
			$("#container").html(data);
			window.current_menu = "order_menu";
			clearInterval(window.refresh_interval);
			window.refresh_interval = window.setInterval(update_item_list, 5000)
		}
	})
}

function update_item_list() {
	$.get("waiter/order_menu/update_item_list", function (data) {
		var scrollTop = $("#order-menu-list").children().first().scrollTop();
		$("#order-menu-list").replaceWith(data);
		update_price();
		$("#order-menu-list").children().first().scrollTop(scrollTop);
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
			update_item_list();
			//TODO: Delete order item row instead of updating
		}
	})
}

function confirm_order(order_id) {
	$.ajax({
		url: "waiter/order_menu/confirm_order/" + order_id,
		success: function (data) {
			update_item_list();
		}
	})
}

function confirm_delete_item_popup(order_id, order_item_id) {
	$.get("waiter/order_menu/confirm_delete_item_popup/" + order_id + '/' + order_item_id, function (data) {
		$("body").append(data);
	})
}

function confirm_edit_item_popup(order_item_id) {
	$.get("waiter/order_menu/confirm_edit_item_popup/" + order_item_id, function (data) {
		$("body").append(data)
		$("#item_comment").html($("#comment-input").val());
	})
}

function confirm_order_popup(order_id) {
	$.get("waiter/order_menu/confirm_order_popup/" + order_id, function (data) {
		$("body").append(data);
	})
}

function edit_item_popup(order_item_id) {
	$.get("waiter/order_menu/edit_item_popup/" + order_item_id, function (data) {
		$("body").append(data);
	})
}

function edit_item(order_item_id) {
	$.ajax({
		url: "waiter/order_menu/edit_item/" + order_item_id,
		type: "post",
		data: {
			item_comment: $("#comment-input").val(),
			item_to_go: $("#to-go-checkbox").prop("checked")
		},
		success: function (data) {
			update_item_list();
		}
	})
}

function confirm_item_delivery_popup(order_item_id) {
	$.get("waiter/order_menu/confirm_item_delivery_popup/" + order_item_id, function (data) {
		$("body").append(data);
	})
}

function deliver_item(order_item_id) {
	$.get("waiter/order_menu/deliver_item/" + order_item_id, function (data) {
		update_item_list();
	})
}

