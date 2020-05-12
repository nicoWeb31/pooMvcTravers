<?php 

/**
 * PDO Database classe
 * connect 
 * create/prepare
 * bind value
 * return row and result
 */
class Database 
{
private $host = DB_HOST;
private $user = DB_USER;
private $pass = DB_PASS;
private $dbname = DB_DBNAME;

private $dbh;
private $stmt;
private $error;

public function __construct()
{
    
    $dsn = 'mysql:host=' . $this->host .';dbname=' .$this->dbname;
    $option = [
        PDO::ATTR_PERSISTENT =>true,
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
    ];
    //create pdo instance
    try{
        $this->dbh = new PDO($dsn,$this->user,$this->pass,$option);


    }catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
    }
}


//prepare function witrh query
public function query($sql){
    $this->stmt = $this->dbh->prepare($sql);

}

//bind value
public function bind($param,$value,$type = null){
    if(is_null($type)){
        switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
            break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
            break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
            break;
            default :
            $type = PDO::PARAM_STR;
            }   

    }

    $this->stmt->bindValue($param,$value,$type);
}

//execute the prepare statment

public function execute(){
    return $this->stmt->execute();
}

//get result set as array of objecxt 
public function resultSet(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
}

//get single record as object  
public function single(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
}

//get row count
public function rowCount(){
    return $this->stmt->rowCount();
}



}