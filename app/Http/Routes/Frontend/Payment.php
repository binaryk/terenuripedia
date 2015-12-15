<?php

$router->group(['middleware' => 'auth'], function () use ($router) {
    get('profile/fonduri/efectueaza-plata/{subscription?}/{per?}', 'Payment\PaymentController@index')->name('frontend.profile.fonds.make_pay');
});
