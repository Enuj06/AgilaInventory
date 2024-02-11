<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/inventory', 'InventoryController::index2');   //inventory_view; index controller
$routes->get('/','UserController::index');
$routes->get('/dashboard','UserController::dashboard');
$routes->get('/website','UserController::website');

//user register and login
$routes->get('/register','UserController::register');
$routes->post('/register','UserController::register');
$routes->get('/login', 'UserController::login');
$routes->match(['post', 'get'], '/gologin', 'UserController::gologin');
$routes->get('/goregister', 'UserController::goregister');
$routes->get('/goregister', 'UserController::goregister');

// ...

//inventory crud
// $routes->get('/inventory/fetchCategories', 'InventoryController::fetchCategories');
// $routes->get('/inventory/fetchCategoryName/(:num)', 'InventoryController::fetchCategoryName/$1');
// $routes->get('/inventory/fetchItems', 'InventoryController::fetchItems');
// $routes->post('/inventory/add', 'InventoryController::add'); // Move this before '/inventory/create'
// $routes->get('/inventory/create', 'InventoryController::create');
// $routes->post('/inventory/update/(:num)', 'InventoryController::update/$1');
// $routes->get('/inventory/getItem/(:num)', 'InventoryController::getItem/$1');
// $routes->delete('/inventory/delete/(:num)', 'InventoryController::deleteItem/$1');
// $routes->get('/error-page', 'InventoryController::itemError');

$routes->get('/inventory','InventoryController::index');
$routes->get('/inventory/create','InventoryController::create');
$routes->post('/inventory/store','InventoryController::store');
$routes->get('/inventory/edit/(:num)','InventoryController::edit/$1');
$routes->post('/inventory/update/(:num)','InventoryController::update/$1');
$routes->get('/inventory/delete/(:num)','InventoryController::delete/$1');

// ... 


//website
$routes->get('/index', 'WebController::website');
$routes->get('/about', 'WebController::about');
$routes->get('/shop', 'WebController::shop');
$routes->get('/contact', 'WebController::contact');
$routes->get('/404', 'WebController::404');
$routes->get('/cart', 'WebController::cart');
$routes->get('/checkout', 'WebController::checkout');
$routes->get('/index2', 'WebController::index2');
$routes->get('/mail', 'WebController::mail');
$routes->get('/news', 'WebController::news');
$routes->get('/single-product', 'WebController::single-product');
$routes->get('/single-news', 'WebController::single-news');
