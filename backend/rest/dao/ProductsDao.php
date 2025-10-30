<?php
require_once 'BaseDao.php';


class ProductsDao extends BaseDao {
   public function __construct() {
       parent::__construct("products", "productId");
   }


   public function getByProductId($product_id) {
       $stmt = $this->connection->prepare("SELECT * FROM products WHERE productId = :productId");
       $stmt->bindParam(':productId', $product_id);
       $stmt->execute();
       return $stmt->fetchAll();
   }
}
?>
