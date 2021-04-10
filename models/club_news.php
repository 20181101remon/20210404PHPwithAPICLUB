<?php
    class club_news{
        // DB stuff
        private $conn;
        private $table1='club_news';
        private $table2='club_info';
        private $table3='news_type';
        private $table4='news_attend_file';
        
        public $flow_of_news;
        public $news_title;
        public $news_content;
        public $date;
        public $PLC;
        public $updateAt;
        public $news_id;
        public $club_id;
        public $news_pic;

        
        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
        }
        // Get Posts
        public function read(){
        $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.','.$this->table4.  
        ' WHERE '.$this->table1.'.`club_id`='.$this->table2.'.`club_id` 
        AND '.$this->table1.'.`news_id`='.$this->table3.'.`news_id`
        AND '.$this->table1.'.`flow_of_news`='.$this->table4.'.`flow_of_news`
        GROUP BY '.$this->table1.'.flow_of_news
        ORDER BY '.$this->table1.'.date';
            // Prepare statement
            $stmt=$this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }
        // get Single Post 

        public function read_single(){

            $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3. 
            ' WHERE '.$this->table1.'.`club_id`='.$this->table2.'.`club_id` 
            AND '.$this->table1.'.`news_id`='.$this->table3.'.`news_id`
            AND '.$this->table2.'.club_name = :id
            AND '.$this->table1.'.date = :date';
            
            $stmt=$this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(':id',$this->id);
            $stmt->bindParam(':date',$this->date);
            // Execute query
            $stmt->execute();

            $row= $stmt->fetch(PDO::FETCH_ASSOC);
            // Set 
            $this->date=$row['date'];
            $this->club_name=$row['club_name'];
            $this->news_title=$row['news_title'];
            $this->news_content=$row['news_content'];
        
        }

        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table1 .
            ' SET
                flow_of_news  = :flow_of_news,
                news_title = :news_title,
                news_content = :news_content,
                date = :date,
                PLC = :PLC,
                updateAt = :updateAt,
                news_id = :news_id,
                club_id = :club_id';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_news = htmlspecialchars(strip_tags($this -> flow_of_news));
            $this->news_title = htmlspecialchars(strip_tags($this -> news_title));
            $this->news_content = htmlspecialchars(strip_tags($this -> news_content));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->PLC = htmlspecialchars(strip_tags($this -> PLC));
            $this->updateAt = htmlspecialchars(strip_tags($this -> updateAt));
            $this->news_id = htmlspecialchars(strip_tags($this -> news_id));
            $this->club_id = htmlspecialchars(strip_tags($this -> club_id));
            

            // Bind data
            $stmt ->bindParam(':flow_of_news', $this->flow_of_news);
            $stmt ->bindParam(':news_title', $this->news_title);
            $stmt ->bindParam(':news_content', $this->news_content);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':PLC', $this->PLC);
            $stmt ->bindParam(':updateAt', $this->updateAt);
            $stmt ->bindParam(':news_id', $this->news_id);
            $stmt ->bindParam(':club_id', $this->club_id);
            // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
            

        }
        // Update Post
        public function update(){
            // Create query
            $query = 'UPDATE ' . $this->table1 .'
            SET
                news_title = :news_title,
                news_content = :news_content,
                date = :date,
                PLC = :PLC,
                updateAt = :updateAt,
                news_id = :news_id,
                club_id = :club_id
                WHERE flow_of_news = :flow_of_news';
            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_news = htmlspecialchars(strip_tags($this -> flow_of_news));
            $this->news_title = htmlspecialchars(strip_tags($this -> news_title));
            $this->news_content = htmlspecialchars(strip_tags($this -> news_content));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->PLC = htmlspecialchars(strip_tags($this -> PLC));
            $this->updateAt = htmlspecialchars(strip_tags($this -> updateAt));
            $this->news_id = htmlspecialchars(strip_tags($this -> news_id));
            $this->club_id = htmlspecialchars(strip_tags($this -> club_id));
            

            // Bind data
            $stmt ->bindParam(':flow_of_news', $this->flow_of_news);
            $stmt ->bindParam(':news_title', $this->news_title);
            $stmt ->bindParam(':news_content', $this->news_content);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':PLC', $this->PLC);
            $stmt ->bindParam(':updateAt', $this->updateAt);
            $stmt ->bindParam(':news_id', $this->news_id);
            $stmt ->bindParam(':club_id', $this->club_id);

            // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;

            }

        // Delete Post
        public function delete(){
            // Crete query
            $query='DELETE FROM ' . $this->table1 . ' WHERE flow_of_news = :flow_of_news';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);
              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> flow_of_news));
            // Bind data
            $stmt ->bindParam(':flow_of_news', $this->flow_of_news);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
