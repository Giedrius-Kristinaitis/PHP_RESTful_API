<?php 

// set required header fields
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

// include required files
require_once __DIR__ . '/../config/database/db_connection.php';

$db = new Database(null);

$statement = $db->query('SELECT * FROM cars;');

// array to store cars
$cars = array();
$cars['cars'] = array();

// push all returned rows to the cars array
while($data = $statement->fetch(PDO::FETCH_ASSOC)){
    array_push($cars['cars'], $data);
}

echo json_encode($cars);

?>