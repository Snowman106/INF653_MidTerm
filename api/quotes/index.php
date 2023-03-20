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
    include_once '../../Models/Quote.php';
    include_once '../../functions/isValid.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Quote Object
    $quote = new Quote($db);

    // Get Raw JSON data
    // This pulls the commands from the Raw JSON entry 
    $data = json_decode(file_get_contents("php://input"));

    // Get ID if Set
    // Check if Authors exsist in the given model
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $quotesExist = isValid($id, $quote);
       
    } elseif (isset($data->id)) {
        // if no specific authors are in the URL the use the data collected
        $id = $data->id;
        $quotesExist = isValid($id, $quote);
            
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
            // if the ID is set retrieve the specific ID     
                        
            if(!$quotesExist){
                echo json_encode(array('message' => 'No Quotes Found'));
            } else {
                include_once 'read_single.php';
            }
        } else if (isset($author_id)) {
            if(isset($category_id)){
                include_once 'read_authorAndCategory.php';                
            } else {
                include_once 'read_author.php';
            }
        } else if (isset($category_id)) {
            include_once 'read_category.php';
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