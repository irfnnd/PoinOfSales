<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('login', 'Auth::index', ['filter' => 'User']);
$routes->post('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('access', 'Auth::access');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'notUser']);
$routes->get('/', 'Dashboard::index', ['filter' => 'notUser']);
$routes->get('users', 'Users::index', ['filter' => ['notUser','adminAccess']]);
$routes->match(['get', 'post'], 'users/add', 'Users::add',['filter' => 'notUser']);
$routes->get('users-form-delete/(:segment)', 'Users::delete/$1', ['filter' => 'notUser']);
$routes->get('users/edit/(:segment)', 'Users::edit/$1', ['filter' => 'notUser']);
$routes->post('users/edit/(:segment)', 'Users::edit/$1', ['filter' => 'notUser']);
$routes->get('suppliers', 'Supplier::index', ['filter' => 'notUser']);
$routes->get('suppliers/delete/(:segment)', 'Supplier::delete/$1', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'suppliers/add', 'Supplier::add',['filter' => 'notUser']);
$routes->match(['get', 'post'], 'suppliers/edit/(:segment)', 'Supplier::edit/$1',['filter' => 'notUser']);
$routes->post('suppliers/save', 'Supplier::save', ['filter' => 'notUser']);
$routes->get('customers', 'Customer::index', ['filter' => 'notUser']);
$routes->get('customers/delete/(:segment)', 'Customer::delete/$1', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'customers/add', 'Customer::add',['filter' => 'notUser']);
$routes->match(['get', 'post'], 'customers/edit/(:segment)', 'Customer::edit/$1',['filter' => 'notUser']);
$routes->post('customers/save', 'Customer::save', ['filter' => 'notUser']);
$routes->get('products/categories', 'Category::index', ['filter' => 'notUser']);
$routes->get('products/categories/delete/(:segment)', 'Category::delete/$1', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/categories/add', 'Category::add',['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/categories/edit/(:segment)', 'Category::edit/$1',['filter' => 'notUser']);
$routes->post('products/categories/save', 'Category::save', ['filter' => 'notUser']);
$routes->get('products/units', 'Unit::index', ['filter' => 'notUser']);
$routes->get('products/units/delete/(:segment)', 'Unit::delete/$1', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/units/add', 'Unit::add',['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/units/edit/(:segment)', 'Unit::edit/$1',['filter' => 'notUser']);
$routes->post('products/units/save', 'Unit::save', ['filter' => 'notUser']);
$routes->get('products/items', 'Item::index', ['filter' => 'notUser']);
$routes->get('products/items/delete/(:segment)', 'Item::delete/$1', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/items/add', 'Item::add',['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/items/edit/(:segment)', 'Item::edit/$1',['filter' => 'notUser']);
$routes->post('products/items/save', 'Item::save', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'products/items/barcode_qrcode/(:segment)', 'Item::barcode_qrcode/$1',['filter' => 'notUser']);

///print
$routes->get('products/items/barcode_print/(:segment)', 'Item::barcodePrint/$1', ['filter' => 'notUser']);
$routes->get('products/items/qrcode_print/(:segment)', 'Item::qrcodePrint/$1', ['filter' => 'notUser']);

//stock
$routes->get('trancactions/stocks/in', 'Stock::stockInData', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'trancactions/stocks/in/add', 'Stock::stockInAdd', ['filter' => 'notUser']);
$routes->post('trancactions/stocks/in/save', 'Stock::stockInSave', ['filter' => 'notUser']);
$routes->get('trancactions/stocks/in/delete/(:segment)/(:segment)', 'Stock::stockInDelete/$1/$2', ['filter' => 'notUser']);

$routes->get('trancactions/stocks/out', 'Stock::stockOutData', ['filter' => 'notUser']);
$routes->match(['get', 'post'], 'trancactions/stocks/out/add', 'Stock::stockOutAdd', ['filter' => 'notUser']);
$routes->post('trancactions/stocks/out/save', 'Stock::stockOutSave', ['filter' => 'notUser']);
$routes->get('trancactions/stocks/out/delete/(:segment)/(:segment)', 'Stock::stockOutDelete/$1/$2', ['filter' => 'notUser']);

$routes->match(['get', 'post'], 'trancactions/sales', 'Sale::index', ['filter' => 'notUser']);

$routes->post('trancactions/sales/addCart', 'Sale::addCart');
$routes->post('transactions/sales/removeCart', 'Sale::removeCart');
$routes->post('transactions/sales/processPayment', 'Sale::processPayment', ['filter' => 'notUser']);



