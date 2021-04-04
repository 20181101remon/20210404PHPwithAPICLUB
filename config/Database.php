<?php
class Database{
    //DB Params
    private $host ='localhost';
    private $db_name = 'club';
    private $username='root';
    private $password='';
    private $conn;
    // DB Connect
    public function connect(){
        $this->conn=null;
        try{
            $this->conn=new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name , $this->username , $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->conn->query("SET NAMES utf8");
        }catch(PDOException $e){
            echo '連接失敗'.$e->getMessage();
        }
        return $this->conn;
    }
}
