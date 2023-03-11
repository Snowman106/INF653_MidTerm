<?php 
    class Category {

        // DB stuff
        private $conn;
        private $table = 'categories';

        // Category Properties
        public $id;
        public $category;

        // Construct with DB
        public function __construct($db) {
        $this->conn = $db;
        }

        // Get Categeories
        public function read(){
            // Create Query
            $query = 'SELECT 
                id, 
                category
            FROM 
                ' . $this->table;

            // Prepared Statements
            $stmt = $this->conn->prepare($query);

            // Execute query
            try{
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(
                    array('message' => $e->getmessage()));                    
            }           
        }

        // Get Single Categories
        public function read_single(){
            // Create Query
            $query = 'SELECT id, category FROM ' . $this->table . ' WHERE id = ? LIMIT 1 OFFSET 0';  // this was different for postgreSQL than mySQL


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            try{
                // Execute query
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($row) {
                    // Set Properties
                    $this->id = $row['id'];
                    $this->category = $row['category'];
                    return true;
                } else {
                    return false;
                }
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Create Categories
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' (category) VALUES (:category)';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind Data
            $stmt->bindParam(':category', $this->category);

            // Execute query
            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
            
        }

        // Update category
        public function Update(){
            // Create query
            $query = 'UPDATE ' . $this->table . ' SET category = :category WHERE id = :id';


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category = htmlspecialchars(strip_tags($this->category));
        
            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);

            try{
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(
                    array('message' => $e->getmessage()));                    
            } 
        }

        // Delete Category
        public function delete(){
            // Create query
            $query = 'DELETE FROM ' . 
                $this->table. ' 
            WHERE 
                id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Date 
            $stmt->bindParam(':id', $this->id);

            // Execute query
            try{
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(
                    array('message' => $e->getmessage()));                    
            } 
        }
    }
            
