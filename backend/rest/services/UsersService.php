<?php
require_once 'BaseService.php';
// require_once '../dao/UsersDao.php';
require_once __DIR__ . '/../dao/UsersDao.php';
class UsersService extends BaseService {
   public function __construct() {
       $dao = new UsersDao();
       parent::__construct($dao);
   }
   public function getByUserId($user_id) {
       return $this->dao->getByUserId($user_id);
   }
   public function createUser($data) {
        // Check if name is provided
        if (empty($data['first_name'])) {
            throw new Exception('User name cannot be empty.');
        }

        // Validate email format
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('A valid email address is required.');
        }

        // Validate password strength
        if (empty($data['password']) || strlen($data['password']) < 6) {
            throw new Exception('Password must be at least 6 characters long.');
        }

        // Call DAO layer to save user data
        return $this->dao->create($data);
    }
}
?>
