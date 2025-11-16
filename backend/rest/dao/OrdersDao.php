<?php
require_once 'BaseDao.php';


class OrdersDao extends BaseDao {
   public function __construct() {
       parent::__construct("orders", "orderId");
   }
   public function create($data) {
        return $this->insert($data);
    }

//    public function getByUserId($user_id) {
//        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE userId = :userId");
//        $stmt->bindParam(':userId', $user_id);
//        $stmt->execute();
//        return $stmt->fetchAll();
//    }

    public function getByStatus($status) {
        $stmt = $this->connection->prepare("SELECT * FROM orders WHERE status = :status");
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Order details
    public function getOrderDetails($orderId) {
        $stmt = $this->connection->prepare("
            SELECT o.orderId, o.order_date, o.total_price, o.status, u.first_name, u.last_name,
                   p.name AS product_name, oi.quantity, oi.price
            FROM orders o
            JOIN users u ON o.userId = u.userId
            JOIN orderItems oi ON o.orderId = oi.orderId
            JOIN products p ON oi.productId = p.productId
            WHERE o.orderId = :orderId
        ");
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function updateStatus($orderId, $status) {
        $stmt = $this->connection->prepare("
            UPDATE orders
            SET status = :status
            WHERE orderId = :orderId
        ");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();

        // Return true if update was successful
        return $stmt->rowCount() > 0;
    }
    public function getByUserId($user_id) {
    $stmt = $this->connection->prepare("SELECT * FROM orders WHERE userId = :userId");
    $stmt->bindParam(':userId', $user_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

}
?>

