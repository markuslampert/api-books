<?php 
  include_once '_atFirst.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog book object
  $book = new Book($db);

  // Set ID to select the book. It comes from query parameter.
  $book->book_id = isset($_GET['book_id']) ? $_GET['book_id'] : die();

  // Get book
  $book->read_single();

  // Create array
  $response_array =
    array(
      'data' => array(
        array(
          'books' => array(
            array(
              'book_id' => $book->book_id,
              'title' => $book->title,
              'author_last_name' => $book->author_last_name,
              'publishing_company' => $book->publishing_company,
              'year' => $book->year,
              'genre_name' => $book->genre_name
            )
          ) 
        )
      )
    );

    array(
      'data' => array(
        array(
          'genres' => array()
        )
      )
    );

  // Make JSON
  print_r(json_encode($response_array));
