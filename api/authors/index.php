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
    
    require '../../functions/isValid.php';
    require '../../config/Database.php';
    require '../../models/Author.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author Object
    $author = new Author($db);

    // Get Raw JSON data
    $data = json_decode(file_get_contents("php://input"));

    // Declare Variable for Isset
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $authorsExists = isValid($id, $author);
    } elseif (isset($data->id)) {
        $id = $data->id;
        $authorsExists = isValid($id, $author);
    }

switch($method) {
    case "GET":
        if(isset(4id)) {
            if(!$authorsExists){
                echo json_encode(array('message' => 'authorID NOT found'));
            } else {
                include_once 'read.single.php';
            }
        } else {
            include_once 'read.php';
        }
        break;
}