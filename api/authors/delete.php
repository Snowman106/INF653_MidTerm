<?php

// Delete Author
$author->delete();

// Create Array for JSON Data
$author_arr = array (
    'id' => $author->id
);
    
echo json_encode($author_arr);


