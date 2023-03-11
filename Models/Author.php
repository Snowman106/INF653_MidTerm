<?php 
    class Author {

        // DB stuff
        private $conn;
        private $table = 'authors';

        // Author Properties
        public $id;
        public $author;

        // Construct with DB
        public function __construct($db) {
        $this->conn = $db;
        }

        // Get authors
        public function read(){
            // Create Query
            $query = 'SELECT id, author FROM ' . $this->table;

            // Prepared Statements
            $stmt = $this->conn->prepare($query);

            // Execute query
            try{
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));                    
            }           
        }

        // Get Single authors
        public function read_single(){            
            
            // Create Query
            $query = 'SELECT 
                id,
                author
            FROM '
                . $this->table . 
            ' WHERE 
                id = ? 
            LIMIT 1 OFFSET 0';  // this was different for postgreSQL than mySQL

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
                    $this->author = $row['author'];
                    return true;
                } else {
                    return false;
                }
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Create authors
        public function create(){
            // Create query
            
            $query = 'INSERT INTO ' . 
                $this->table . ' (author) VALUES (:author)';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind Data
            $stmt->bindParam(':author', $this->author);

            // Execute query
            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
            
        }

        // Update author
        public function Update(){
            // Create query
            $query = 'UPDATE ' . $this->table . ' SET author = :author WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->author = htmlspecialchars(strip_tags($this->author));
        
            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            try{
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));                    
            } 
        }

        // Delete Author
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
                echo json_encode(array('message' => $e->getmessage()));                    
            } 
        }
    }
            
