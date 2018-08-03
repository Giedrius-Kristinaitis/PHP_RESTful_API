<?php

/**
 * Class that performs database operations
 */
class Database {

    // PDO object used to perform operations with the database
    private $pdo;

    // database user information
    private $username = 'root';
    private $password = '';

    /**
     * Class constructor.
     * 
     * Creates a connection to the database
     * 
     * @param args - key/value array of arguments for the connection to the database:
     * driver, host, dbname and charset
     * 
     * If args is null, then the default configuration is used
     */
    public function __construct($args){
        if($args != null){
            $dsn = $args['driver'] . ':host=' . $args['host'] . ';dbname=' . $args['dbname'] . ';charset=' . $args['charset'];
        }else{
            $dsn = 'mysql:host=localhost;dbname=vechiles;charset=utf8mb4';
        }

        $this->pdo = new PDO($dsn, $this->username, $this->password, array());
    }

    /**
     * Prepares a PDO database statement to be executed later
     * 
     * @return PDOStatement prepared database statement
     */
    public function prepareStatement($statement){
        return $this->pdo->prepare($statement);
    }

    /**
     * Executes a prepared PDO database statement
     * 
     * @param PDOStatement statement - prepared statement to execute
     * @param args - array of arguments for the statement
     */
    public function executePreparedStatement($statement, $args){
        return $statement->execute($args);
    }

    /**
     * Executes a non-prepared PDO database statement
     * 
     * @param statement - statement to execute
     * 
     * @return number of affected rows
     */
    public function executeStatement($statement){
        return $this->pdo->exec($statement);
    }

    /**
     * Executes a database query.
     * This should only be used for queries that do not need variables. Use prepared statements if the query needs variables
     * 
     * @param query - query to execute
     * 
     * @return PDOStatement object, false if there was a failure
     */
    public function query($query){
        return $this->pdo->query($query);
    }
}

?>