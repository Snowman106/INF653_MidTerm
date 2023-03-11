<?php

// Delete Category
$category->delete();

// Create Array for JSON Data
$category_arr = array (
    'id' => $category->id
);
    
echo json_encode($category_arr);


