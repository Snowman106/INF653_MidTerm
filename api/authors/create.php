<?php

// Check Parameters
if(!property_exists($data, 'author')) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
    
    // Set Author to Create
    $author->author = $data->author;

    // Create Author
    $author->create();

    // Create Author JSON data
    $author_arr = array (
        'id' => $db->lastInsertId(),
        'author' => $author->author
    );

    print_r(json_encode($author_arr));
}