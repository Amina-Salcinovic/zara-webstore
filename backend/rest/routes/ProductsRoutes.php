<?php
/**
 * @OA\Tag(
 *     name="products",
 *     description="Operations related to products in the Zara Webstore"
 * )
 */

/**
 * @OA\Get(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Get a specific product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the product with the given ID"
 *     )
 * )
 */
Flight::route('GET /product/@id', function($id){
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::productService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/product",
 *     tags={"products"},
 *     summary="Get all products",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all products in the database"
 *     )
 * )
 */
Flight::route('GET /product', function(){
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::productService()->getAll());
});

/**
 * @OA\Get(
 *     path="/product/category/{categoryId}",
 *     tags={"products"},
 *     summary="Get products by category ID",
 *     @OA\Parameter(
 *         name="categoryId",
 *         in="path",
 *         required=true,
 *         description="ID of the category to filter products by",
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns all products belonging to the given category"
 *     )
 * )
 */
Flight::route('GET /product/category/@categoryId', function($categoryId){
    Flight::auth_middleware()->authorizeRoles([Roles::USER, Roles::ADMIN]);
    Flight::json(Flight::productService()->getByCategory($categoryId));
});

/**
 * @OA\Post(
 *     path="/product",
 *     tags={"products"},
 *     summary="Add a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "price"},
 *             @OA\Property(property="name", type="string", example="Leather Jacket"),
 *             @OA\Property(property="description", type="string", example="Black leather jacket for women"),
 *             @OA\Property(property="price", type="number", example=199.99),
 *             @OA\Property(property="stock", type="integer", example=15),
 *             @OA\Property(property="categoryId", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product successfully created"
 *     )
 * )
 */
Flight::route('POST /product', function(){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data));
});

/**
 * @OA\Put(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Update product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product to update",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Jacket"),
 *             @OA\Property(property="description", type="string", example="Updated product description"),
 *             @OA\Property(property="price", type="number", example=149.99),
 *             @OA\Property(property="stock", type="integer", example=10)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated successfully"
 *     )
 * )
 */
Flight::route('PUT /product/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->update($id, $data));
});

/**
 * @OA\Patch(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Partially update product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Only name changed"),
 *             @OA\Property(property="description", type="string", example="Only description changed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product partially updated"
 *     )
 * )
 */
Flight::route('PATCH /product/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->partialUpdateProduct($id, $data));
});

/**
 * @OA\Delete(
 *     path="/product/{id}",
 *     tags={"products"},
 *     summary="Delete a product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the product to delete",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /product/@id', function($id){
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json(Flight::productService()->deleteProduct($id));
});
?>
