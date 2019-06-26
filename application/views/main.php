<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/9/2019
 * Time: 8:47 PM
 */
?>
<div class="container-fluid">
    <div class="h-25 center-content">
        <a href="#" onclick="load_categories()" class="btn btn-dark">Home</a>
    </div>
    <div class="h-50">
        <ul id="main-menu" class="h-100 list-inline p-2">
            Loading...
        </ul>
    </div>
    <div class="h-25 center-content">
        <div class="text-center">
            <h2 id="price">Cena: 0.00zł</h2>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="#" onclick="delete_current_order()" class="btn btn-dark">Usuń</a>
                </li>
                <li class="list-inline-item">
                    <a href="#" onclick="edit_current_order()" class="btn btn-dark">Edytuj</a>
                </li>
            </ul>
        </div>
    </div>
</div>
