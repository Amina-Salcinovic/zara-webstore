<?php

// require_once '../services/CategoriesService.php';

// $categories_service = new CategoriesService();


// $data = [
//     'name' => 'Shoes',        
//     'description' => 'Our winter collection'
// ];


// $categories_service->createCategories($data);


// require_once '../services/ProductsService.php';

// $products_service = new ProductsService();

// $data = [
//     'name' => 'Shoes',
//     'price' => 59.95,
//     'stock' => 50,
//     'categoryId' => 1 
// ];


// $result = $products_service->createProduct($data);
// print_r($result);


// require_once '../services/UsersService.php';

// $users_service = new UsersService();

// $data = [
//     'first_name' => 'Amina',
//     'email' => 'aminas@gmail.com',
//     'password' => 'amina123'
// ];
// $result = $users_service->createUser($data);
// print_r($result);

// require_once '../services/OrdersService.php';

// $orders_service = new OrdersService();

// $data = [
//     'userId' => 1,          
//     'total_price' => 150.00,
//     'status' => 'pending'
// ];


// $result = $orders_service->createOrder($data);
// print_r($result);

//require_once '../services/OrderItemsService.php';

require_once __DIR__. "/OrderItemsService.php";
$order_items_service = new OrderItemsService();

$data = [
    'orderId' => 1,        
    'productId' => 2,      
    'quantity' => 2,
    'price' => 99.99
];


// $result = $order_items_service->createOrderItems($data);
// print_r($result);

$res = $order_items_service->getAll();
print_r("re");
?>
