<?php
// require_once './BaseDao.php';
require_once 'BaseDao.php';


class CategoriesDao extends BaseDao {
   public function __construct() {
       parent::__construct("categories", "categoryId");
   }

   #Promijeniti imena tabela onako kako su u bazi

//    public function getByCategoryId($category_id) {
//        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE categoryId = :categoryId");
//        $stmt->bindParam(':categoryId', $category_id);
//        $stmt->execute();
//        return $stmt->fetchAll();
//    }
    public function getByName($name) {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   
    public function search($keyword) {
        $stmt = $this->connection->prepare("
            SELECT * FROM categories 
            WHERE name LIKE :kw OR description LIKE :kw
        ");
        $likeKeyword = "%$keyword%";
        $stmt->bindParam(':kw', $likeKeyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        public function getAvailableProducts($categoryId) {
        $stmt = $this->connection->prepare("
            SELECT p.* 
            FROM products p
            INNER JOIN categories c ON p.categoryId = c.categoryId
            WHERE p.categoryId = :categoryId AND p.stock > 0
        ");
        $stmt->bindParam(':categoryId', $categoryId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
