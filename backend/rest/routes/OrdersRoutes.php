<?php
/**
 * @OA\Tag(
 *     name="orders",
 *     description="Endpoints for managing orders"
 * )
 */

 /**
  * @OA\Get(
  *     path="/orders",
  *     tags={"orders"},
  *     summary="Get all orders",
  *     @OA\Response(
  *         response=200,
  *         description="List of all orders"
  *     )
  * )
  */
Flight::route('GET /orders', function(){
   Flight::json(Flight::ordersService()->getAll());
});

/**
 * @OA\Get(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Get order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order not found"
 *     )
 * )
 */
Flight::route('GET /orders/@id', function($id){
   Flight::json(Flight::ordersService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/orders",
 *     tags={"orders"},
 *     summary="Create a new order",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "total_price"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="total_price", type="number", example=99.99),
 *             @OA\Property(property="status", type="string", example="pending")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order successfully created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /orders', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::ordersService()->createOrder($data));
});

/**
 * @OA\Put(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Update an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="completed"),
 *             @OA\Property(property="total_price", type="number", example=89.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order not found"
 *     )
 * )
 */
Flight::route('PUT /orders/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::ordersService()->updateOrder($id, $data));
});

/**
 * @OA\Patch(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Partially update an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="shipped")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order partially updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order not found"
 *     )
 * )
 */
Flight::route('PATCH /orders/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::ordersService()->partialUpdateOrder($id, $data));
});

/**
 * @OA\Delete(
 *     path="/orders/{id}",
 *     tags={"orders"},
 *     summary="Delete an order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order successfully deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order not found"
 *     )
 * )
 */
Flight::route('DELETE /orders/@id', function($id){
   Flight::json(Flight::ordersService()->delete($id));
});
?>
