<?php
require 'vendor/autoload.php'; //run autoloader

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Flight::route('/', function(){  //define route and define function to handle request
   echo 'Hello world!';
});

require_once __DIR__ . '/rest/services/CategoriesService.php';
require_once __DIR__ . '/rest/services/ProductsService.php';
require_once __DIR__ . '/rest/services/UsersService.php';
require_once __DIR__ . '/rest/services/OrdersService.php';
require_once __DIR__ . '/rest/services/OrderItemsService.php';
require_once __DIR__ . '/rest/services/AuthService.php';

require_once __DIR__ . '/middleware/AuthMiddleware.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Register services in Flight
Flight::register('categoriesService', 'CategoriesService');
Flight::register('productService', 'ProductsService');
Flight::register('usersService', 'UsersService');
Flight::register('ordersService', 'OrdersService');
Flight::register('orderItemsService', 'OrderItemsService');
Flight::register('auth_service', 'AuthService');

Flight::register('auth_middleware', 'AuthMiddleware');

Flight::route('/*', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
           $token = Flight::request()->getHeader("Authentication");
           if(Flight::auth_middleware()->verifyToken($token))
               return TRUE;
       } catch (\Exception $e) {
           Flight::halt(401, $e->getMessage());
       }
   }
});


// Include route files
require_once __DIR__ . '/rest/routes/CategoriesRoutes.php';
require_once __DIR__ . '/rest/routes/ProductsRoutes.php';
require_once __DIR__ . '/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/rest/routes/OrdersRoutes.php';
require_once __DIR__ . '/rest/routes/OrderItemsRoutes.php';
require_once __DIR__ . '/rest/routes/AuthRoutes.php';

Flight::start();  //start FlightPHP
?>
