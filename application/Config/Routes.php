<?php

namespace Config;

use App\Controllers\Admin\Invoice;
use App\Controllers\Admin\Product;
use App\Controllers\Login;
use App\Controllers\Order;
use App\Controllers\Welcome;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `application/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', [Welcome::class, 'index']);

$routes->group('cart', static function ($routes) {
    $routes->get('/', [Welcome::class, 'cart'], ['as' => 'cart.view']);
    $routes->get('add/(:num)', [Welcome::class, 'add_to_cart'], ['as' => 'cart.add']);
    $routes->get('clear', [Welcome::class, 'clear_cart'], ['as' => 'cart.clear']);
});

$routes->group('order', ['filter' => 'log'], static function ($routes) {
    $routes->get('/', [Order::class, 'index'], ['as' => 'order.view']);
});

$routes->group('login', ['filter' => 'log'], static function ($routes) {
    $routes->get('/', [Login::class, 'index'], ['as' => 'login.view']);
    $routes->post('/', [Login::class, 'auth'], ['as' => 'login.auth']);
});

$routes->group('admin', ['filter' => 'log:admin'], static function ($routes) {
    $routes->group('product', static function ($routes) {
        $routes->get('/', [Product::class, 'index'], ['as' => 'admin.product.view']);
        $routes->get('new', [Product::class, 'create'], ['as' => 'admin.product.create']);
        $routes->post('new', [Product::class, 'submit'], ['as' => 'admin.product.submit']);
        $routes->get('update/(:num)', [Product::class, 'edit'], ['as' => 'admin.product.edit']);
        $routes->post('update', [Product::class, 'update'], ['as' => 'admin.product.update']);
        $routes->get('delete/(:num)', [Product::class, 'delete'], ['as' => 'admin.product.delete']);
    });

    $routes->group('invoice', static function ($routes) {
        $routes->get('/', [Invoice::class, 'index'], ['as' => 'admin.invoice.view']);
        $routes->get('detail/(:num)', [Invoice::class, 'detail'], ['as' => 'admin.invoice.detail']);
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
