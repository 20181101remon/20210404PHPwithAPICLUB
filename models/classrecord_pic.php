<?php
class classrecord_pic
{
    // DB stuff
    private $conn;
    private $table1 = 'club_classrecord';
    private $table2 = 'club_semester';
    private $table3 = 'club_info';
    private $table4 = 'classrecord_pic';

    public $flow_of_pic;
    public $pic;
    public $flow_of_classrecord;


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
        $query = 'SELECT * FROM ' . $this->table1 . ',' . $this->table2 . ',' . $this->table3 . ',' . $this->table4 .
            ' WHERE ' . $this->table1 . '.`club_semester`=' . $this->table2 . '.`club_semester` 
        AND ' . $this->table2 . '.`club_id`=' . $this->table3 . '.`club_id`
        AND ' . $this->table4 . '.`flow_of_classrecord`=' . $this->table1 . '.`flow_of_classrecord`
        AND ' . $this->table3 . '.club_name = :id
        AND ' . $this->table1 . '.date = :date';

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
        $query = 'INSERT INTO ' . $this->table4 . ' 
            SET 
                flow_of_pic  = :flow_of_pic,
                pic = :pic,
                flow_of_classrecord = :flow_of_classrecord';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->flow_of_pic = htmlspecialchars(strip_tags($this->flow_of_pic));
        $this->pic = htmlspecialchars(strip_tags($this->pic));
        $this->flow_of_classrecord = htmlspecialchars(strip_tags($this->flow_of_classrecord));


        // Bind data
        $stmt->bindParam(':flow_of_pic', $this->flow_of_pic);
        $stmt->bindParam(':pic', $this->pic);
        $stmt->bindParam(':flow_of_classrecord', $this->flow_of_classrecord);

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
        $query = 'UPDATE ' . $this->table4 . '
            SET 
            pic = :pic,
            flow_of_classrecord = :flow_of_classrecord
            WHERE flow_of_pic = :flow_of_pic';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->flow_of_pic = htmlspecialchars(strip_tags($this->flow_of_pic));
        $this->pic = htmlspecialchars(strip_tags($this->pic));
        $this->flow_of_classrecord = htmlspecialchars(strip_tags($this->flow_of_classrecord));


        // Bind data
        $stmt->bindParam(':flow_of_pic', $this->flow_of_pic);
        $stmt->bindParam(':pic', $this->pic);
        $stmt->bindParam(':flow_of_classrecord', $this->flow_of_classrecord);

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
        $query = 'DELETE FROM ' . $this->table4 . ' WHERE  flow_of_pic = :flow_of_pic';
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
