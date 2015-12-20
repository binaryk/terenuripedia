<?php

$router->group(['middleware' => 'auth'], function () {
    get('terrain-buyer', 'BuyerController@index')->name('buyer.search');
});