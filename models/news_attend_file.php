<?php
class news_attend_file
{
    // DB stuff
    private $conn;
    private $table1 = 'club_news';
    private $table2 = 'club_info';
    private $table3 = 'news_type';
    private $table4 = 'news_attend_file';

    public $flow_of_news;
    public $flow_of_file;
    public $news_pic;
    public $news_file;



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
            ' WHERE ' . $this->table1 . '.`club_id`=' . $this->table2 . '.`club_id` 
        AND ' . $this->table1 . '.`news_id`=' . $this->table3 . '.`news_id`
        AND ' . $this->table1 . '.`flow_of_news`=' . $this->table4 . '.`flow_of_news`
        AND ' . $this->table2 . '.club_name = :id
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
                flow_of_news  = :flow_of_news,
                flow_of_file  = :flow_of_file,
                news_pic = :news_pic,
                news_file = :news_file';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->flow_of_news = htmlspecialchars(strip_tags($this->flow_of_news));
        $this->flow_of_file = htmlspecialchars(strip_tags($this->flow_of_file));
        $this->news_pic = htmlspecialchars(strip_tags($this->news_pic));
        $this->news_file = htmlspecialchars(strip_tags($this->news_file));


        // Bind data
        $stmt->bindParam(':flow_of_news', $this->flow_of_news);
        $stmt->bindParam(':flow_of_file', $this->flow_of_file);
        $stmt->bindParam(':news_pic', $this->news_pic);
        $stmt->bindParam(':news_file', $this->news_file);

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
            flow_of_news  = :flow_of_news,
            news_pic = :news_pic,
            news_file = :news_file
            WHERE flow_of_file = :flow_of_file';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->flow_of_news = htmlspecialchars(strip_tags($this->flow_of_news));
        $this->flow_of_file = htmlspecialchars(strip_tags($this->flow_of_file));
        $this->news_pic = htmlspecialchars(strip_tags($this->news_pic));
        $this->news_file = htmlspecialchars(strip_tags($this->news_file));


        // Bind data
        $stmt->bindParam(':flow_of_news', $this->flow_of_news);
        $stmt->bindParam(':flow_of_file', $this->flow_of_file);
        $stmt->bindParam(':news_pic', $this->news_pic);
        $stmt->bindParam(':news_file', $this->news_file);


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
        $query = 'DELETE FROM ' . $this->table4 . ' WHERE  flow_of_file = :flow_of_file';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->flow_of_file));
        // Bind data
        $stmt->bindParam(':flow_of_file', $this->flow_of_file);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something gose wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
