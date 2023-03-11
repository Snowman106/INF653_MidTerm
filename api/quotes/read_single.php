<?php

    // Get quote
    $quote->read_single(); 

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author,
        'category' => $quote->category);

    // Make JSON
    echo json_encode($quote_arr);