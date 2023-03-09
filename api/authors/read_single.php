<?php


    // Get Author
    $author->read_single(); 

    // Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author);

    // Make JSON
    echo json_encode($author_arr);