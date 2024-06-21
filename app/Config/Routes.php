<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// apis
$routes->get('/api/offers', '\App\Apis\GetOffersApi::index');
