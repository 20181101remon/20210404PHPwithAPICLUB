<?php
class news_type
{
    // DB stuff
    private $conn;
    private $table = 'news_type';

    // ALL  properties you needt to CRUD (include user_info and other )
    public $news_id;
    public $news_name;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Get user_info
    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();
        return $stmt;
    }
    // get Single Post 
    // public function read_single()
    // {
    //     $query = 'SELECT *
    //         FROM ' . $this->table . ' 
    //         WHERE 
    //         user_id = ?
    //         LIMIT 0,1';
    //     // Prepare statement
    //     $stmt = $this->conn->prepare($query);
    //     // Bind ID
    //     $stmt->bindParam(1, $this->id);
    //     // Execute query
    //     $stmt->execute();
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     // Set 
    //     $this->user_id = $row['user_id'];
    //     $this->user_password = $row['user_password'];
    //     $this->user_name = $row['user_name'];
    //     $this->user_sex = $row['user_sex'];
    //     $this->user_tel = $row['user_tel'];
    //     $this->user_mail = $row['user_mail'];
    // }
    // Create Post
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET 
                news_id = :news_id,
                news_name = :news_name';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->news_id = htmlspecialchars(strip_tags($this->news_id));
        $this->news_name = htmlspecialchars(strip_tags($this->news_name));

        // Bind data
        $stmt->bindParam(':news_id', $this->news_id);
        $stmt->bindParam(':news_name', $this->news_name);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    // Update Post
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
            SET 
                news_name = :news_name
                WHERE news_id = :news_id ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->news_id = htmlspecialchars(strip_tags($this->news_id));
        $this->news_name = htmlspecialchars(strip_tags($this->news_name));

        // Bind data
        $stmt->bindParam(':news_id', $this->news_id);
        $stmt->bindParam(':news_name', $this->news_name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // Delete Post
    public function delete()
    {
        // Crete query
        $query = 'DELETE FROM ' . $this->table . ' WHERE news_id = :news_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->news_id));
        // Bind data
        $stmt->bindParam(':news_id', $this->news_id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
