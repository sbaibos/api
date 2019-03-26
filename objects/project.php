<?php
class Project{
 
    // database connection and table name
    private $conn;
    private $table_name = "projects";
 
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
    public function __construct($db){
        $this->conn = $db;
    }
	
	
	// read products
function read(){
 
     // select all query
     $query = "SELECT id, name, employer, dateStartEnd, description, analyticalDescription, siteUrl, photo, technologiesUsed, created
            FROM projects ORDER BY created DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
    //var_dump($stmt->execute());
    return $stmt;
}

// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO projects SET name=:name, employer=:employer, dateStartEnd=:dateStartEnd, description=:description, analyticalDescription=:analyticalDescription, siteUrl=:siteUrl, photo=:photo, technologiesUsed=:technologiesUsed, created=:created";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->employer=htmlspecialchars(strip_tags($this->employer));
    $this->dateStartEnd=htmlspecialchars(strip_tags($this->dateStartEnd));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->analyticalDescription=htmlspecialchars(strip_tags($this->analyticalDescription));
    $this->siteUrl=htmlspecialchars(strip_tags($this->siteUrl));
    $this->photo=htmlspecialchars(strip_tags($this->photo));
    $this->technologiesUsed=htmlspecialchars(strip_tags($this->technologiesUsed));
    $this->created=htmlspecialchars(strip_tags($this->created));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":employer", $this->employer);
    $stmt->bindParam(":dateStartEnd", $this->dateStartEnd);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":analyticalDescription", $this->analyticalDescription);
    $stmt->bindParam(":siteUrl", $this->siteUrl);
    $stmt->bindParam(":photo", $this->photo);
    $stmt->bindParam(":technologiesUsed", $this->technologiesUsed);
    $stmt->bindParam(":created", $this->created);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
    
  // used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT id, name, employer, dateStartEnd, description, analyticalDescription, siteUrl, photo, technologiesUsed, created FROM projects WHERE id = ? LIMIT
    0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 //var_dump($stmt->execute());
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->id = $row['id'];
    $this->name = $row['name'];
    $this->employer = $row['employer'];
    $this->dateStartEnd = $row['dateStartEnd'];
    $this->description = $row['description'];
    $this->analyticalDescription = $row['analyticalDescription'];
    $this->siteUrl = $row['siteUrl'];
    $this->photo = $row['photo'];
    $this->technologiesUsed = $row['technologiesUsed'];
    
}
  


// update the project
function update(){
 
    // update query
    $query = "UPDATE projects SET name = :name, employer = :employer, 
    dateStartEnd = :dateStartEnd, description = :description, 
    analyticalDescription = :analyticalDescription, siteUrl = :siteUrl,
    photo = :photo, technologiesUsed = :technologiesUsed

            WHERE id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
   $this->employer=htmlspecialchars(strip_tags($this->employer));
    $this->dateStartEnd=htmlspecialchars(strip_tags($this->dateStartEnd));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->analyticalDescription=htmlspecialchars(strip_tags($this->analyticalDescription));
    $this->siteUrl=htmlspecialchars(strip_tags($this->siteUrl));
    $this->photo=htmlspecialchars(strip_tags($this->photo));
    $this->technologiesUsed=htmlspecialchars(strip_tags($this->technologiesUsed));
    
 
    // bind new values
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':name', $this->name);
     $stmt->bindParam(':employer', $this->employer);
    $stmt->bindParam(':dateStartEnd', $this->dateStartEnd);
     $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':analyticalDescription', $this->analyticalDescription);
     $stmt->bindParam(':siteUrl', $this->siteUrl);
    $stmt->bindParam(':photo', $this->photo);
    $stmt->bindParam(':technologiesUsed', $this->technologiesUsed);
    // var_dump($this->id);
    // var_dump($this->name);
    // var_dump($this->employer);
    // var_dump($this->dateStartEnd);
    // var_dump($this->description);
    // var_dump($this->analyticalDescription);
    // var_dump($this->siteUrl);
    // var_dump($this->photo);
    // var_dump($this->technologiesUsed);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

// delete the projects
function delete(){
 
    // delete query
    $query = "DELETE FROM projects WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;


	   

	
	
}


}