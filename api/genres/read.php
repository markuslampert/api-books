<?php 
  // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Genre.php';

  // db connection
  $database = new Database();
  $db = $database->connect();
  
  // read all genres from db
  $genre = new Genre($db);
  $result = $genre->read();
  $num = $result->rowCount();

  // genate response_array
  $response_array = //later array becomes json array and associative array becomes json object
  array(
    'data' => array(
      array(
        'genres' => array()
      )
    )
  );

  //fill response_array with genres
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $item = array( //later one item array becomes one json "genre"-object in the json array "genres"
      'id' => $genre_id,
      'name' => $genre_name
    );
    
    array_push($response_array['data'][0]['genres'], $item);
  }

  // response_array to JSON and Output
  echo json_encode($response_array);
/*
  else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
*/