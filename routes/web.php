<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/*
 * Prefix the routes group with the version of the API for future proofing...
 */
$router->group(['prefix' => '1.0'], function () use ($router) {

    $router->get( 'author/{author}', [ 'uses' => 'ProductController@show' ] );

    $router->get( 'categories', [ 'uses' => 'CategoryController@index' ] );
    $router->get( 'category/{category}', [ 'uses' => 'CategoryController@show' ] );

    $router->get( 'author/{author}/category/{category}', [ 'uses' => 'ProductController@show' ] );

    $router->post( 'book/new', [ 'uses' => 'ProductController@store' ] );


});