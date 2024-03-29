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
    // Make sure to follow capitilization for the path.    
    include_once '../../config/Database.php';
    include_once '../../Models/Author.php';
    include_once '../../functions/isValid.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Author Object
    $author = new Author($db);

    // Get Raw JSON data
    // This pulls the commands from the Raw JSON entry 
    $data = json_decode(file_get_contents("php://input"));

    // Get ID if Set
    // Check if Authors exsist in the given model
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $authorsExists = isValid($id, $author);
    } elseif (isset($data->id)) {
        // if no specific authors are in the URL the use the data collected
        $id = $data->id;        
        $authorsExists = isValid($id, $author);
    }
    
    switch($method) {
        case "GET":
            if(isset($id)) {
                // if the ID is set retrieve the specific ID
                if(!$authorsExists){
                    echo json_encode(array('message' => 'author_id Not Found'));
                } else {
                    include_once 'read_single.php';
                }
            } else {
                // No ID set retreive all
                include_once 'read.php';
            }
            break;
        case "POST":
            include_once 'create.php';
            break;
        case "PUT":
            if(!$authorsExists) {
                echo json_encode(array('message' => 'author_id Not Found'));
            } else {
                include_once 'update.php';
            }
            break;
        case "DELETE":
            IF(!$authorsExists){
                echo json_encode(array('message' => 'author_id Not Found'));
            } else {
                include_once 'delete.php';
            }
            break;
    }
    