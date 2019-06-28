<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/26/2019
 * Time: 12:57 PM
 */
?>
<div class="text-center">
    <h2 id="price">
        <script>
            get_price()
        </script>
    </h2>
    <ul class="list-inline">
        <li class="list-inline-item">
            <a href="#" onclick="delete_order(<?= $current_order ?>)" class="btn btn-dark">Usuń</a>
        </li>
        <li class="list-inline-item">
            <a href="#" onclick="edit_current_order(<?= $current_order ?>)" class="btn btn-dark">Edytuj</a>
        </li>
    </ul>
</div>
