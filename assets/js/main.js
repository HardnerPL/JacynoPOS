$(document).ready(function () {
	load_main_menu();
})

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

function close_popup() {
	$(".popup-bg").remove();
}

function forward_order(order_id) {
	$.ajax({
		url: "order_status/forward_order/" + order_id,
		success: function (data) {
			load_main_menu_row(order_id);
		}
	})
}

function give_out_order(order_id) {
	$.ajax({
		url: "order_status/give_out_order/" + order_id,
		success: function (data) {
			load_main_menu_row(order_id);
		}
	})
}

function close_order(order_id) {
	$.ajax({
		url: "order_status/close_order/" + order_id,
		success: function (data) {
			delete_main_menu_row(order_id);
		}
	})
}

function trigger_collapse(collapse_id) {
	current_collapse_id = window.current_collapse_id;
	if (current_collapse_id) $("#" + current_collapse_id).collapse('hide');
	if (current_collapse_id != collapse_id) {
		current_collapse_id = collapse_id;
		$("#" + collapse_id).collapse('toggle');
	} else {
		delete (window.current_collapse_id);
	}
}

function square_buttons() {
	$(".btn-square").height($(".btn-square").width());
}
