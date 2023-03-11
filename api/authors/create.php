<?php

// Check Parameters
if(!property_exists($data, 'author')) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
   
    // Set Author to Create
    $author->author = $data->author;

    // Create Author
    if($author->create()){
        // echo json_encode(array('message' => 'Author Created'));
    } else {
        echo json_encode(array('message' => 'Author NOT Created'));
    }

    // Create Author JSON data
    $author_arr = array (
        'id' => $db->lastInsertId(),
        'author' => $author->author
    );

    echo json_encode($author_arr);
}