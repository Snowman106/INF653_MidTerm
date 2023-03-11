<?php

// Check Parameters
if(!property_exists($data, 'category')) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
   
    // Set Category to Create
    $category->category = $data->category;

    // Create Category
    if($category->create()){
        // echo json_encode(array('message' => 'Category Created'));
    } else {
        echo json_encode(array('message' => 'Category NOT Created'));
    }

    // Create Category JSON data
    $category_arr = array (
        'id' => $db->lastInsertId(),
        'category' => $category->category
    );

    echo (json_encode($category_arr));
}