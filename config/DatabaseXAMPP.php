<!-- Database for XAMPP -->

<?php
class Database{
    // DB params
    private $host = 'localhost';
    private $db_name = 'quotesdb';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect
    public function connect() {
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            // echo for tutorial, but log the error for production
            echo 'Connection Error: ' . $$e.getMessage();
        }

        return $this->conn;
    }
}