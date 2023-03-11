<?php

// Include other Models
include_once '../../Models/Author.php';
include_once '../../Models/Category.php';

// Check Parameters
if(!property_exists($data, 'quote') 
&& !property_exists($data, 'author_id')
&& !property_exists($data, 'category_id')) {
    echo json_encode(array('message' => 'Missing Required Parameters'));

} else {

    // Instantiate Objects
    $author = new Author($db);
    $category = new Category($db);
    
    if(!isValid($data->author_id, $author)) {
        echo json_encode(array('message' => 'author_id Not Found'));
    } elseif(!isValid($data->category_id, $category)){        
        echo json_encode(array('message' => 'category_id Not Found'));
    } else { 
        // Set Quote to Update
        $quote->quote = $data->quote;
        $quote->author_id = $data->author_id;
        $quote->category_id = $data->category_id;

        if($quote->update()){

        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }

        // Create Quote JSON data
        $quote_arr = array (
            'id' => $quote->id,
            'quote' => $quote->quote, 
            'author_id' => $quote->author_id,
            'category_id' => $quote->category_id
        );

        echo json_encode($quote_arr);

    }
}
