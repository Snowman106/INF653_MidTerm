<?php

// Delete Category
$quote->delete();

// Create Array for JSON Data
$quote_arr = array (
    'id' => $quote->id
);
    
echo json_encode($quote_arr);


