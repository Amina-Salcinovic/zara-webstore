<?php
require_once 'BaseDao.php';


class ProductsDao extends BaseDao {
   public function __construct() {
       parent::__construct("products", "productId");
   }
   public function create($data) {
        return $this->insert($data);
    }

//    public function getByProductId($product_id) {
//        $stmt = $this->connection->prepare("SELECT * FROM products WHERE productId = :productId");
//        $stmt->bindParam(':productId', $product_id);
//        $stmt->execute();
//        return $stmt->fetchAll();
//    }
 // Get products by category
//   public function getByCategory($id) {
//         $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
//         $stmt->bindParam(':id', $id);
//         $stmt->execute();
//         return $stmt->fetchAll();
//     }

    // Search products by name
    public function searchByName($keyword) {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE name LIKE :kw");
        $likeKeyword = "%$keyword%";
        $stmt->bindParam(':kw', $likeKeyword);
        $stmt->execute();
        return $stmt->fetchAll();
    }

        public function getAvailableProducts() {
        $stmt = $this->connection->prepare("
            SELECT * FROM products
            WHERE stock > 0
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
//     public function getByUserId($id) {
//     $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
//     $stmt->bindParam(':id', $id);
//     $stmt->execute();
//     return $stmt->fetchAll();
// }

}
?>
