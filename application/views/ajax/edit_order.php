<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 11:11 PM
 */
?>

<table class="table h-75">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Stolik</th>
        <th scope="col">Godzina</th>
        <th scope="col">Opcje</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($orders as $order) {
        ?>
        <tr>
            <td scope="row"><?= $order->order_id ?></td>
            <td><?= $order->order_table ?></td>
            <td>12:00</td>
            <td>
                <a href="#" class="btn btn-dark"><i class="fas fa-info text-light"></i></a>
                <a onclick="open_order(<?= $order->order_id ?>)"href="#" class="btn btn-primary"><i class="far fa-sticky-note text-light"></i></a>
                <a onclick="delete_order(<?= $order->order_id ?>)" href="#" class="btn btn-danger"><i class="fas fa-trash-alt text-light"></i></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
