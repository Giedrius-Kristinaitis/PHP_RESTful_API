<?php 

// set required header fields
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 3600');

// include required files
require_once __DIR__ . '/../config/database/db_connection.php';

// delete the car if id is provided
if(isset($_POST['id'])){
    $db = new Database(null);

    $query = 'DELETE FROM cars WHERE id = ? ;';

    $statement = $db->prepareStatement($query);
    $db->executePreparedStatement($statement, array($_POST['id']));

    if($statement->rowCount() < 1){
        echo '{';
        echo '"message": "ERROR: invalid car id provided"';
        echo '}';
    }else{
        echo '{';
        echo '"message": "Car with id = ' . $_POST['id'] . ' successfully deleted"';
        echo '}';
    }
}else{
    echo '{';
    echo '"message": "ERROR: please provide car id"';
    echo '}';
}

?>