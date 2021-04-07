<?php
    class club_info{
        // DB stuff
        private $conn;
        private $table1='club_info';
        private $table2='club_semester';
        

        // Table1 Properties
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
        // Table2 Properties
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
                club_id = :club_id,
                club_name = :club_name,
                club_type = :club_type,
                club_website = :club_website,
                club_purpose = :club_purpose,
                club_icon = :club_icon,
                club_introduce = :club_introduce,
                club_cover = :club_cover,
                club_place = :club_place,
                club_time = :club_time,
                source_of_funding = :source_of_funding,
                status_of_club = :status_of_club'
                ;

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->club_id = htmlspecialchars(strip_tags($this -> club_id));
            $this->club_name = htmlspecialchars(strip_tags($this -> club_name));
            $this->club_type = htmlspecialchars(strip_tags($this -> club_type));
            $this->club_website = htmlspecialchars(strip_tags($this -> club_website));
            $this->club_purpose = htmlspecialchars(strip_tags($this -> club_purpose));
            $this->club_icon = htmlspecialchars(strip_tags($this -> club_icon));
            $this->club_introduce = htmlspecialchars(strip_tags($this -> club_introduce));
            $this->club_cover = htmlspecialchars(strip_tags($this -> club_cover));
            $this->club_place = htmlspecialchars(strip_tags($this -> club_place));
            $this->club_time = htmlspecialchars(strip_tags($this -> club_time));
            $this->source_of_funding = htmlspecialchars(strip_tags($this -> source_of_funding));
            $this->status_of_club = htmlspecialchars(strip_tags($this -> status_of_club));
            

            // Bind data
            $stmt ->bindParam(':club_id', $this->club_id);
            $stmt ->bindParam(':club_name', $this->club_name);
            $stmt ->bindParam(':club_type', $this->club_type);
            $stmt ->bindParam(':club_website', $this->club_website);
            $stmt ->bindParam(':club_purpose', $this->club_purpose);
            $stmt ->bindParam(':club_icon', $this->club_icon);
            $stmt ->bindParam(':club_introduce', $this->club_introduce);
            $stmt ->bindParam(':club_cover', $this->club_cover);
            $stmt ->bindParam(':club_place', $this->club_place);
            $stmt ->bindParam(':club_time', $this->club_time);
            $stmt ->bindParam(':source_of_funding', $this->source_of_funding);
            $stmt ->bindParam(':status_of_club', $this->status_of_club);

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
                
                club_name = :club_name,
                club_type = :club_type,
                club_website = :club_website,
                club_purpose = :club_purpose,
                club_icon = :club_icon,
                club_introduce = :club_introduce,
                club_cover = :club_cover,
                club_place = :club_place,
                club_time = :club_time,
                source_of_funding = :source_of_funding,
                status_of_club = :status_of_club
                WHERE club_id = :club_id';
            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->club_id = htmlspecialchars(strip_tags($this -> club_id));
            $this->club_name = htmlspecialchars(strip_tags($this -> club_name));
            $this->club_type = htmlspecialchars(strip_tags($this -> club_type));
            $this->club_website = htmlspecialchars(strip_tags($this -> club_website));
            $this->club_purpose = htmlspecialchars(strip_tags($this -> club_purpose));
            $this->club_icon = htmlspecialchars(strip_tags($this -> club_icon));
            $this->club_introduce = htmlspecialchars(strip_tags($this -> club_introduce));
            $this->club_cover = htmlspecialchars(strip_tags($this -> club_cover));
            $this->club_place = htmlspecialchars(strip_tags($this -> club_place));
            $this->club_time = htmlspecialchars(strip_tags($this -> club_time));
            $this->source_of_funding = htmlspecialchars(strip_tags($this -> source_of_funding));
            $this->status_of_club = htmlspecialchars(strip_tags($this -> status_of_club));
            

            // Bind data
            $stmt ->bindParam(':club_id', $this->club_id);
            $stmt ->bindParam(':club_name', $this->club_name);
            $stmt ->bindParam(':club_type', $this->club_type);
            $stmt ->bindParam(':club_website', $this->club_website);
            $stmt ->bindParam(':club_purpose', $this->club_purpose);
            $stmt ->bindParam(':club_icon', $this->club_icon);
            $stmt ->bindParam(':club_introduce', $this->club_introduce);
            $stmt ->bindParam(':club_cover', $this->club_cover);
            $stmt ->bindParam(':club_place', $this->club_place);
            $stmt ->bindParam(':club_time', $this->club_time);
            $stmt ->bindParam(':source_of_funding', $this->source_of_funding);
            $stmt ->bindParam(':status_of_club', $this->status_of_club);

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
            $query='DELETE FROM ' . $this->table1 . ' WHERE club_id = :club_id';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> club_id));
            // Bind data
            $stmt ->bindParam(':club_id', $this->club_id);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
