<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
    
    // Include Files    
    require '../../config/Database.php';
    require '../../Models/Author.php';
    require '../../functions/isValid.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author Object
    $author = new Author($db);

    // Get Raw JSON data
    $data = json_decode(file_get_contents("php://input"));

    // Variable for isset
    $id;

    // Get ID if Set
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $authorsExists = isValid($id, $author);
    } elseif (isset($data->id)) {
        $id = $data->id;        
        $authorsExists = isValid($id, $author);
    }
    
    echo json_encode(array('message' => 'method: ' . $method));
    switch($method) {
        case "POST":
            echo json_encode(array('message' => 'Posting used'));
            include_once 'create.php';
            break;
        case "GET":
            echo json_encode(array('message' => 'GET USED'));
            if(isset($id)) {
                if(!$authorsExists){
                    echo json_encode(array('message' => 'authorID NOT Found'));
                } else {
                    echo json_encode(array('message' => 'Read_single called'));
                    include_once 'read_single.php';
                }
            } else {
                
                echo json_encode(array('message' => 'Read called'));
                include_once 'read.php';
            }
            break;
        
        case "PUT":
            if(!$authorsExists) {
                echo json_encode(array('message' => 'authorID NOT Found'));
            } else {
                include_once 'update.php';
            }
            break;
        case "DELETE":
            IF(!$authorsExists){
                echo json_encode(array('message' => 'authorID NOT Found'));
            } else {
                include_once 'delete.php';
            }
            break;
    }