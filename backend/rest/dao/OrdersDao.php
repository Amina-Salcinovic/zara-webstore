<?php
require_once 'BaseDao.php';


class OrdersDao extends BaseDao {
   public function __construct() {
       parent::__construct("orders", "orderId");
   }


   public function getByUserId($user_id) {
       $stmt = $this->connection->prepare("SELECT * FROM orders WHERE userId = :userId");
       $stmt->bindParam(':userId', $user_id);
       $stmt->execute();
       return $stmt->fetchAll();
   }
}
?>
