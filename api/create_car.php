<?php 

// set required header fields
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type');

// include requires files
require_once __DIR__ . '/../config/database/db_connection.php';

// execute only if correct car properties are provided
if(isset($_POST['model']) && isset($_POST['hp']) && isset($_POST['topSpeed']) & isset($_POST['price'])){ 
    $db = new Database(null);

    $query = 'INSERT INTO cars (model, hp, top_speed, price) VALUES (?, ?, ?, ?);';
    
    $statement = $db->prepareStatement($query);
    $db->executePreparedStatement($statement, array($_POST['model'], $_POST['hp'], $_POST['topSpeed'], $_POST['price']));

    echo '{';
    echo '"message": "Car successfully created"';
    echo '}';
}else{
    echo '{';
    echo '"message": "ERROR: invalid car properties provided"';
    echo '}';
}

?>