<?php

public function query($stmt){
    try{
        $stmt->execute();
        return $stmt;
    } catch(PDOException $e) {
        echo json_encode(
            array('message' => $e->getmessage()));                    
    }  
}