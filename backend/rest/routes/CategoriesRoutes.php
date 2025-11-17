<?php
/**
 * @OA\Get(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Get category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the category",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the category with the given ID"
 *     )
 * )
 */
Flight::route('GET /categories/@id', function($id){
   Flight::json(Flight::categoriesService()->getById($id));
});

/**
 * @OA\Get(
 *     path="/categories",
 *     tags={"categories"},
 *     summary="Get all categories",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all categories in the database"
 *     )
 * )
 */
Flight::route('GET /categories', function(){
   Flight::json(Flight::categoriesService()->getAll());
});

/**
 * @OA\Post(
 *     path="/categories",
 *     tags={"categories"},
 *     summary="Add a new category",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Electronics"),
 *             @OA\Property(property="description", type="string", example="All kinds of electronic items")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New category created"
 *     )
 * )
 */
Flight::route('POST /categories', function(){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::categoriesService()->createCategories($data));
});

/**
 * @OA\Put(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Update an existing category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Updated Category Name"),
 *             @OA\Property(property="description", type="string", example="Updated description")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category updated"
 *     )
 * )
 */
Flight::route('PUT /categories/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::categoriesService()->updateCategory($id, $data));
});

/**
 * @OA\Patch(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Partially update a category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
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
 *         description="Category partially updated"
 *     )
 * )
 */
Flight::route('PATCH /categories/@id', function($id){
   $data = Flight::request()->data->getData();
   Flight::json(Flight::categoriesService()->partialUpdateCategory($id, $data));
});

/**
 * @OA\Delete(
 *     path="/categories/{id}",
 *     tags={"categories"},
 *     summary="Delete a category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category deleted"
 *     )
 * )
 */
Flight::route('DELETE /categories/@id', function($id){
   Flight::json(Flight::categoriesService()->deleteCategory($id));
});
?>
