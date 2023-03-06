<?php
class Database{
    // DB params
    private $host = 'localhost';
    private $db_name = 'INF653_Midterm';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect
    public function connect() {
        $this->conn = null;
        //$dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->name}";

        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname= ' . $this->db_name, $this->username, $this->password);
            //$this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            // echo for tutorial, but log the error for production
            echo 'Connection Error: ' . $$e.getMessage();
        }

        return $this->conn;
    }
}

// <?php
//     class Databse{
//         private $conn;
//         private $host;
//         private $port;
//         private $dbname;
//         private $username;
//         private $password;

//         public function __constructor(){
//             $this->username = getenv('USERNAME');
//             $this->password = getenv('PASSWORD');
//             $this->dbname = getenv('DBNAME');
//             $this->host = getenv('HOST');
//             $this->port = getenv('PORTR');
//         }

//         public function connect(){
//             if($this->conn){
//                 return $this->conn;
//             } else {
//                 $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->name}";

//                 try{
//                     $this->conn = new PDO($dsn, $this->username, $this->password);
//                     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                     return $this->conn;
//                 } catch (PDOException $e){
//                     // echo for tutorial, but log the error for production
//                     echo 'Connection Error: ' . $$e.getMessage();
//                 }
//             }
//         }
//     } 