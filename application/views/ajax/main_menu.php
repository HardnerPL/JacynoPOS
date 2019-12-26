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
<div class="row mb-5 h-auto overflow-scroll">
    <div class="col-12">
        <div class="row text-center">
            <div class="col-2">
                #
            </div>
            <div class="col-2">
                Stolik
            </div>
            <div class="col-4">
                Godzina
            </div>
            <div class="col-4">
                Opcje
            </div>
        </div>
        <hr>
        <?php
        foreach ($orders as $order) {
            $collapse_id = 'order-info-' . $order->order_id ?>
            <div class="row text-center">
                <div class="col-2" onclick="trigger_collapse('<?= $collapse_id ?>')"><?= $order->order_id ?></div>
                <div class="col-2" onclick="trigger_collapse('<?= $collapse_id ?>')"><?= $order->order_table ?></div>
                <div class="col-4" onclick="trigger_collapse('<?= $collapse_id ?>')"><?= $order->order_time ?></div>
                <div class="col-4">
                    <a onclick="load_order_menu(<?= $order->order_id ?>)" href="#" class="btn btn-primary"><i
                                class="far fa-sticky-note text-light"></i></a>
                    <a onclick="confirm_delete_order(<?= $order->order_id ?>)" href="#" class="btn btn-danger">
                        <i class="fas fa-trash-alt text-light"></i>
                    </a>
                </div>
                <div class="col-12 collapse text-left" id=<?= $collapse_id ?>>
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                    squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt
                    sapiente ea proident.
                </div>
            </div>
            <hr>
            <?php
        }
        ?>
    </div>
</div>
<div class="row h-auto fixed-bottom center-content">
    <div class="offset-md-2 col-12 col-md-6">
        <div class="input-group mb-3 px-2">
            <input type="text" class="form-control" id="table-input" placeholder="Stolik">
            <div class="input-group-append">
                <button onclick="add_order()" type="button" class="btn btn-primary">Dodaj</button>
            </div>
        </div>
    </div>
</div>
