<?php
get('despre', 'DashboardController@about')->name('about');
get('cum-functioneaza', 'DashboardController@howWork')->name('howWork');
get('cum-functioneaza/cumpar', 'DashboardController@cumCumpar')->name('howWork.cumpar');
get('cum-functioneaza/vand', 'DashboardController@cumVand')->name('howWork.vand');


$router->group(['middleware' => 'auth'], function () use ($router) {
    get('dashboard', 'DashboardController@index')->name('frontend.dashboard');
    get('profile/edit', 'ProfileController@edit')->name('frontend.profile.edit');
    patch('profile/update', 'ProfileController@update')->name('frontend.profile.update');
    get('profile/fonduri', 'FondsController@index')->name('frontend.profile.fonds.index');
    get('profile/fonduri/balanta-curenta', 'FondsController@current_balance')->name('frontend.profile.fonds.current_balance');
    get('profile/fonduri/get-subscriptions', 'FondsController@subscriptions')->name('frontend.profile.fonds.get_subscriptions');
});



