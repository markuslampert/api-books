<?php 
  include_once '_atFirst.php';

  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $book = new Book($db);

  $json_obj = json_decode(file_get_contents("php://input"));

  // Set ID to update. It comes from query parameter.
  $book->book_id = isset($_GET['book_id']) ? $_GET['book_id'] : die();
  
  // set attributes of book object 
  $book->title = $json_obj->book->title;
  $book->author_last_name = $json_obj->book->author_last_name;
  $book->publishing_company = $json_obj->book->publishing_company;
  $book->year = $json_obj->book->year;
  $book->genre_id = $json_obj->book->genre_id;

  // Update post
  if($book->update()) {
    echo json_encode(
      array('message' => 'Book Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Book Not Updated')
    );
  }
