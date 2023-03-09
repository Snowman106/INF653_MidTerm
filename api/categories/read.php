<?php

    // Category query
    $result = $category->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any Category
    if($num > 0) {
        // Category array
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category,
            );

            // Push to "data"
            array_push($category_arr['data'], $category_item);
        }

        // Turn to JSON & output
        echo json_encode($category_arr);
        
    } else {
        // No Category
        echo json_encode(array('message' => 'No categories Found'));
    }
