<?php

$method = $_SERVER['REQUEST_METHOD'];

$id = $_GET['id'] ?? null;

$routes = [
    'POST' => 'CampanhaController@create',
    'GET' => $id ? 'CampanhaController@get' : 'CampanhaController@getAll',
    'PUT' => 'CampanhaController@update',
    'DELETE' => 'CampanhaController@delete',
];
