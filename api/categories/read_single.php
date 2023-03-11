<?php

    // Get Category
    $category->read_single(); 

    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category);

    // Make JSON
    echo json_encode($category_arr);