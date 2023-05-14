<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $username;
    public $email;
    public $name;
    public $dob;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all Users
    function read(){
    
        // select all query
        $query = "SELECT
                    `name`, `email`, `username`, `dob`
                FROM 
                    ". $this->table_name ." ";
                
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single user data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `name`, `email`, `username`, `dob`
                FROM
                    ". $this->table_name ."
                WHERE
                    username = '".$this->username."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create User
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name`, `email`, `username`, `dob`)
                  VALUES
                        ('".$this->name."', '".$this->email."', '".$this->username."', '".$this->dob."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update user 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', email='".$this->email."', dob='".$this->dob."'
                WHERE
                    username='".$this->username."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete user
    function delete(){
        
        // query to delete record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE username=\"p123\" ";
//                    username= '".$this->username."'";

        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}