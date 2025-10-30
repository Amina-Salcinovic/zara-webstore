<?php
require_once 'BaseDao.php';


class OrderItemsDao extends BaseDao {
   public function __construct() {
       parent::__construct("orderitems", "itemId");
   }


   public function getByItemId($item_id) {
       $stmt = $this->connection->prepare("SELECT * FROM orderitems WHERE itemId = :itemId");
       $stmt->bindParam(':itemId', $item_id);
       $stmt->execute();
       return $stmt->fetchAll();
   }
}
?>
