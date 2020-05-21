$(document).ready(function () {
	load_main_menu();
})

function load_main_menu() {
	$.get("kitchen/kitchen_main_menu/load_main_menu", function (data) {
		$("#container").html(data);
		square_buttons();
	})
}
