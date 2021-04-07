<?php
    class club_planofsemester{
        // DB stuff
        private $conn;
        private $table1='club_planofsemester';
        private $table2='club_semester';
        private $table3='club_info';
        
        public $user_id;
        public $user_password;
        public $user_name;
        public $user_sex;
        public $user_tel;
        public $user_mail;
        public $user_pic;
        public $create_at;
        public $update_at;

        public $club_id;
        public $club_name;
        public $club_type;
        public $club_website;
        public $club_purpose;
        public $club_icon;
        public $club_introduce;
        public $club_cover;
        public $club_place;
        public $club_time;
        public $source_of_funding;
        public $creatAt;
        public $updateAt;
        public $note;
        public $status_of_club;
        public $semester_id;
        public $club_fee;
        public $club_teacher;
        public $club_semester;
        
        public $date;
        public $activity_name;

        
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
            ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester` 
            AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
            AND '.$this->table3.'.club_name = ?
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
            ' SET flow_of_plan = :flow_of_plan,
                date = :date,
                activity_name = :activity_name,
                club_semester = :club_semester';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_plan = htmlspecialchars(strip_tags($this -> flow_of_plan));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->activity_name = htmlspecialchars(strip_tags($this -> activity_name));
            $this->club_semester = htmlspecialchars(strip_tags($this -> club_semester));

            

            // Bind data
            $stmt ->bindParam(':flow_of_plan', $this->flow_of_plan);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':activity_name', $this->activity_name);
            $stmt ->bindParam(':club_semester', $this->club_semester);

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
            $query='UPDATE ' . $this->table1 .'
            SET 
                
                user_password = :user_password,
                user_name = :user_name,
                user_sex = :user_sex,
                user_tel = :user_tel,
                WHERE user_id = :user_id';
            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->user_id = htmlspecialchars(strip_tags($this -> user_id));
            $this->user_password = htmlspecialchars(strip_tags($this -> user_password));
            $this->user_name = htmlspecialchars(strip_tags($this -> user_name));
            $this->user_sex = htmlspecialchars(strip_tags($this -> user_sex));
            $this->user_tel = htmlspecialchars(strip_tags($this -> user_tel));
            $this->user_mail = htmlspecialchars(strip_tags($this -> user_mail));

            
            // Bind data
            $stmt ->bindParam(':user_password', $this->user_password);
            $stmt ->bindParam(':user_name', $this->user_name);
            $stmt ->bindParam(':user_sex', $this->user_sex);
            $stmt ->bindParam(':user_tel', $this->user_tel);
            $stmt ->bindParam(':user_mail', $this->user_mail);
            $stmt ->bindParam(':user_id', $this->user_id);

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
            $query='DELETE FROM ' . $this->table1 . ' WHERE flow_of_plan = :flow_of_plan';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> flow_of_plan));
            // Bind data
            $stmt ->bindParam(':flow_of_plan', $this->flow_of_plan);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
