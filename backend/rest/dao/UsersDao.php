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
      // Find users by name or last name
    public function getByName($name) {
        $stmt = $this->connection->prepare("
            SELECT * FROM users 
            WHERE LOWER(first_name) LIKE LOWER(:kw) OR LOWER(last_name) LIKE LOWER(:kw)
        ");
        $likeKeyword = "%$name%";
        $stmt->bindParam(':kw', $likeKeyword);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Check if a user exists by email
    public function existsByEmail($email) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // returns true if user exists
    }
}
?>
