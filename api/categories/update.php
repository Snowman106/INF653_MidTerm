<?php

// Check for ALL Parameters 
if(!property_exists($data, 'id') || !property_exists($data, 'category'))  {
    echo json_encode(array('message' => 'Missing Required Parameters'));
} else {
    // Set Category to Update
    $category->category = $data->category;

    // Update Category
    $category->update();

    // create array for JSON data
    $category_arr = array (
        'id' => $category->id,
        'category' => $category->category
    );
    
    echo (json_encode($category_arr));

}
