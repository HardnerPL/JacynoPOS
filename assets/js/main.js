function load_last_page() {
	switch (current_menu) {
		case "order_menu":
			window.current_menu = "main_menu";
			load_main_menu();
			break;
		case "item_list":
			window.current_menu = "order_menu";
			load_category_list();
			break;
		case "item_menu":
		case "edit_item_form":
			window.current_menu = "edit_order";
			load_order_menu();
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

function change_item_count(value) {
	input = parseInt($("#count-input").val());
	if (input != "" && input + value > 0) {
		$("#count-input").val(input + value);
	}
}
