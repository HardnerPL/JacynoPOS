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
        <th scope="col">Nazwa</th>
        <th scope="col">Ilość</th>
        <th scope="col">Cena</th>
        <th scope="col">Komentarz</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($order_items as $item) {
        ?>
        <tr>
			<td><?= $item->item_name ?></td>
            <td scope="row"><?= $item->item_count ?></td>
            <td><?= $item->price . " zł"?></td>
            <td><?= $item->comment ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
