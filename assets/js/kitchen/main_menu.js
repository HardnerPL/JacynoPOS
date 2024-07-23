$(document).ready(function () {
	load_main_menu();
	window.selectMode = false;
	window.setInterval(function () {
		refresh_order_items();
		refresh_item_sums();
	}, 5000);
	window.setInterval(function () {
		flash_late();
	}, 800)
})

function load_main_menu() {
	$.get("kitchen/kitchen_main_menu/load_main_menu", function (data) {
		$("#container").html(data);
		refresh_order_items();
		refresh_item_sums();
	})
}

function refresh_order_items() {
	if (window.selectMode) {
		return;
	}

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

function refresh_item_sums() {
	$.get("kitchen/kitchen_main_menu/get_item_sums", function (orderItemCounts) {
		const COLUMNS = 4;
		let container = document.getElementById('item-sums-container');
		let newContainer = container.cloneNode();

		for (let col_index = 0; col_index < COLUMNS; col_index++) {
			let col = document.createElement('div');
			col.classList.add('col');

			const ul = document.createElement('ul');
			col.appendChild(ul);

			let item_index = 0;
			orderItemCounts.forEach(orderItemCount => {
				if (item_index++ % COLUMNS !== col_index) {
					return; // Similar to "continue" in PHP
				}
				const item_count_name = `${orderItemCount.display_name} x ${orderItemCount.count}`;
				const li = document.createElement('li');
				li.textContent = item_count_name;
				ul.appendChild(li);
			});

			newContainer.appendChild(col);
		}

		container.replaceWith(newContainer);
	});
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
