<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    // Include files
    require '../../config/Database.php';
    require '../../models/Category.php';
    require '../../functions/isValid.php';

    // instantiate DB and connect
    $database = new Database();
    $db = $database->connect();

    // instantiate author object
    $category = new Category($db);

    // Get Raw JSON data
    $data = json_decode(file_get_contents("php://input"));

    // Get ID if Set
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
                if(!$categoriesExists){
                    echo json_encode(array('message' => 'authorID NOT Found'));
                } else {
                    include_once 'read.single.php';
                }
            } else {
                include_once 'read.php';
            }
            break;
        case "POST":
            include_once 'create.php';
            break;
        case "PUT":
            if(!$categoryExists) {
                echo json_encode(array('message' => 'categoryId Not Found'));
            } else {
                include_once 'update.php';
            }
            break;
        case "DELETE": 
            if(!$categoryExists) {
                echo json_encode(array('message' => 'categoryId Not Found'));
            } else {
            include_once 'delete.php';
            }
            break;
    }