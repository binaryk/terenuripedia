<?php

return [
    'terrain' => [
        'file-name-pattern' => '{{original}}-{{terrain_id}}-{{date}}.{{extension}}',
        'max-size' => 5 * 400,
        'allowed-extensions' => 'bmp,gif,jpeg,jpg,png',
        'path' => 'uploads/photo/terrains/{{terrain_id}}/',
        'id_name' => 'terrain_id',
    ]
];