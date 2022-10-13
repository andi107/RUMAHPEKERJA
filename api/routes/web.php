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
    $router->group([
        'prefix' => 'chk',
    ], function() use($router) {
        $router->get('/', 'Admin\CheckController@index');
        $router->get('sysupdate', 'Admin\CheckController@go_migrate');
    });
    $router->get('logout', 'Admin\CheckController@go_logout');
    $router->group([
        'prefix' => 'a',
    ], function() use($router) {
        $router->group(['middleware' => ['throttle:5,1']], function () use ($router) {
            $router->post('auth', 'Admin\LoginController@index');
            
        });
        $router->group([
            'prefix' => 'sitemap',
        ], function() use($router) {
            $router->post('create', 'Admin\SiteMapController@create');
            $router->put('update', 'Admin\SiteMapController@update');
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
            $router->get('/detail/{uniq}', 'Admin\PostsController@detail');
            $router->get('/detail/attach/{uniq}', 'Admin\PostsController@detail_attach_list');
            $router->post('create/save', 'Admin\PostsController@create');
            $router->post('update', 'Admin\PostsController@update');
            $router->post('update_body', 'Admin\PostsController@update_body');
            $router->post('tmpattach_save', 'Admin\PostsController@tmpattach');
            $router->post('attach_delete', 'Admin\PostsController@attach_delete');
            $router->post('publish', 'Admin\PostsController@publish');
        });
        $router->group([
            'prefix' => 'select',
        ], function() use($router) {
            $router->get('users', 'Admin\SelectController@users_list');
        });
    });

    $router->group([
        'prefix' => 'post',
    ], function() use($router) {
        $router->get('/', 'User\PostController@index');
        $router->get('detail/{cont_id}/{title_url}', 'User\PostController@detail');
    });
    $router->group([
        'prefix' => 'st',
    ], function() use($router) {
        $router->get('sitemap', 'User\SiteMapController@st_sitemap');
        $router->get('posts', 'User\SiteMapController@st_posts');
    });
});