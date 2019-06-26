$(document).ready(function() {
    load_categories();
    get_price();
})

function load_items(category_id) {
    $.ajax({
        url: "ajax_items",
        type: "post",
        data: {
            category_id: category_id
        },
        success: function(data) {
            $("#main-menu").html(data);
        }
    })
}

function load_categories() {
    $.get("ajax_categories", function(data) {
        $("#main-menu").html(data);
    })
}

function add_items_prompt(item_id) {
    $.ajax({
        url: "ajax_add_items_prompt",
        type: "post",
        data: {
            item_id: item_id
        },
        success: function(data) {
            $("#main-menu").html(data);
        }
    })
}

function add_items(item_id) {
    $.ajax({
        url: "ajax_add_items",
        type: "post",
        data: {
            item_id: item_id,
            item_count: $("#count-input").val(),
            item_comment: $("#comment-input").val()
        },
        dataType: "text",
        success: function(data) {
            load_categories();
            update_price(data);
        }
    })
}

function get_price() {
    $.ajax({
        url: "ajax_get_price",
        type: "post",
        dataType: "text",
        success: function(data) {
            update_price(data);
        }
    })
}

function update_price(value) {
    $("#price").html("Cena: " + value + "zł");
}

function delete_current_order() {
    $.ajax({
        url: "ajax_delete_current_order",
        success: function(data) {
            get_price();
        }
    })
}

function edit_current_order() {
    $.ajax({
        url: "ajax_edit_order",
        success: function(data) {
            $("#main-menu").html(data);
        }
    })
}