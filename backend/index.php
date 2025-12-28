<?php
Flight::route('/', function(){  //define route and define function to handle request
   echo 'Hello world!';
});

require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/CategoriesService.php';
require_once __DIR__ . '/rest/services/ProductsService.php';
require_once __DIR__ . '/rest/services/UsersService.php';
require_once __DIR__ . '/rest/services/OrdersService.php';
require_once __DIR__ . '/rest/services/OrderItemsService.php';

// Register services in Flight
Flight::register('auth_service', 'AuthService');
Flight::register('categoriesService', 'CategoriesService');
Flight::register('productService', 'ProductsService');
Flight::register('usersService', 'UsersService');
Flight::register('ordersService', 'OrdersService');
Flight::register('orderItemsService', 'OrderItemsService');

// Include route files
require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/CategoriesRoutes.php';
require_once __DIR__ . '/rest/routes/ProductsRoutes.php';
require_once __DIR__ . '/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/rest/routes/OrdersRoutes.php';
require_once __DIR__ . '/rest/routes/OrderItemsRoutes.php';

Flight::start();  //start FlightPHP
?>
