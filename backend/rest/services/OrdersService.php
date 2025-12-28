<?php
require_once 'BaseService.php';
// require_once '../dao/OrdersDao.php';
require_once __DIR__ . '/../dao/OrdersDao.php';
class OrdersService extends BaseService {
   public function __construct() {
       $dao = new OrdersDao();
       parent::__construct($dao);
   }
   public function getByUserId($id) {
       return $this->dao->getByUserId($id);
   }
   public function createOrder($data) {
        // Check if user_id is provided
        if (empty($data['id'])) {
            throw new Exception('User ID is required for creating an order.');
        }

        // Ensure total price is not negative
        if (isset($data['total_price']) && $data['total_price'] < 0) {
            throw new Exception('Total price cannot be negative.');
        }

        // Set default status if not provided
        if (empty($data['status'])) {
            $data['status'] = 'pending'; // default status
        }

        // Call DAO layer to save the order
        return $this->dao->create($data);
      
    }
    public function updateOrder($id, $data) {
    // Check if the order exists
    $order = $this->dao->getById($id);
    if (!$order) {
        throw new Exception("Order with ID $id not found.");
    }

    // Validate the input data
    if (isset($data['total_price']) && $data['total_price'] <= 0) {
        throw new Exception('Total price must be greater than 0.');
    }

    if (isset($data['status']) && empty($data['status'])) {
        throw new Exception('Order status cannot be empty.');
    }

    // Call DAO to perform the update operation
    return $this->dao->update($id, $data);
}
public function partialUpdateOrder($id, $data) {
    $order = $this->dao->getById($id);
    if (!$order) {
        throw new Exception("Order with ID $id not found.");
    }

    $updatedData = array_merge((array)$order, $data);
    return $this->dao->update($id, $updatedData);
}


}
?>
