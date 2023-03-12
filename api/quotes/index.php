<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
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

    $id;
    $author_id;
    $category_id;

    // Get ID if Set
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $quotesExist = isValid($id, $quote);
       // echo json_encode(array('message' => 'Get ID'));
    } elseif (isset($data->id)) {
        $id = $data->id;
        $quotesExist = isValid($id, $quote);
       // echo json_encode(array('message' => 'Data ID'));
    } 
   
    if(isset($_GET['author_id'])){
        $author_id = $_GET['author_id'];
    } else {
        //echo json_encode(array('message' => 'author_id NOT Found in isset'));
    }

    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
    } else {
       // echo json_encode(array('message' => 'Category_id NOT Found in isset'));
    }

switch($method) {
    case "GET":
        if(isset($id)) {
            if(!$quotesExist){
                echo json_encode(array('message' => 'No Quotes Found'));
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
            echo json_encode(array('message' => 'No Quotes Found'));
        } else {
            include_once 'update.php';
        }
        break;
    case "DELETE":
        IF(!$quotesExist){
            echo json_encode(array('message' => 'No Quotes Found'));
        } else {
            include_once 'delete.php';
        }
        break;
}