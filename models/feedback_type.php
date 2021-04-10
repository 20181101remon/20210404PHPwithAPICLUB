<?php
class feedback_type
{
    // DB stuff
    private $conn;
    private $table = 'feedback_type';

    // ALL  properties you needt to CRUD (include user_info and other )
    public $feedback_id;
    public $feedback_name;


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
                feedback_id = :feedback_id,
                feedback_name = :feedback_name';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->feedback_id = htmlspecialchars(strip_tags($this->feedback_id));
        $this->feedback_name = htmlspecialchars(strip_tags($this->feedback_name));

        // Bind data
        $stmt->bindParam(':feedback_id', $this->feedback_id);
        $stmt->bindParam(':feedback_name', $this->feedback_name);
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
                feedback_name = :feedback_name
                WHERE feedback_id = :feedback_id ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->feedback_id = htmlspecialchars(strip_tags($this->feedback_id));
        $this->feedback_name = htmlspecialchars(strip_tags($this->feedback_name));

        // Bind data
        $stmt->bindParam(':feedback_id', $this->feedback_id);
        $stmt->bindParam(':feedback_name', $this->feedback_name);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE feedback_id = :feedback_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->feedback_id));
        // Bind data
        $stmt->bindParam(':feedback_id', $this->feedback_id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
