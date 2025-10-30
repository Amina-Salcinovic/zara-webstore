<?php
require_once 'BaseDao.php';


class UsersDao extends BaseDao {
   public function __construct() {
       parent::__construct("users", "userId");
   }


   public function getByEmail($email) {
       $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
       $stmt->bindParam(':email', $email);
       $stmt->execute();
       return $stmt->fetch();
   }
}
?>
