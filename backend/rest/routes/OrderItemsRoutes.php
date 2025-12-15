<?php
/**
 * @OA\Tag(
 *     name="orderitems",
 *     description="Endpoints for managing order items"
 * )
 */

/**
 * @OA\Get(
 *     path="/orderitems",
 *     tags={"orderitems"},
 *     summary="Get all order items",
 *     @OA\Response(
 *         response=200,
 *         description="List of all order items"
 *     )
 * )
 */
Flight::route('GET /orderitems', function(){
   Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
   Flight::json(Flight::orderItemsService()->getAll());
});

/**
 * @OA\Get(
 *     path="/orderitems/{id}",
 *     tags={"orderitems"},
 *     summary="Get order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order item not found"
 *     )
 * )
 */
Flight::route('GET /orderitems/@id', function($id){
   Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
   Flight::json(Flight::orderItemsService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/orderitems/order/{orderId}",
 *     tags={"orderitems"},
 *     summary="Get items by order ID",
 *     @OA\Parameter(
 *         name="orderId",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of order items for given order"
 *     )
 * )
 */
Flight::route('GET /orderitems/order/@orderId', function($orderId){
   Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
   Flight::json(Flight::orderItemsService()->getByOrder($orderId));
});

/**
 * @OA\Post(
 *     path="/orderitems",
 *     tags={"orderitems"},
 *     summary="Create a new order item",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"orderId", "productId", "quantity", "price"},
 *             @OA\Property(property="orderId", type="integer", example=1),
 *             @OA\Property(property="productId", type="integer", example=2),
 *             @OA\Property(property="quantity", type="integer", example=3),
 *             @OA\Property(property="price", type="number", example=29.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item successfully created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /orderitems', function(){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderItemsService()->create($data));
});

/**
 * @OA\Put(
 *     path="/orderitems/{id}",
 *     tags={"orderitems"},
 *     summary="Update an order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="quantity", type="integer", example=5),
 *             @OA\Property(property="price", type="number", example=39.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order item not found"
 *     )
 * )
 */
Flight::route('PUT /orderitems/@id', function($id){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderItemsService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/orderitems/{id}",
 *     tags={"orderitems"},
 *     summary="Partially update an order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="price", type="number", example=19.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item partially updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order item not found"
 *     )
 * )
 */
Flight::route('PATCH /orderitems/@id', function($id){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::orderItemsService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/orderitems/{id}",
 *     tags={"orderitems"},
 *     summary="Delete an order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item successfully deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Order item not found"
 *     )
 * )
 */
Flight::route('DELETE /orderitems/@id', function($id){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   Flight::json(Flight::orderItemsService()->delete($id));
});
?>
