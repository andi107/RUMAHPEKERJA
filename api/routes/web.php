<?php

$router->get('/', function () use ($router) {
    return response()->json([
        'message' => strtoupper(env('MAINTENANCE_MSG','MAINTENANCE'))
    ], 200);
});

$router->group([
    'prefix' => 'api',
    'middleware' => ['nocache','hideserver', 'security','csp','gzip'],
], function() use($router) {
    $router->get('chk', 'Admin\CheckController@index');
    $router->group([
        'prefix' => 'a',
    ], function() use($router) {
        $router->group(['middleware' => ['throttle:5,1']], function () use ($router) {
            $router->post('auth', 'Admin\LoginController@index');
            $router->post('logout', 'Admin\ProfileController@logout');
            $router->get('sysupdate', 'Admin\LoginController@go_migrate');
        });
        $router->group([
            'prefix' => 'category',
        ], function() use($router) {
            $router->get('/', 'Admin\CategoryController@index');
            $router->post('create', 'Admin\CategoryController@create');
            $router->put('update', 'Admin\CategoryController@update');
        });
        $router->group([
            'prefix' => 'posts',
        ], function() use($router) {
            $router->get('/', 'Admin\PostsController@index');
            
            $router->post('create/save', 'Admin\PostsController@create');
            $router->put('update', 'Admin\PostsController@update');
            $router->post('update_body', 'Admin\PostsController@update_body');
        });
    });
});