<?php

// Include other Models
include_once '../../Models/Author.php';
include_once '../../Models/Category.php';

// Check Parameters
if(!property_exists($data, 'quote') 
&& !property_exists($data, 'authorId')
&& !property_exists($data, 'categoryId')) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {

    // Instantiate Objects
    $author = new Author($db);
    $category = new Category($db);

    // Validate Authors and Categories 
    
    if(!isValid($data->authorId, $author)) {
        echo json_encode(array('message' => 'author_id Not Found'));
    } elseif(!isValid($data->categoryId, $category)){        
        echo json_encode(array('message' => 'category_id Not Found'));
    } else { 
        
        // Set Quote to Create
        $quote->quote = $data->quote;
        $quote->authorId = $data->authorId;
        $quote->categoryId = $data->categoryId;

            // Create Quote
        if($quote->create()){
        } else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }

        // Create Quote JSON data
        $quote_arr = array (
            'id' => $db->lastInsertId(),
            'quote' => $quote->quote, 
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId
        );

        echo json_encode($quote_arr);

    }

   
}