<?php

/**
 * Frontend Controllers
 */
get('macros', 'FrontendController@macros');
if( auth()->user())
{

}
get('/', 'FrontendController@index')->name('home');

/**
 * These frontend controllers require the user to be logged in
 */
$router->group(['middleware' => 'auth'], function () use ($router) {
    get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
    get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
    patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');

/*Fonduri*/
    get('profile/fonduri', 'FondsController@index')->name('frontend.profile.fonds.index');
    /*make pay se face in payment controller, iar ruta este in ./Payment.php */
    get('profile/fonduri/balanta-curenta', 'FondsController@current_balance')->name('frontend.profile.fonds.current_balance');
    get('profile/fonduri/get-subscriptions', 'FondsController@subscriptions')->name('frontend.profile.fonds.get_subscriptions');

//    if(access()->hasRole('Saller')){
//        get('/', 'FrontendController@saller')->name('home.saller');
//    }else{
//        get('/', 'FrontendController@buyer')->name('home.buyer');
//    }



});



