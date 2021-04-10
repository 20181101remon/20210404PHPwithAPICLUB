<?php
class semester
{
    // DB stuff
    private $conn;
    private $table = 'semester';

    // ALL  properties you needt to CRUD (include user_info and other )
    public $semester_id;
    public $semester;


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
                semester_id = :semester_id,
                semester = :semester';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->semester_id = htmlspecialchars(strip_tags($this->semester_id));
        $this->semester = htmlspecialchars(strip_tags($this->semester));

        // Bind data
        $stmt->bindParam(':semester_id', $this->semester_id);
        $stmt->bindParam(':semester', $this->semester);
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
                semester = :semester
                WHERE semester_id = :semester_id ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->semester_id = htmlspecialchars(strip_tags($this->semester_id));
        $this->semester = htmlspecialchars(strip_tags($this->semester));

        // Bind data
        $stmt->bindParam(':semester_id', $this->semester_id);
        $stmt->bindParam(':semester', $this->semester);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE semester_id = :semester_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->semester_id));
        // Bind data
        $stmt->bindParam(':semester_id', $this->semester_id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
