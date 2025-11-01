<?php
require_once 'BaseDao.php';


class OrderItemsDao extends BaseDao {
   public function __construct() {
       parent::__construct("orderitems", "itemId");
   }


//    public function getByItemId($item_id) {
//        $stmt = $this->connection->prepare("SELECT * FROM orderitems WHERE itemId = :itemId");
//        $stmt->bindParam(':itemId', $item_id);
//        $stmt->execute();
//        return $stmt->fetchAll();
//    }

    public function getByOrder($orderId) {
        $stmt = $this->connection->prepare("
            SELECT oi.*, p.name AS product_name 
            FROM orderitems oi
            JOIN products p ON oi.productId = p.productId
            WHERE oi.orderId = :orderId
        ");
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Insert multiple items at once for a given order
    public function insertMultiple($items, $orderId) {
        foreach($items as $item) {
            $this->insert([
                "orderId" => $orderId,
                "productId" => $item["productId"],
                "quantity" => $item["quantity"],
                "price" => $item["price"]
            ]);
        }
    }

     public function getTotalForOrder($orderId) {
        $stmt = $this->connection->prepare("
            SELECT SUM(price * quantity) AS total
            FROM orderitems
            WHERE orderId = :orderId
        ");
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
        $result = $stmt->fetch();

        // Return total price, or 0 if no items found
        return $result['total'] ?? 0;
    }
}
?>
