<?php
class LidhjaDB {
    private static $instanca = null;
    private $conn;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'menaxhimios';

    private function __construct(){
        $this->conn =new mysqli($this->host, $this->username, $this->password, $this->dbname);
    }
    public static function getInstance(){
        if(!self::$instanca){
            self::$instanca = new LidhjaDB();
        }
        return self::$instanca;
    }

    public function getLidhje(){
        return $this->conn;
    }
} 
?>


