<?php 
    class Quote {

        // DB stuff
        private $conn;
        private $table = 'quotes';

        // Quotes Properties
        public $id;
        public $quote;
        public $authorId;
        public $categoryId;

        // Construct with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Quotes
        public function read(){
            // Create Query
            $query = "SELECT 
                c.category AS category, 
                q.id, 
                q.categoryId, 
                a.author AS author,
                q.authorId,
                q.quote
            FROM 
                " . $this->table . " q
            LEFT JOIN 
                categories c ON q.categoryId = c.id
            LEFT JOIN 
                authors a ON q.authorId = a.id
            ORDER BY 
                q.id";
                
            // prepared statement
            $stmt = $this->conn->prepare($query);

            try {
                // execute query
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(
                    array('message' => $e->getmessage())
                );
            }
        }

        // Get Single Quotes
        public function read_single(){
            // Create Query
            $query = 'SELECT 
                id,
                quote
            FROM '
                . $this->table . 
            ' WHERE 
                id = ? LIMIT 0,1';

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
                    $this->quote = $row['quote'];
                    return true;
                } else {
                    return false;
                }
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Create Quotess
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . 
                $this->table. '
            SET
                quote = :quote';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->quote = htmlspecialchars(strip_tags($this->quote));

            // Bind Data
            $stmt->bindParam(':quote', $this->quote);

            // Execute query
            try {
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
            
        }

        // Update quote
        public function Update(){
            // Create query
            $query = 'UPDATE ' . 
                $this->table. '
            SET
                quote = :quote,
            WHERE
                id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
        
            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);

            try{
                $stmt->execute();
                return $stmt;
            } catch(PDOException $e) {
                echo json_encode(
                    array('message' => $e->getmessage()));                    
            } 
        }

        // Delete Quote
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
            
