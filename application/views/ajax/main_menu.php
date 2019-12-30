<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/28/2019
 * Time: 12:28 PM
 */
?>
<div class="row center-content m-4">
    <h1>Lista zamówień</h1>
</div>
<div id="main-menu-table" class="row h-auto overflow-scroll">
    <div class="col-12">
        <div class="row text-center">
            <div class="col-3">
                #
            </div>
            <div class="col-3">
                Stolik
            </div>
            <div class="col-3">
                Godzina
            </div>
        </div>
        <hr class="m-0">
        <?php
        foreach ($orders as $order) {
			$data['order'] = $order;
            $data['collapse_id'] = 'order-info-' . $order->order_id;
            $this->view('ajax/main_menu/order_list_row', $data);
        }
        ?>
    </div>
</div>
<div class="row h-auto fixed-bottom center-content">
    <div class="col-8 col-sm-6">
        <div class="input-group mb-3 px-2">
            <input type="text" class="form-control" id="table-input" placeholder="Stolik">
            <div class="input-group-append">
                <button onclick="add_order()" type="button" class="btn btn-primary">Dodaj</button>
            </div>
        </div>
    </div>
</div>
