<?php
  include_once '_atFirst.php';
  
  // Headers
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $book = new Book($db);

  // Read in json input as json object. php://input is only reachable if there is no url rewriting by the webserver.
  // Rewriting of post request leads to get request.
  
  $json_obj = json_decode(file_get_contents("php://input"));

  // set attributes of book object 
  $book->title = $json_obj->book->title;
  $book->author_last_name = $json_obj->book->author_last_name;
  $book->publishing_company = $json_obj->book->publishing_company;
  $book->year = $json_obj->book->year;
  $book->genre_id = $json_obj->book->genre_id;

  // answer to the user
  if($book->create()) {
    echo json_encode(
      array('message' => 'Book Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Book Not Created')
    );
  }

