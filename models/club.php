<?php
    class club_info{
        // DB stuff
        private $conn;
        private $table1='club_info';
        private $table2='club_semester';
        
        public $user_id;
        public $user_password;
        public $user_name;
        public $user_sex;
        public $user_tel;
        public $user_mail;
        public $user_pic;
        public $create_at;
        public $update_at;
        // Post Properties

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
        public $club_show_pic;
        


        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
        }
        // Get Posts
        public function read(){
        $query = 'SELECT *
        FROM '.$this->table1.','. $this->table2.
        ' WHERE '.$this->table1 . '.' . '`club_id`'.' = '.$this->table2.'.`club_id`';
            // Prepare statement
            $stmt=$this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }
        // get Single Post 
        public function read_single(){

        //    $query = 'SELECT *
        //     FROM ' . $this->table1 . ' 
        //     WHERE 
        //     club_name = ?
        //     LIMIT 0,1';

            $query = 'SELECT *
            FROM '.$this->table1.','. $this->table2.
            ' WHERE '.$this->table1 . '.' . '`club_id`'.' = '.$this->table2.'.`club_id` AND '. 
            $this->table1.'.club_name = ?
            LIMIT 0,1';
            
            $stmt=$this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1,$this->id);
            // Execute query
            $stmt->execute();
            $row= $stmt->fetch(PDO::FETCH_ASSOC);
            // Set 
            $this->club_name=$row['club_name'];
            $this->club_type=$row['club_type'];
            $this->club_website=$row['club_website'];
            $this->club_purpose=$row['club_purpose'];
            $this->club_icon=$row['club_icon'];
            $this->club_introduce=$row['club_introduce'];
            $this->club_cover=$row['club_cover'];
            $this->club_place=$row['club_place'];
            $this->club_time=$row['club_time'];
            $this->status_of_club=$row['status_of_club'];
            $this->club_fee=$row['club_fee'];
            $this->club_teacher=$row['club_teacher'];
            $this->club_show_pic=$row['club_show_pic'];
        }

        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table1 .' 
            SET 
                user_id = :user_id,
                user_password = :user_password,
                user_name = :user_name,
                user_sex = :user_sex,
                user_tel = :user_tel,
                user_mail = :user_mail,
                user_pic = :user_pic';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->user_id = htmlspecialchars(strip_tags($this -> user_id));
            $this->user_password = htmlspecialchars(strip_tags($this -> user_password));
            $this->user_name = htmlspecialchars(strip_tags($this -> user_name));
            $this->user_sex = htmlspecialchars(strip_tags($this -> user_sex));
            $this->user_tel = htmlspecialchars(strip_tags($this -> user_tel));
            $this->user_mail = htmlspecialchars(strip_tags($this -> user_mail));
            $this->user_pic = htmlspecialchars(strip_tags($this -> user_pic));
            

            // Bind data
            $stmt ->bindParam(':user_id', $this->user_id);
            $stmt ->bindParam(':user_password', $this->user_password);
            $stmt ->bindParam(':user_name', $this->user_name);
            $stmt ->bindParam(':user_sex', $this->user_sex);
            $stmt ->bindParam(':user_tel', $this->user_tel);
            $stmt ->bindParam(':user_mail', $this->user_mail);
            $stmt ->bindParam(':user_pic', $this->user_pic);
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
            $query='DELETE FROM ' . $this->table1 . ' WHERE club_name = :club_name';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> club_name));
            // Bind data
            $stmt ->bindParam(':club_name', $this->club_name);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
