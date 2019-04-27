<?php
  class Genre {

    private $conn;
    private $table = 'genres';

    public function __construct($db) {
      $this->conn = $db;
    }

    // Get genres
    public function read() {
      $query = '
        SELECT
          genre_id,
          genre_name
        FROM ' . $this->table . ';';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt; //returns PDOStatement-Obj. after execute
    }
  }
