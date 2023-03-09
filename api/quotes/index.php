<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: applications/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'OPTIONS'){
        header('Access-Control-Allow_Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
    
    // Include Files    
    require '../../config/Database.php';
    require '../../models/Quote.php';
    require '../../functions/isValid.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Quote Object
    $quote = new Quote($db);

    // Get Raw JSON data
    $data = json_decode(file_get_contents("php://input"));

    // Declare Variable for Isset
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $quote = isValid($id, $quote);
    } elseif (isset($data->id)) {
        $id = $data->id;
        $quotesExists = isValid($id, $quote);
    }

switch($method) {
    case "GET":
        if(isset($id)) {
            if(!$quotesExists){
                echo json_encode(array('message' => 'quoteID NOT Found'));
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
        if(!$quotesExists) {
            echo json_encode(array('message' => 'quoteID NOT Found'));
        } else {
            include_once 'update.php';
        }
        break;
    case "DELETE":
        IF(!$quotesExists){
            echo json_encode(array('message' => 'quoteID NOT Found'));
        } else {
            include_once 'delete.php';
        }
        break;
}