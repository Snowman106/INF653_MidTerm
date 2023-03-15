<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    // Include files
    // Make sure to follow capitilization for the path.    
    include_once '../../config/Database.php';
    include_once '../../Models/Category.php';
    include_once '../../functions/isValid.php';

    // instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Category Object
    $category = new Category($db);

    // Get Raw JSON data
    // This pulls the commands from the Raw JSON entry 
    $data = json_decode(file_get_contents("php://input"));

    // Get ID if Set
    // Check if Authors exsist in the given model
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $categoryExists = isValid($id, $category);
    } elseif (isset($data->id)) {
        $id = $data->id; 
        $categoryExists = isValid($id, $category);
    }
    
    switch($method) {    
        case "GET":
            if(isset($id)) {
                // if the ID is set retrieve the specific ID
                if(!$categoryExists){
                    echo json_encode(array('message' => 'category_id Not Found'));
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
            if(!$categoryExists) {
                echo json_encode(array('message' => 'category_id Not Found'));
            } else {
                include_once 'update.php';
            }
            break;
        case "DELETE": 
            if(!$categoryExists) {
                echo json_encode(array('message' => 'category_id Not Found'));
            } else {
            include_once 'delete.php';
            }
            break;
    }