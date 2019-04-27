<?php 
  class Database {
    // DB Object
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;
      
      $db_ini = parse_ini_file(".database.ini"); //parses only the ini's attributes, not the groups
      
      try { 
        $this->conn = new PDO('mysql:host=' . $db_ini['host'] . ';dbname=' . $db_ini['db_name'], $db_ini['username'], $db_ini['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }