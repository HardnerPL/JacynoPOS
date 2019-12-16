$(document).ready(function () {
	load_order_menu();
})

function load_items(category_id) {
	$.ajax({
		url: "ajax/items",
		type: "post",
		data: {
			category_id: category_id
		},
		success: function (data) {
			$("#item-menu-main").html(data);
			window.current_menu = "items";
		}
	})
}

function load_order_menu() {
	$.get("ajax/order_menu", function (data) {
		$("#container").html(data);
	})
}

function load_item_menu() {
	$.get("ajax/item_menu", function (data) {
		$("#container").html(data);
	})
}

function load_item_menu_navbar() {
	$.get("ajax/item_menu_navbar", function (data) {
		$("#item-menu-navbar").html(data);
	})
}

function load_item_menu_categories() {
	$.get("ajax/item_menu_categories", function (data) {
		$("#item-menu-main").html(data);
		window.current_menu = "categories";
	})
}

function load_item_menu_info() {
	$.get("ajax/item_menu_info", function (data) {
		$("#item-menu-info").html(data);
	})
}

function add_items_prompt(item_id) {
	$.ajax({
		url: "ajax/add_items_prompt",
		type: "post",
		data: {
			item_id: item_id
		},
		success: function (data) {
			$("#item-menu-main").html(data);
		}
	})
}

function add_items(item_id) {
	$.ajax({
		url: "ajax/add_items",
		type: "post",
		data: {
			item_id: item_id,
			item_count: $("#count-input").val(),
			item_comment: $("#comment-input").val()
		},
		dataType: "text",
		success: function (data) {
			load_item_menu_categories();
			update_price(data);
		}
	})
}

function get_price() {
	$.ajax({
		url: "ajax/get_price",
		type: "post",
		dataType: "text",
		success: function (data) {
			update_price(data);
		}
	})
}

function update_price(value) {
	$("#price").html("Cena: " + value + "zł");
}

function delete_order(order_id) {
	$.ajax({
		url: "ajax/delete_order",
		type: "post",
		data: {
			order_id: order_id
		},
		success: function (data) {
			load_order_menu();
		}
	})
}

function edit_order(order_id) {
	$.ajax({
		url: "ajax/edit_order",
		success: function (data) {
			$("#item-menu-main").html(data);
			window.current_menu = "edit_order";
		}
	})
}

function open_order(order_id) {
	$.ajax({
		url: "ajax/open_order",
		type: "post",
		data: {
			order_id: order_id
		},
		success: function () {
			load_item_menu();
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
			load_item_menu();
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
			$("#item-menu-main").html(data);
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
			edit_order(order_id);
			load_item_menu_info()
		}
	})
}

function load_last_page() {
	if (current_menu == "categories")
		load_order_menu();
	else if (current_menu == "edit_order_item")
		edit_order();
	else
		load_item_menu_categories();
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
		success: function (data) {
			edit_order();
			get_price(data);
		}
	})
}
