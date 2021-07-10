$(document).ready(function () {
	load_main_menu();
	window.selectMode = false;
	window.setInterval(function () {
		refresh_order_items();
	}, 5000);
	window.setInterval(function () {
		flash_late();
	}, 800)
})

function load_main_menu() {
	$.get("kitchen/kitchen_main_menu/load_main_menu", function (data) {
		$("#container").html(data);
		refresh_order_items();
	})
}

function refresh_order_items() {
	if (!window.selectMode) {
		$.get("kitchen/kitchen_main_menu/order_list", function (data) {
			let scrollTop = $("#kitchen-order-list").children().first().scrollTop();
			$("#kitchen-order-list").replaceWith(data);
			$("#kitchen-order-list").children().first().scrollTop(scrollTop);
			// $('.ready-btn').on('mousedown', function (e) {
			// 	window.timeoutId = setTimeout(() => show_ready_selects(e), 1000);
			// }).on('mouseup mouseleave', function () {
			// 	clearTimeout(window.timeoutId);
			// });
		});
	}
}

function item_ready_popup(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_ready_popup/" + order_item_id, function (data) {
		$("body").append(data);
	})
}

function item_ready(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_ready/" + order_item_id, function () {
		$("#item-row-" + order_item_id).addClass('bg-light-green');
		$("#item-row-" + order_item_id).attr('onclick',
			'item_delivered_popup(' + order_item_id + ')');
	})
}

function item_delivered_popup(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_delivered_popup/" + order_item_id, function (data) {
		$("body").append(data);
	})
}

function item_delivered(order_item_id) {
	$.get("kitchen/kitchen_main_menu/item_delivered/" + order_item_id, function () {
		$("#item-row-" + order_item_id).remove();
	})
}

function show_ready_selects(e) {
	let box = e.target.parentElement;
	while (!box.classList.contains('btn-box')) {
		box = box.parentElement;
	}
	box.querySelector('input').checked = true;
	window.selectMode = true;
	$('#select-controls').removeClass('d-none');
	$('.ready-btn').addClass('d-none');
	$('.ready-select').removeClass('d-none');
}

function hide_selects() {
	window.selectMode = false;
	$('#select-controls').addClass('d-none');
	$('.ready-btn').removeClass('d-none');
	$('.ready-select').addClass('d-none');
}

function flash_late() {
	let soups = $('*[data-late="true"]');
	soups.each(function () {
		if ($(this).hasClass('bg-late')) $(this).removeClass('bg-late');
		else $(this).addClass('bg-late');
	});
}
