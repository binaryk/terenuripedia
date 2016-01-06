<?php

get('/', 'Frontend\FrontendController@index')->name('home');
get('abonamente', 'Frontend\FondsController@abonamente')->name('frontend.abonamente');

$router->group(['namespace' => 'Frontend'], function () use ($router) {
    require (__DIR__ . '/Routes/Frontend/Frontend.php');
    require (__DIR__ . '/Routes/Frontend/Access.php');
    require (__DIR__ . '/Routes/Frontend/Payment.php');
});

$router->group(['namespace' => 'Buyer'], function () use ($router) {
    $router->group([
        'middleware' => 'access.routeNeedsRole:Buyer',
        'with'       => ['flash_danger', 'Nu aveti acces la aceasta cale.']
    ], function () use ($router)
    {
        require (__DIR__ . '/Routes/Terrain/Buyer.php');
    });
});

$router->group(['namespace' => 'Terrains'], function () use ($router) {
    get('get-terrain-lists', 'PreTerrainController@all')->name('terrain.all');
    post('post-info-terrain', 'TerrainController@info')->name('terrain.info');

    $router->group([
        'middleware' => 'access.routeNeedsRole:Saller',
        'with'       => ['flash_danger', 'Nu aveti acces la aceasta cale.']
    ], function () use ($router)
    {
        require (__DIR__ . '/Routes/Terrain/Terrain.php');
    });
});

$router->group(['namespace' => 'Backend'], function () use ($router) {
    $router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
         $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {
            require (__DIR__ . '/Routes/Backend/Dashboard.php');
            require (__DIR__ . '/Routes/Backend/Access.php');
            require (__DIR__ . '/Routes/Backend/LogViewer.php');
            require (__DIR__ . '/Routes/Backend/Terrains.php');
        });
    });
});
