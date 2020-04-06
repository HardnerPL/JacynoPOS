function load_main_menu() {
	$.get("waiter/main_menu/load_main_menu", function (data) {
		$("#container").html(data);
		square_buttons();
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
	})
}

function delete_main_menu_row(row_id) {
	$("#order-row-" + row_id).next("hr").remove();
	$("#order-row-" + row_id).remove();
}
