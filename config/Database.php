<?php

class Database
{
    protected $db;

    public function connect()
    {
        try {
            // PDO connection and encode UTF-8
            $connection = $this->db = new PDO("mysql:host=localhost;dbname=webServices;charset=utf8", "root", "");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $connection;
        } catch (PDOException $th) {
            echo "Connection failed: " . $th->getMessage();
        }
    }

    public function setNames()
    {
        return $this->db->query("SET NAMES 'utf8'");
    }
}
