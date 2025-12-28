<?php

require_once __DIR__ . '/../config.php'; 

class Database {
    private static $host = 'sqlXXX.infinityfree.com';
    private static $dbName = 'if0_40781062_zara';
    private static $username = 'if0_40781062';
    private static $password = 'LEwdS5lyG93MXwS';


   public static function connect() {
       if (self::$connection === null) {
           try {
               self::$connection = new PDO(
                   "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                   self::$username,
                   self::$password,
                   [
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                   ]
               );
           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;
   }
}
?>
?>
