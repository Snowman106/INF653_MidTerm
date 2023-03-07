<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: applications/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if($method == 'OPTIONS'){
        header('Access-Control-Allow_Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }
    ?>
   
   <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Justin Snowden</title>
    </head>
    <body>
        <h1>Justin Snowden INF 653 Midterm</h1>
    </body>
    </html>