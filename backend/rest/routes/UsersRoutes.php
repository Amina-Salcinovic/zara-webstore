<?php
/**
 * @OA\Tag(
 *     name="users",
 *     description="Endpoints for managing users"
 * )
 */

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="List of all users"
 *     )
 * )
 */
Flight::route('GET /users', function(){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   Flight::json(Flight::usersService()->getAll());
});

/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Get a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('GET /users/@id', function($id){
   Flight::auth_middleware()->authorizeRoles([Roles::ADMIN, Roles::USER]);
   Flight::json(Flight::usersService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/users",
 *     tags={"users"},
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "username", "email", "password"},
 *             @OA\Property(property="name", type="string", example="Amina Salcinovic"),
 *             @OA\Property(property="username", type="string", example="amina123"),
 *             @OA\Property(property="email", type="string", example="amina@example.com"),
 *             @OA\Property(property="password", type="string", example="secret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully created"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data"
 *     )
 * )
 */
Flight::route('POST /users', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::usersService()->createUser($data));
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Update a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Amina Updated"),
 *             @OA\Property(property="username", type="string", example="amina_updated"),
 *             @OA\Property(property="email", type="string", example="amina_new@example.com"),
 *             @OA\Property(property="password", type="string", example="newsecret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('PUT /users/@id', function($id){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::usersService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Partially update a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=false,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Amina Patch"),
 *             @OA\Property(property="username", type="string", example="amina_patch"),
 *             @OA\Property(property="email", type="string", example="amina_patch@example.com"),
 *             @OA\Property(property="password", type="string", example="patch123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User partially updated"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('PATCH /users/@id', function($id){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   $data = Flight::request()->data->getData();
   Flight::json(Flight::usersService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User successfully deleted"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function($id){
   Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
   Flight::json(Flight::usersService()->delete($id));
});
?>
