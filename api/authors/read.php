<?php

    // Author query
    $result = $author->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any author
    if($num > 0) {
        // Author array
        $author_arr = array();
        // $author_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author,
            );

            // Push to "data"
            //array_push($author_arr['data'],$author_item);
            array_push($author_arr ,$author_item);
        }

        // Turn to JSON & output
        echo json_encode($author_arr);
        
    } else {
        // No author
        echo json_encode(array('message' => 'No authors Found'));
    }
