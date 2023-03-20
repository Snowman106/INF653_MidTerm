<?php 
    class Quote {

        // DB stuff
        private $conn;
        private $table = 'quotes';

        // Quotes Properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;
        public $author;
        public $category;

        // Construct with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Quotes
        public function read(){
            
            // Create Query
            $query = 'SELECT 
                c.category AS category, 
                q.id, 
                q.category_id, 
                a.author AS author,
                q.author_id,
                q.quote
            FROM 
                ' . $this->table . ' q
            LEFT JOIN 
                categories c ON q.category_id = c.id
            LEFT JOIN 
                authors a ON q.author_id = a.id
            ORDER BY 
                q.id';
             
                 
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
                c.category AS category, 
                q.id, 
                q.category_id, 
                a.author AS author, 
                q.author_id, 
                q.quote 
            FROM 
                ' . $this->table . ' q 
            LEFT JOIN 
                categories c ON q.category_id = c.id 
            LEFT JOIN 
                authors a ON q.author_id = a.id 
            WHERE 
                q.id = ? 
            LIMIT 1 OFFSET 0';

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
                    $this->author = $row['author'];
                    $this->category = $row['category'];
                    return true;
                } else {
                    return false;
                }
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Get Single author
        public function read_author(){
            // Create Query
            $query = 'SELECT 
                c.category AS category, 
                q.id, 
                q.category_id, 
                a.author AS author, 
                q.author_id, 
                q.quote 
            FROM 
                ' . $this->table . ' q 
            LEFT JOIN 
                categories c ON q.category_id = c.id 
            LEFT JOIN 
                authors a ON q.author_id = a.id 
            WHERE 
                q.author_id = ?';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->author_id);            

            try{
                // Execute query
                $stmt->execute();
                return $stmt;
                
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Get Single category
        public function read_category(){
            // Create Query
            $query = 'SELECT 
                c.category AS category, 
                q.id, 
                q.category_id, 
                a.author AS author, 
                q.author_id, 
                q.quote 
            FROM 
                ' . $this->table . ' q 
            LEFT JOIN 
                categories c ON q.category_id = c.id 
            LEFT JOIN 
                authors a ON q.author_id = a.id 
            WHERE 
                q.category_id = ?';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->category_id);

            try{
                // Execute query
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Get Author and Category
        
        public function read_authorAndCategory(){
            // Create Query
            $query = 'SELECT 
                c.category AS category, 
                q.id, 
                q.category_id, 
                a.author AS author, 
                q.author_id, 
                q.quote 
            FROM 
                ' . $this->table . ' q 
            LEFT JOIN 
                categories c ON q.category_id = c.id 
            LEFT JOIN 
                authors a ON q.author_id = a.id 
            WHERE 
                q.author_id = ? 
            AND 
                q.category_id = ?';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind IDs
            $stmt->bindParam(1, $this->author_id);
            $stmt->bindParam(2, $this->category_id);

            try{
                // Execute query
                $stmt->execute();
                return $stmt;
                
            }catch(PDOException $e) {
                echo json_encode(array('message' => $e->getmessage()));
            }
        }

        // Create Quotes
        public function create(){
            // Create query
            $query = 'INSERT INTO ' . $this->table . 
                ' (quote, author_id, category_id) 
            VALUES 
                (:quote, :author_id, :category_id)';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind Data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

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
            $query = 'UPDATE ' . $this->table. ' 
            SET 
                quote = :quote, 
                author_id = :author_id,
                category_id = :category_id
            WHERE 
                id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);
            

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
            
