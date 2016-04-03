<?php
$router->group(['middleware' => 'auth'], function () {
    get('get-terrain-byUser',   'TerrainController@getUserTerrains')
        ->name('terrain.getUserTerrains');
    post('post-revenue-delete', 'TerrainController@delete')
        ->name('terrain.delete');
    post('post-terrain-save',   'TerrainController@save')
        ->name('terrain.save');
    post('post-terrain-edit',   'TerrainController@edit')
        ->name('terrain.edit');
    post('post-terrain-photo',  'TerrainController@photo')
        ->name('terrain.photo');
    get('terenuri',              'TerrainController@index')
        ->name('terrains_index');
});
