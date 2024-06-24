<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// apis
$routes->get('/api/offers', '\App\Apis\GetOffersApi::index');
$routes->get('/api/filters', '\App\Apis\GetFiltersApi::index');
