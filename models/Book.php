<?php 
  class Book {
    
    private $conn;
    private $table = 'books';

    public $book_id;
    public $title;
    public $author_last_name;
    public $publishing_company;
    public $year;
    public $genre_name;
    public $genre_id;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function clean_data(){
    /*Cleans user input data to avoid code injection.
      User input data is stored on the attributes of this object.
     */
      // iterate all attributes wich are set and clean them
      foreach ($this as $key => $value) {
        if(empty($value)){
          continue;
        }
        $this->$key = htmlspecialchars($value); //convert special chars into corresponding HTML codes
      }
    }

    public function read() {
    /*reads books together with genres in whole table and returns PDOStatement-Obj. wich contains the table rows
     */
      $query = '
        SELECT
          book_id,
          title,
          author_last_name,
          publishing_company,
          year,
          genre_name
        FROM ' . $this->table . ' b
        JOIN genres g
          ON b.genre_id = g.genre_id;';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt; // returns PDOStatement-Obj. after execute
    }

    public function read_single() {
    /*reads on book from table books and saves its column values as the attributes of this objekt
     */
      $query = '
        SELECT
          book_id,
          title,
          author_last_name,
          publishing_company,
          year,
          genre_name
        FROM ' . $this->table . ' b
        JOIN genres g
          ON b.genre_id = g.genre_id
        Where book_id = ?;';  
      
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->book_id); // bind ID to statement
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->book_id = $row['book_id'];
      $this->title = $row['title'];
      $this->author_last_name = $row['author_last_name'];
      $this->publishing_company = $row['publishing_company'];
      $this->year = $row['year'];
      $this->genre_name = $row['genre_name'];
    }

    public function create() {
    /*Insert a book to the book table. The corresponding genre_id is needed.
      Data for the insert is read from the attributes of this object.
     */ 
      $query = '
        INSERT INTO ' . $this->table . '(
          title,
          author_last_name,
          publishing_company,
          year,
          genre_id
        )
        values(
          ?,?,?,?,?
        );';

      $stmt = $this->conn->prepare($query);
      
      // clean input data to avoid code injection
      $this->clean_data();

      // bind data
      $stmt->bindParam(1, $this->title);
      $stmt->bindParam(2, $this->author_last_name);
      $stmt->bindParam(3, $this->publishing_company);
      $stmt->bindParam(4, $this->year);
      $stmt->bindParam(5, $this->genre_id);
      
      // try to execute
      if($stmt->execute()) {
        return true;
      }

      // print error if an error occures
      printf("Error: %s.\n", $stmt->error);
      return false;
    }

    public function update() {
    /*Updates a book within the book table.
     */
      $query = '
        UPDATE ' . $this->table . '
        SET
          title = ?,
          author_last_name = ?,
          publishing_company = ?,
          year = ?,
          genre_id = ?  
        WHERE
          book_id = ?;';

      $stmt = $this->conn->prepare($query);

      // clean data
      $this->clean_data();

      // bind data
      $stmt->bindParam(1, $this->title);
      $stmt->bindParam(2, $this->author_last_name);
      $stmt->bindParam(3, $this->publishing_company);
      $stmt->bindParam(4, $this->year);
      $stmt->bindParam(5, $this->genre_id);
      $stmt->bindParam(6, $this->book_id);

      // execute query
      if($stmt->execute()) {
        return true;
      }

      // print error if an error occures
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete Book
    public function delete() {
    /*Deletes a book entry from table books.
     */
      $query = '
        DELETE FROM ' . $this->table . '
        WHERE
          book_id = ?;';

        $stmt = $this->conn->prepare($query);

        // clean data
        $this->clean_data();

        // bind data
        $stmt->bindParam(1, $this->book_id);

        // execute query
        if($stmt->execute()) {
          return true;
        }

        // print error if an error occures
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    
  }