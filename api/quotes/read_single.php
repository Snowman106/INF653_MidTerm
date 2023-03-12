<?php

    // Get Category
    $quote->read_single(); 

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author,
        'category_id' => $quote->category);

    // Make JSON
    echo json_encode($quote_arr);