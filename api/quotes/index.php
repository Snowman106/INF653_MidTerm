<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: applications/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method === 'OPTIONS'){
        header('Access-Control-Allow_Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
    
    // Include Files    
    include_once '../../config/Database.php';
    include_once '../../Models/Quote.php';
    include_once '../../functions/isValid.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Quote Object
    $quote = new Quote($db);

    // Get Raw JSON data
    $data = json_decode(file_get_contents("php://input"));

    // Declare Variable for Isset
    // $id;
    // $authorId;
    // $categoryId;

    // Get ID if Set
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $quotesExist = isValid($id, $quote);
        //echo json_encode(array('message' => 'get ID'));
    } elseif (isset($data->id)) {
        $id = $data->id;
        $quotesExist = isValid($id, $quote);
        //echo json_encode(array('message' => 'data ID'));
    } else {
        // echo json_encode(array('message' => 'no ID set'));
    }

   
    if(isset($_GET['authorId'])){
        $authorId = $_GET['authorId'];
    } else {
        //echo json_encode(array('message' => 'author_Id NOT Found in isset'));
    }

    if(isset($_GET['categoryId'])){
        $categoryId = $_GET['categoryId'];
    } else {
       // echo json_encode(array('message' => 'Category_Id NOT Found in isset'));
    }


switch($method) {
    case "GET":
        if(isset($id)) {
            if(!$quotesExist){
                echo json_encode(array('message' => 'quote_ID NOT Found'));
            } else {
                include_once 'read_single.php';
            }
        } else {
            include_once 'read.php';
        }
        break;
    case "POST":
        include_once 'create.php';
        break;
    case "PUT":
        if(!$quotesExist) {
            echo json_encode(array('message' => 'quote_ID NOT Found'));
        } else {
            include_once 'update.php';
        }
        break;
    case "DELETE":
        IF(!$quotesExist){
            echo json_encode(array('message' => 'quote_ID NOT Found'));
        } else {
            include_once 'delete.php';
        }
        break;
}