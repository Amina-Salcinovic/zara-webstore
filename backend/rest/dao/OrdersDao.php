<?php
require_once 'BaseDao.php';


class OrdersDao extends BaseDao {
   public function __construct() {
       parent::__construct("orders", "id");
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
    public function getOrderDetails($id) {
        $stmt = $this->connection->prepare("
            SELECT o.id, o.order_date, o.total_price, o.status, u.first_name, u.last_name,
                   p.name AS product_name, oi.quantity, oi.price
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN orderItems oi ON o.id = oi.orderId
            JOIN products p ON oi.productId = p.id
            WHERE o.id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function updateStatus($id, $status) {
        $stmt = $this->connection->prepare("
            UPDATE orders
            SET status = :status
            WHERE id = :id
        ");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Return true if update was successful
        return $stmt->rowCount() > 0;
    }
//     public function getByUserId($user_id) {
//     $stmt = $this->connection->prepare("SELECT * FROM orders WHERE userId = :userId");
//     $stmt->bindParam(':userId', $user_id);
//     $stmt->execute();
//     return $stmt->fetchAll();
// }

}
?>

