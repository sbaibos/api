<?php

class database
{

    private $username = "root";
    private $password =  "";
    private $host = "localhost";
    private $db_name = "myprojects7";
    private $conn;

    function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {

            echo "connection error" . $exception->getMessage();
        }

        return $this->conn;
    }
}







?>