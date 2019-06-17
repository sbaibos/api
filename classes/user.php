<?php

class User
{
// database connection 
    private $conn;

// object properties
    public $id;
    public $full_name;
    public $username;
    public $password;
    public $created;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


// read users
    function read()
    {


        $query = "SELECT * FROM users";
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        return $prepared;
    }

    // read project by id
    function read_by_id()
    {
        //query with positional parameters
        $query = "SELECT id, full_name, username, password, created FROM users WHERE id = ? LIMIT
        0,1";
        $prepared = $this->conn->prepare($query);
       
        $prepared->bindParam(1, $this->id);
        $prepared->execute();

        return $prepared;
        
    }
// delete users
    function delete()
    {

        //query with positional parameters
        $query = "DELETE from users where id =?";
        $prepared = $this->conn->prepare($query);
       
        $prepared->bindParam(1, $this->id);

        if ($prepared->execute()) {

            return true;
        } else {


            return false;
        }
    }
// create users
    function add()
    {

        //query with named parameters
        $query = "INSERT INTO users SET full_name=:full_name, username=:username, password=:password, created=:created";
        $prepared = $this->conn->prepare($query);

        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));         
        $this->created = htmlspecialchars(strip_tags($this->created));


        // bind values 
        $prepared->bindParam(":full_name", $this->full_name);
        $prepared->bindParam(":username", $this->username);
        $prepared->bindParam(":password", $this->password);       
        $prepared->bindParam(":created", $this->created);

        if ($prepared->execute()) {

            return true;
        } else {

            return false;
        }
    }

// update users
    function update()
    {

        $query = "UPDATE users SET full_name=:full_name, username=:username, password=:password
    
                WHERE id = :id";

        $prepared = $this->conn->prepare($query);


        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->full_name = htmlspecialchars(strip_tags($this->full_name));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));         
        
// bind values
        $prepared->bindParam(':id', $this->id);
        $prepared->bindParam(":full_name", $this->full_name);
        $prepared->bindParam(":username", $this->username);
        $prepared->bindParam(":password", $this->password); 

        if ($prepared->execute()) {


            return true;
        } else {

            return false;
        }
    }
}
