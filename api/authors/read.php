<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: applications/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog author Object
    $author = new Author($db);

    // Blog author query
    $result = $author->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any author
    if($num > 0) {
        // Author array
        $author_arr = array();
        $author_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $author = array(
                'id' => $id,
                'author' => $author,
            );

            // Push to "data"
            array_push($author_arr['data'], $author_item);
        }

        // Turn to JSON & output
        echo json_encode($author_arr);
        
    } else {
        // No author
        echo json_encode(array('message' => 'No authors Found'));
    }
