<?php

class Project
{
// database connection 
    private $conn;

// object properties
    public $id;
    public $name;
    public $employer;
    public $dateStartEnd;
    public $description;
    public $analyticalDescription;
    public $siteUrl;
    public $photo;
    public $technologiesUsed;
    public $created;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


// read projects
    function read()
    {


        $query = "SELECT * FROM projects";
        $prepared = $this->conn->prepare($query);
        $prepared->execute();

        return $prepared;
    }

    // read project by id
    function read_by_id()
    {
        //query with positional parameters
        $query = "SELECT id, name, employer, dateStartEnd, description, analyticalDescription, siteUrl, photo, technologiesUsed, created FROM projects WHERE id = ? LIMIT
        0,1";
        $prepared = $this->conn->prepare($query);
       
        $prepared->bindParam(1, $this->id);
        $prepared->execute();

        return $prepared;
        
    }
// delete projects
    function delete()
    {

        //query with positional parameters
        $query = "DELETE from projects where id =?";
        $prepared = $this->conn->prepare($query);
       
        $prepared->bindParam(1, $this->id);

        if ($prepared->execute()) {

            return true;
        } else {


            return false;
        }
    }
// create projects
    function add()
    {

        //query with named parameters
        $query = "INSERT INTO projects SET name=:name, employer=:employer, dateStartEnd=:dateStartEnd, description=:description, analyticalDescription=:analyticalDescription, siteUrl=:siteUrl, photo=:photo, technologiesUsed=:technologiesUsed, created=:created";
        $prepared = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->employer = htmlspecialchars(strip_tags($this->employer));
        $this->dateStartEnd = htmlspecialchars(strip_tags($this->dateStartEnd));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->analyticalDescription = htmlspecialchars(strip_tags($this->analyticalDescription));
        $this->siteUrl = htmlspecialchars(strip_tags($this->siteUrl));
        $this->photo = htmlspecialchars(strip_tags($this->photo));
        $this->technologiesUsed = htmlspecialchars(strip_tags($this->technologiesUsed));
        $this->created = htmlspecialchars(strip_tags($this->created));


        // bind values 
        $prepared->bindParam(":name", $this->name);
        $prepared->bindParam(":employer", $this->employer);
        $prepared->bindParam(":dateStartEnd", $this->dateStartEnd);
        $prepared->bindParam(":description", $this->description);
        $prepared->bindParam(":analyticalDescription", $this->analyticalDescription);
        $prepared->bindParam(":siteUrl", $this->siteUrl);
        $prepared->bindParam(":photo", $this->photo);
        $prepared->bindParam(":technologiesUsed", $this->technologiesUsed);
        $prepared->bindParam(":created", $this->created);

        if ($prepared->execute()) {

            return true;
        } else {

            return false;
        }
    }

// update projects
    function update()
    {

        $query = "UPDATE projects SET name = :name, employer = :employer, 
        dateStartEnd = :dateStartEnd, description = :description, 
        analyticalDescription = :analyticalDescription, siteUrl = :siteUrl,
        photo = :photo, technologiesUsed = :technologiesUsed
    
                WHERE id = :id";

        $prepared = $this->conn->prepare($query);


        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->employer = htmlspecialchars(strip_tags($this->employer));
        $this->dateStartEnd = htmlspecialchars(strip_tags($this->dateStartEnd));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->analyticalDescription = htmlspecialchars(strip_tags($this->analyticalDescription));
        $this->siteUrl = htmlspecialchars(strip_tags($this->siteUrl));
        $this->photo = htmlspecialchars(strip_tags($this->photo));
        $this->technologiesUsed = htmlspecialchars(strip_tags($this->technologiesUsed));
// bind values
        $prepared->bindParam(':id', $this->id);
        $prepared->bindParam(':name', $this->name);
        $prepared->bindParam(':employer', $this->employer);
        $prepared->bindParam(':dateStartEnd', $this->dateStartEnd);
        $prepared->bindParam(':description', $this->description);
        $prepared->bindParam(':analyticalDescription', $this->analyticalDescription);
        $prepared->bindParam(':siteUrl', $this->siteUrl);
        $prepared->bindParam(':photo', $this->photo);
        $prepared->bindParam(':technologiesUsed', $this->technologiesUsed);

        if ($prepared->execute()) {


            return true;
        } else {

            return false;
        }
    }
}
