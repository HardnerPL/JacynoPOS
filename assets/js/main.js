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
			window.current_menu = "item_list";
			window.current_category = category_id;
			$("#order-menu-main").html(data);
		}
	})
}

function load_main_menu() {
	$.get("ajax/load_main_menu", function (data) {
		$("#container").html(data);
	})
}

function load_order_menu(order_id) {
	$.ajax({
		url: "ajax/load_order_menu",
		type: "post",
		data: {
			order_id: order_id
		},
		success: function (data) {
			window.current_menu = "order_menu";
			$("#container").html(data);
		}
	});
}

function load_order_menu_category_list() {
	$.get("ajax/load_order_menu_category_list", function (data) {
		window.current_menu = "order_menu";
		$("#order-menu-main").html(data);
	})
}

function load_item_form(item_id) {
	$.ajax({
		url: "ajax/load_item_form",
		type: "post",
		data: {
			item_id: item_id
		},
		success: function (data) {
			window.current_menu = "item_form";
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

function edit_order_menu() {
	$.ajax({
		url: "ajax/edit_order_menu",
		success: function (data) {
			$("#order-menu-main").html(data);
			window.current_menu = "edit_order";
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

function load_edit_item_form(order_id, item_id) {
	$.ajax({
		url: "ajax/load_edit_item_form",
		type: "post",
		data: {
			order_id: order_id,
			item_id: item_id
		},
		success: function (data) {
			$("#order-menu-main").html(data);
			window.current_menu = "edit_item_form";
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
	switch (current_menu) {
		case "order_menu":
			window.current_menu = "main_menu";
			load_main_menu();
			break;
		case "edit_order":
		case "item_list":
			window.current_menu = "order_menu";
			load_order_menu_category_list();
			break;
		case "edit_item_form":
			window.current_menu = "edit_order";
			edit_order_menu();
			break;
		case "item_form":
			window.current_menu = "item_list";
			load_item_list(current_category);
			break;
	}
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

function forward_order(order_id) {
	$.ajax({
		url: "order_status/forward_order/" + order_id,
		success: function (data) {
			load_main_menu();
		}
	})
}

function give_out_order(order_id) {
	$.ajax({
		url: "order_status/give_out_order/" + order_id,
		success: function (data) {
			load_main_menu();
		}
	})
}

function close_order(order_id) {
	$.ajax({
		url: "order_status/close_order/" + order_id,
		success: function (data) {
			load_main_menu();
		}
	})
}

function trigger_collapse(collapse_id) {
	$("#" + collapse_id).collapse('toggle');
}

function change_item_count(value) {
	input = parseInt($("#count-input").val());
	if (input != "" && input + value > 0) {
		$("#count-input").val(input + value);
	}
}
