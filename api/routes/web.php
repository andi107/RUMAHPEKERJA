<?php

$router->get('/', function () use ($router) {
    return response()->json([
        'message' => strtoupper(env('MAINTENANCE_MSG','MAINTENANCE'))
    ], 200);
});

$router->group([
    'prefix' => 'api',
    // 'middleware' => ['nocache','hideserver', 'security','csp','gzip'],
], function() use($router) {
    $router->group([
        'prefix' => 'a',
    ], function() use($router) {
        $router->group(['middleware' => ['throttle:5,1']], function () use ($router) {
            $router->post('auth', 'Admin\LoginController@index');
            $router->post('logout', 'Admin\ProfileController@logout');
        });
    });
});