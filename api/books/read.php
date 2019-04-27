<?php 
  include_once '_atFirst.php';

  // instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $book = new Book($db);

  // read in books table
  $result = $book->read();
  $num = $result->rowCount();

  if($num > 0) {
    
    $response_array = 
      array(
        'data' => array(
          array(
            'books' => array(
                /*books come here*/
            ) 
          )
        )
      );

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $book_item = array(
        'book_id' => $book_id,
        'title' => $title,
        'author_last_name' => $author_last_name,
        'publishing_company' => $publishing_company,
        'year' => $year,
        'genre_name' => $genre_name
      );

      array_push($response_array['data'][0]['books'], $book_item);
    }

    // Turn to JSON & output
    echo json_encode($response_array);

  } else {
    // No Books
    echo json_encode(
      array('message' => 'No Books Found')
    );
  }
