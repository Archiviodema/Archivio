<?php

class Database{
    protected $servername = "89.46.111.134";
    protected $username = "Sql1520781";
    protected $password = "Itcatlov_1";
    protected $dbname = "Sql1520781_4";
    protected $connection;

    public function __construct(){
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function query($query){
        $result = $this->connection->query($query) or die($this->connection->error);
        return $result->fetch_assoc();
    }

    public function insert($query){
        return $this->connection->query($query);
    }
}
