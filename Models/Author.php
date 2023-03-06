<?php 
  class Author {
    // DB stuff
    private $conn;
    private $table = 'author';

    // Author Properties
    public $id;
    public $author;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


        // Get authors
        public function read(){
            // Create Query
            $query = 'SELECT 
                id, 
                author,
            FROM 
                ' . $this->table . ' 
            ORDER BY
                p.created_at DESC';

            // Prepared Statements
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // // Get Single authors
        // public function read_single(){
        //     // Create Query
        //     $query = 'SELECT 
        //         c.name as category_name, 
        //         p.id, 
        //         p.category_id, 
        //         p.title, 
        //         p.body, 
        //         p.author, 
        //         p.created_at
        //     FROM 
        //         ' . $this->table . ' p
        //     LEFT JOIN
        //         categories c ON p.category_id = c.id
        //     WHERE 
        //         p.id = ?
        //     LIMIT 0,1';

        //     // Prepare Statement
        //     $stmt = $this->conn->prepare($query);

        //     // Bind ID
        //     $stmt->bindParam(1, $this->id);

        //     // Execute query
        //     $stmt->execute();

        //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //     // Set Properties
        //     $this->title = $row['title'];
        //     $this->body = $row['body'];
        //     $this->author = $row['author'];
        //     $this->category_id = $row['category_id'];
        //     $this->category_name = $row['category_name'];
        // }

        // // Create authors
        // public function create(){
        //     // Create query
        //     $query = 'INSERT INTO ' . 
        //         $this->table. '
        //     SET
        //         title = :title,
        //         body = :body,
        //         author = :author,
        //         category_id = :category_id';

        //     // Prepare Statement
        //     $stmt = $this->conn->prepare($query);

        //     // Clean Data
        //     $this->title = htmlspecialchars(strip_tags($this->title));
        //     $this->body = htmlspecialchars(strip_tags($this->body));
        //     $this->author = htmlspecialchars(strip_tags($this->author));
        //     $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //     // Bind Data
        //     $stmt->bindParam(':title', $this->title);
        //     $stmt->bindParam(':body', $this->body);
        //     $stmt->bindParam(':author', $this->author);
        //     $stmt->bindParam(':category_id', $this->category_id);

        //     // Execute query
        //     if($stmt->execute()){
        //         return true;
        //     }

        //     // Print error if something goes wrong
        //     printf("Error: %s.\n", $stmt->error);

        //     return false;

        // }

        // // Update Post
        // public function Update(){
        //     // Create query
        //     $query = 'UPDATE ' . 
        //         $this->table. '
        //     SET
        //         title = :title,
        //         body = :body,
        //         author = :author,
        //         category_id = :category_id
        //     WHERE
        //         id = :id';

        //     // Prepare Statement
        //     $stmt = $this->conn->prepare($query);

        //     // Clean Data
        //     $this->title = htmlspecialchars(strip_tags($this->title));
        //     $this->body = htmlspecialchars(strip_tags($this->body));
        //     $this->author = htmlspecialchars(strip_tags($this->author));
        //     $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        //     $this->id = htmlspecialchars(strip_tags($this->id));


        //     // Bind Data
        //     $stmt->bindParam(':title', $this->title);
        //     $stmt->bindParam(':body', $this->body);
        //     $stmt->bindParam(':author', $this->author);
        //     $stmt->bindParam(':category_id', $this->category_id);
        //     $stmt->bindParam(':id', $this->id);

        //     // Execute query
        //     if($stmt->execute()){
        //         return true;
        //     }

        //     // Print error if something goes wrong
        //     printf("Error: %s.\n", $stmt->error);

        //     return false;

        // }

        // // Delete Post
        // public function delete(){
        //     // Create query
        //     $query = 'DELETE FROM ' . $this->table. ' WHERE id = :id';

        //     // Prepare Statement
        //     $stmt = $this->conn->prepare($query);

        //     // Clean Data
        //     $this->id = htmlspecialchars(strip_tags($this->id));

        //     // Bind Date 
        //     $stmt->bindParam(':id', $this->id);


        //     // Execute query
        //     if($stmt->execute()){
        //         return true;
        //     }

        //     // Print error if something goes wrong
        //     printf("Error: %s.\n", $stmt->error);

        //     return false;
        // }

    }