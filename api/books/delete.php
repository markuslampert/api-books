<?php 
  include_once '_atFirst.php';

  // Headers
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $book = new Book($db);

  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update. It comes from query parameter.
  $book->book_id = isset($_GET['book_id']) ? $_GET['book_id'] : die();

  // answer to the user
  if($book->delete()) {
    echo json_encode(
      array('message' => 'Book Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Book Not Deleted')
    );
  }

