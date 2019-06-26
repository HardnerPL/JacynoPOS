<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 11:11 PM
 */
?>

<ul>
    <?php
    foreach ($items as $item) {
        $price = $item['count'] * $item['price'];
        echo "<li>
                {$item['name']} x {$item['count']} - {$price}zł <a href='#' onclick='delete_item({$item['id']})' class='btn btn-danger mb-2'>Usuń</a>
            </li>";
    }
    ?>
</ul>
