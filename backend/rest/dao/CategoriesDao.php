<?php
require_once 'BaseDao.php';


class CategoriesDao extends BaseDao {
   public function __construct() {
       parent::__construct("categories", "categoryId");
   }

   #Promijeniti imena tabela onako kako su u bazi

   public function getByCategoryId($category_id) {
       $stmt = $this->connection->prepare("SELECT * FROM categories WHERE categoryId = :categoryId");
       $stmt->bindParam(':categoryId', $category_id);
       $stmt->execute();
       return $stmt->fetchAll();
   }
}
?>
