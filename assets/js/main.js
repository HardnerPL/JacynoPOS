$(document).ready(function () {
	load_main_menu();
})

function load_item_list(category_id) {
	$.ajax({
		url: "ajax/load_item_list",
		type: "post",
		data: {
			category_id: category_id
		},
		success: function (data) {
			$("#order-menu-main").html(data);
			window.current_menu = "items";
		}
	})
}

function load_main_menu() {
	$.get("ajax/main_menu", function (data) {
		$("#container").html(data);
	})
}

function load_order_menu() {
	$.get("ajax/order_menu", function (data) {
		$("#container").html(data);
	})
}

function load_order_menu_category_list() {
	$.get("ajax/order_menu_category_list", function (data) {
		$("#order-menu-main").html(data);
		window.current_menu = "categories";
	})
}

function add_item_prompt(item_id) {
	$.ajax({
		url: "ajax/add_item_prompt",
		type: "post",
		data: {
			item_id: item_id
		},
		success: function (data) {
			$("#order-menu-main").html(data);
		}
	})
}

function add_item(item_id) {
	$.ajax({
		url: "ajax/add_item",
		type: "post",
		data: {
			item_id: item_id,
			item_count: $("#count-input").val(),
			item_comment: $("#comment-input").val()
		},
		dataType: "text",
		success: function () {
			load_order_menu_category_list();
			update_price();
		}
	})
}

function update_price() {
	$.ajax({
		url: "ajax/get_price",
		type: "post",
		dataType: "text",
		success: function (value) {
			$("#price").html("Cena: " + value + "zł");
		}
	})
}

function delete_order(order_id) {
	$.ajax({
		url: "ajax/delete_order",
		type: "post",
		data: {
			order_id: order_id
		},
		success: function () {
			load_main_menu();
		}
	})
}

function edit_order_menu() {
	$.ajax({
		url: "ajax/edit_order_menu",
		success: function (data) {
			$("#order-menu-main").html(data);
			window.current_menu = "edit_order";
		}
	})
}

function load_order(order_id) {
	$.ajax({
		url: "ajax/load_order",
		type: "post",
		data: {
			order_id: order_id
		},
		success: function () {
			load_order_menu();
		}
	})
}

function add_order() {
	$.ajax({
		url: "ajax/add_order",
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

function edit_order_item(order_id, item_id) {
	$.ajax({
		url: "ajax/edit_order_item",
		type: "post",
		data: {
			order_id: order_id,
			item_id: item_id
		},
		success: function (data) {
			$("#order-menu-main").html(data);
			window.current_menu = "edit_order_item";
		}
	})
}

function delete_order_item(order_id, item_id) {
	$.ajax({
		url: "ajax/delete_order_item",
		type: "post",
		data: {
			order_id: order_id,
			item_id: item_id
		},
		success: function (data) {
			load_order_menu_category_list();
			update_price();
		}
	})
}

function load_last_page() {
	if (current_menu == "categories")
		load_main_menu();
	else if (current_menu == "edit_order_item")
		edit_order_menu();
	else
		load_order_menu_category_list();
}

function edit_item(item_id) {
	$.ajax({
		url: "ajax/edit_item",
		type: "post",
		data: {
			item_id: item_id,
			item_count: $("#count-input").val(),
			item_comment: $("#comment-input").val()
		},
		dataType: "text",
		success: function () {
			load_order_menu_category_list();
			update_price();
		}
	})
}

function confirm_delete_order(order_id) {
	$.get("ajax/confirm_delete_order/" + order_id, function (data) {
		$("body").append(data);
	})
}

function confirm_delete_order_item(order_id, order_item_id) {
	$.get("ajax/confirm_delete_order_item/" + order_id + '/' + order_item_id, function (data) {
		$("body").append(data);
	})
}

function close_popup() {
	$(".popup-bg").remove();
}

function confirm_edit_order_item(item_id) {
	$.ajax({
		url: "ajax/confirm_edit_order_item",
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
