<?php
$router->group([
    'namespace'  => 'Terrains',
//    'middleware' => 'access.routeNeedsPermission:view-access-management',
], function () use ($router) {

    get('admin/terrains','AdminTerrainsController@index')->name('admin.terrains.index');
    post('admin/terrain/update','AdminTerrainsController@aprobare')->name('admin.terrain.aprobare');

});
