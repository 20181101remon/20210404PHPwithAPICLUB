<?php
    class club_feedback{
        // DB stuff
        private $conn;
        private $table1='club_feedback';
        private $table2='club_info';
        private $table3='feedback_type';
        
        public $flow_of_feedback ;
        public $content;
        public $club_id;
        public $feedback_id;

        
        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
        }
        // Get Posts
        // public function read(){
        // // $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.
        // // ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester`  
        // // AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
        // // AND `club_info`.`club_name`="昭凌戲劇社"';
        // $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.
        // ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester`  
        // AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
        // AND `club_info`.`club_name`="昭凌戲劇社"';
        //     // Prepare statement
        //     $stmt=$this->conn->prepare($query);
        //     // Execute query
        //     $stmt->execute();
        //     return $stmt;
        // }
        // get Single Post 

        public function read_single(){

            $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3. 
            ' WHERE '.$this->table1.'.`club_id`='.$this->table2.'.`club_id` 
            AND '.$this->table1.'.`feedback_id`='.$this->table3.'.`feedback_id`
            AND '.$this->table2.'.club_name = ?
            ORDER BY '.$this->table1.'.date';
            
            $stmt=$this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt->execute();
            return $stmt;
        }

        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table1 .
            ' SET
                flow_of_feedback  = :flow_of_feedback,
                content = :content,
                club_id = :club_id,
                feedback_id = :feedback_id';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_feedback = htmlspecialchars(strip_tags($this -> flow_of_feedback));
            // $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->content = htmlspecialchars(strip_tags($this -> content));
            $this->club_id = htmlspecialchars(strip_tags($this -> club_id));
            $this->feedback_id = htmlspecialchars(strip_tags($this -> feedback_id));

            

            // Bind data
            $stmt ->bindParam(':flow_of_feedback', $this->flow_of_feedback);
            // $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':content', $this->content);
            $stmt ->bindParam(':club_id', $this->club_id);
            $stmt ->bindParam(':feedback_id', $this->feedback_id);

            // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
            

        }
        // Update Post
        // public function update(){
        //     // Create query
        //     $query = 'UPDATE ' . $this->table1 .'
        //     SET
        //         date = :date,
        //         activity_name = :activity_name,
        //         club_semester = :club_semester
        //         WHERE flow_of_feedback = :flow_of_feedback';
        //     // Prepare statement
        //     $stmt = $this ->conn->prepare($query);

        //     // Clean data
        //     $this->flow_of_feedback = htmlspecialchars(strip_tags($this -> flow_of_feedback));
        //     $this->date = htmlspecialchars(strip_tags($this -> date));
        //     $this->activity_name = htmlspecialchars(strip_tags($this -> activity_name));
        //     $this->club_semester = htmlspecialchars(strip_tags($this -> club_semester));
            
        //     // Bind data
        //     $stmt ->bindParam(':flow_of_feedback', $this->flow_of_feedback);
        //     $stmt ->bindParam(':date', $this->date);
        //     $stmt ->bindParam(':activity_name', $this->activity_name);
        //     $stmt ->bindParam(':club_semester', $this->club_semester);

        //     // Execute query
        //     if($stmt->execute()){
        //         return true;
        //     }
        //     // Print error if something gose wrong
        //     printf("Error: %s.\n",$stmt->error);
        //         return false;

        //     }

        // Delete Post
        public function delete(){
            // Crete query
            $query='DELETE FROM ' . $this->table1 . ' WHERE flow_of_feedback = :flow_of_feedback';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);
              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> flow_of_feedback));
            // Bind data
            $stmt ->bindParam(':flow_of_feedback', $this->flow_of_feedback);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
