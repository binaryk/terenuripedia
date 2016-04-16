<?php

$router->group(['middleware' => 'auth'], function () use ($router) {
    get('credit', 'CreditController@index')->name('credit.index');
    get('credit-simulare/{suma}', 'CreditController@simulare')->name('credit.simulare');
});
