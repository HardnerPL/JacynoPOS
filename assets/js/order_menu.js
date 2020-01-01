function load_item_menu() {
	$.ajax({
		url: "order_menu/load_item_menu",
		success: function (data) {
			window.current_menu = "item_menu";
			$("#container").html(data);
		}
	});
}

function load_item_list(category_id) {
	$.ajax({
		url: "order_menu/load_item_list",
		type: "post",
		data: {
			category_id: category_id
		},
		success: function (data) {
			window.current_menu = "item_list";
			window.current_category = category_id;
			$("#order-menu-main").html(data);
			square_buttons();
		}
	})
}

function load_category_list() {
	$.get("order_menu/load_category_list", function (data) {
		window.current_menu = "order_menu";
		$("#order-menu-main").html(data);
		square_buttons();
	})
}

function load_item_form(item_id) {
	$.ajax({
		url: "order_menu/load_item_form",
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
		url: "order_menu/add_item",
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
		url: "order_menu/get_price",
		type: "post",
		dataType: "text",
		success: function (value) {
			$("#price").html("Cena: " + value + "zł");
		}
	})
}

function load_order_menu(order_id) {
	$.ajax({
		url: "order_menu/load_order_menu/" + order_id,
		success: function (data) {
			$("#container").html(data);
			window.current_menu = "order_menu";
		}
	})
}

function load_edit_item_form(order_id, item_id) {
	$.ajax({
		url: "order_menu/load_edit_item_form",
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
		url: "order_menu/delete_order_item",
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

function edit_item(item_id) {
	$.ajax({
		url: "order_menu/edit_item",
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

function confirm_delete_item_popup(order_id, order_item_id) {
	$.get("order_menu/confirm_delete_item_popup/" + order_id + '/' + order_item_id, function (data) {
		$("body").append(data);
	})
}

function confirm_edit_item_popup(item_id) {
	$.ajax({
		url: "order_menu/confirm_edit_item_popup",
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

function change_item_count(value) {
	input = parseInt($("#count-input").val());
	if (input != "" && input + value > 0) {
		$("#count-input").val(input + value);
	}
}

