<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Books::index');

// Books routes
$routes->group('books', function($routes) {
    $routes->get('/', 'Books::index');
    $routes->get('create', 'Books::create');
    $routes->post('store', 'Books::store');
    $routes->get('show/(:num)', 'Books::show/$1');
    $routes->get('edit/(:num)', 'Books::edit/$1');
    $routes->post('update/(:num)', 'Books::update/$1');
    $routes->get('delete/(:num)', 'Books::delete/$1');
});
