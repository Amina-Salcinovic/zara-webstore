<?php
require_once 'BaseService.php';
// require_once '../dao/OrderItemsDao.php';
require_once __DIR__ . '/../dao/OrderItemsDao.php';
class OrderItemsService extends BaseService {
   public function __construct() {
       $dao = new OrderItemsDao();
       parent::__construct($dao);
   }
   public function getByCategory($category) {
       return $this->dao->getByCategory($category);
   }


// Example of business logic (e.g., ensure price is positive)
public function createOrderItems($data) {
       if ($data['price'] <= 0) {
           throw new Exception('Price must be a positive value.');
       }
       return $this->dao->create($data);
   }

public function getByOrder($orderId) {
    return $this->dao->getByOrderId($orderId);
}

}
?>
