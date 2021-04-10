<?php
class club_semester
{
    // DB stuff
    private $conn;
    private $table1 = 'club_semester';


    public $club_semester;
    public $club_id;
    public $semester_id;
    public $club_fee;
    public $club_teacher;
    public $club_show_pic;




    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Get Posts
    // public function read(){
    // $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.
    // ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester`  
    // AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`';

    //     // Prepare statement
    //     $stmt=$this->conn->prepare($query);
    //     // Execute query
    //     $stmt->execute();
    //     return $stmt;
    // }
    // get Single Post 
    // public function read_single(){
    //     $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.
    //     ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester` 
    //     AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
    //     AND '.$this->table3.'.club_name = ?';

    //     $stmt=$this->conn->prepare($query);
    //     // Bind ID
    //     $stmt->bindParam(1,$this->id);
    //     // Execute query
    //     $stmt->execute();
    //     return $stmt;

    // }
    // Create Post
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table1 . ' 
            SET 
                club_semester = :club_semester,
                club_id = :club_id,
                semester_id = :semester_id,
                club_fee = :club_fee,
                club_teacher = :club_teacher,
                club_show_pic = :club_show_pic';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->club_semester = htmlspecialchars(strip_tags($this->club_semester));
        $this->club_id = htmlspecialchars(strip_tags($this->club_id));
        $this->semester_id = htmlspecialchars(strip_tags($this->semester_id));
        $this->club_fee = htmlspecialchars(strip_tags($this->club_fee));
        $this->club_teacher = htmlspecialchars(strip_tags($this->club_teacher));
        $this->club_show_pic = htmlspecialchars(strip_tags($this->club_show_pic));




        // Bind data
        $stmt->bindParam(':club_semester', $this->club_semester);
        $stmt->bindParam(':club_id', $this->club_id);
        $stmt->bindParam(':semester_id', $this->semester_id);
        $stmt->bindParam(':club_fee', $this->club_fee);
        $stmt->bindParam(':club_teacher', $this->club_teacher);
        $stmt->bindParam(':club_show_pic', $this->club_show_pic);


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
        $query = 'UPDATE ' . $this->table1 . '
            SET 
                club_id = :club_id,
                semester_id = :semester_id,
                club_fee = :club_fee,
                club_teacher = :club_teacher,
                club_show_pic = :club_show_pic
                WHERE club_semester = :club_semester';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->club_semester = htmlspecialchars(strip_tags($this->club_semester));
        $this->club_id = htmlspecialchars(strip_tags($this->club_id));
        $this->semester_id = htmlspecialchars(strip_tags($this->semester_id));
        $this->club_fee = htmlspecialchars(strip_tags($this->club_fee));
        $this->club_teacher = htmlspecialchars(strip_tags($this->club_teacher));
        $this->club_show_pic = htmlspecialchars(strip_tags($this->club_show_pic));




        // Bind data
        $stmt->bindParam(':club_semester', $this->club_semester);
        $stmt->bindParam(':club_id', $this->club_id);
        $stmt->bindParam(':semester_id', $this->semester_id);
        $stmt->bindParam(':club_fee', $this->club_fee);
        $stmt->bindParam(':club_teacher', $this->club_teacher);
        $stmt->bindParam(':club_show_pic', $this->club_show_pic);

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
        $query = 'DELETE FROM ' . $this->table1 . ' WHERE  club_semester = :club_semester';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->club_semester));
        // Bind data
        $stmt->bindParam(':club_semester', $this->club_semester);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
