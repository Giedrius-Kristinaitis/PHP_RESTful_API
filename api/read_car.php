<?php 

// set required header fields
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

// include required files
require_once __DIR__ . '/../config/database/db_connection.php';

// get the car if id is specified
if(isset($_GET['id'])){
    $db = new Database(null);

    $query = 'SELECT * FROM cars WHERE id = ? ;';
    
    $statement = $db->prepareStatement($query);
    $db->executePreparedStatement($statement, array($_GET['id']));

    if($statement->rowCount() < 1){
        echo '{';
        echo '"message": "ERROR: invalid car id provided"';
        echo '}';
    }else{
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
}else{
    echo '{';
    echo '"message": "ERROR: please provide car id"';
    echo '}';
}

?>