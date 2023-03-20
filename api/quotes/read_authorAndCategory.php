<?php                   
    // Get author_id
    $quote->author_id = $author_id;
    $quote->category_id = $category_id;

    // Get author quotes
    $result = $quote->read_authorAndCategory(); 

    // Get row count
    $num = $result->rowCount();

    // Check if any Quote
    if($num > 0) {
        // Quote array
        $quote_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author' => $author,
                'category' => $category
            );

            // Push to Array
            array_push($quote_arr, $quote_item);
        }

        // Turn to JSON & output
        echo json_encode($quote_arr);
        
    } else {
        // No Quote
        echo json_encode(array('message' => 'No author_id Found'));
    }