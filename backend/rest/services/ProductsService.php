<?php
require_once 'BaseService.php';
// require_once '../dao/ProductsDao.php';
require_once __DIR__ . '/../dao/ProductsDao.php';
class ProductsService extends BaseService {
   public function __construct() {
       $dao = new ProductsDao();
       parent::__construct($dao);
   }
   public function getByUserId($id) {
       return $this->dao->getByUserId($id);
   }

 public function createProduct($data) {
        // Check if product name is provided
        if (empty($data['name'])) {
            throw new Exception('Product name cannot be empty.');
        }

        // Ensure price is positive
        if (!isset($data['price']) || $data['price'] <= 0) {
            throw new Exception('Product price must be a positive value.');
        }

        // Check stock quantity is not negative
        if (isset($data['stock']) && $data['stock'] < 0) {
            throw new Exception('Stock cannot be negative.');
        }

        // Call DAO layer to save the product
        return $this->dao->create($data);
    }
    public function deleteProduct($id) {
    // check if item exist
    $product = $this->dao->getById($id);
    if (!$product) {
        throw new Exception("Product with ID $id not found.");
    }

    // call dao to delete item
    return $this->dao->delete($id);
}
public function partialUpdateProduct($id, $data) {
    // Check if the product exists
    $product = $this->dao->getById($id);
    if (!$product) {
        throw new Exception("Product with ID $id not found.");
    }

    // Merge existing product data with the new data
    // Only the fields sent in $data will be updated
    $updatedData = array_merge((array)$product, $data);

    // Call DAO to update the product in the database
    return $this->dao->update($id, $updatedData);
}
public function getByCategory($id) {
    return $this->dao->getByCategory($id);
}


}
?>
