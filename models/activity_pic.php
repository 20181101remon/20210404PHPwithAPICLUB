<?php
class activity_pic
{
    // DB stuff
    private $conn;
    private $table1 = 'activity_results';
    private $table2 = 'activity_apply';
    private $table3 = 'club_semester';
    private $table4 = 'club_info';
    private $table5 = 'activity_pic';

    public $flow_of_pic;
    public $result_pic;
    public $flow_result_activity;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Get Posts
    // public function read()
    // {

    //     $query = 'SELECT * FROM ' . $this->table1 . ',' . $this->table2 . ',' . $this->table3 . ',' . $this->table4 . ',' . $this->table5 .
    //         ' WHERE ' . $this->table2 . '.`club_semester`=' . $this->table3 . '.`club_semester` 
    //     AND ' . $this->table1 . '.`flow_of_activity`=' . $this->table2 . '.`flow_of_activity`
    //     AND ' . $this->table3 . '.`club_id`=' . $this->table4 . '.`club_id`
    //     AND ' . $this->table5 . '.`flow_result_activity`=' . $this->table1 . '.`flow_result_activity`
    //     AND ' . $this->table4 . '.club_name = ?
    //     GROUP BY ' . $this->table1 . '.`flow_result_activity`';
    //     // Prepare statement
    //     $stmt = $this->conn->prepare($query);
    //     // Bind ID
    //     $stmt->bindParam(1, $this->id);
    //     // Execute query
    //     $stmt->execute();
    //     return $stmt;
    // }
    // get Single Post 
    public function read_single()
    {
        $query = 'SELECT * FROM ' . $this->table1 . ',' . $this->table2 . ',' . $this->table3 . ',' . $this->table4 . ',' . $this->table5 .
            ' WHERE ' . $this->table2 . '.`club_semester`=' . $this->table3 . '.`club_semester` 
            AND ' . $this->table1 . '.`flow_of_activity`=' . $this->table2 . '.`flow_of_activity`
            AND ' . $this->table3 . '.`club_id`=' . $this->table4 . '.`club_id`
            AND ' . $this->table5 . '.`flow_result_activity`=' . $this->table1 . '.`flow_result_activity`
            AND ' . $this->table4 . '.club_name = :id
            AND ' . $this->table2 . '.date = :date';

        $stmt = $this->conn->prepare($query);
        // Bind ID
        $stmt->bindParam('id', $this->id);
        $stmt->bindParam('date', $this->date);
        // Execute query
        $stmt->execute();
        return $stmt;
    }
    // Create Post
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table5 . ' 
            SET 
                flow_of_pic  = :flow_of_pic,
                result_pic = :result_pic,
                flow_result_activity = :flow_result_activity';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->flow_of_pic = htmlspecialchars(strip_tags($this->flow_of_pic));
        $this->result_pic = htmlspecialchars(strip_tags($this->result_pic));
        $this->flow_result_activity = htmlspecialchars(strip_tags($this->flow_result_activity));


        // Bind data
        $stmt->bindParam(':flow_of_pic', $this->flow_of_pic);
        $stmt->bindParam(':result_pic', $this->result_pic);
        $stmt->bindParam(':flow_result_activity', $this->flow_result_activity);

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
        $query = 'UPDATE ' . $this->table5 . '
            SET 
            result_pic = :result_pic,
            flow_result_activity = :flow_result_activity
            WHERE flow_of_pic = :flow_of_pic';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->flow_of_pic = htmlspecialchars(strip_tags($this->flow_of_pic));
        $this->result_pic = htmlspecialchars(strip_tags($this->result_pic));
        $this->flow_result_activity = htmlspecialchars(strip_tags($this->flow_result_activity));


        // Bind data
        $stmt->bindParam(':flow_of_pic', $this->flow_of_pic);
        $stmt->bindParam(':result_pic', $this->result_pic);
        $stmt->bindParam(':flow_result_activity', $this->flow_result_activity);

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
        $query = 'DELETE FROM ' . $this->table5 . ' WHERE  flow_of_pic = :flow_of_pic';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->flow_of_pic));
        // Bind data
        $stmt->bindParam(':flow_of_pic', $this->flow_of_pic);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
