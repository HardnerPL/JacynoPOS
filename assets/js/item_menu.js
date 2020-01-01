function load_item_menu() {
	$.ajax({
		url: "item_menu/load_item_menu",
		success: function (data) {
			window.current_menu = "item_menu";
			$("#container").html(data);
			square_buttons();
		}
	});
}

function load_category_list() {
	$.get("item_menu/load_category_list", function (data) {
		window.current_menu = "order_menu";
		$("#item-menu-main").replaceWith(data);
		square_buttons();
	})
}

function load_item_list(category_id) {
	$.ajax({
		url: "item_menu/load_item_list",
		type: "post",
		data: {
			category_id: category_id
		},
		success: function (data) {
			window.current_menu = "item_list";
			window.current_category = category_id;
			$("#item-menu-main").replaceWith(data);
			square_buttons();
		}
	})
}

function load_item_form(item_id) {
	$.ajax({
		url: "item_menu/load_item_form",
		type: "post",
		data: {
			item_id: item_id
		},
		success: function (data) {
			window.current_menu = "item_form";
			$("#item-menu-main").html(data);
		}
	})
}

function add_item(item_id) {
	$.ajax({
		url: "item_menu/add_item",
		type: "post",
		data: {
			item_id: item_id,
			item_count: $("#count-input").val(),
			item_comment: $("#comment-input").val()
		},
		dataType: "text",
		success: function () {
			load_order_menu();
		}
	})
}
