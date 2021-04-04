<?php
    class User_info{
        // DB stuff
        private $conn;
        private $table='user_info';
        
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
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;
        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
        }
        // Get Posts
        public function read(){
        $query = 'SELECT * FROM ' . $this -> table;
            // Prepare statement
            $stmt=$this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }
        // get Single Post 
        public function read_single(){
            $query = 'SELECT *
            FROM ' . $this->table . ' 
            WHERE 
            user_id = ?
            LIMIT 0,1';
            // Prepare statement
            $stmt=$this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1,$this->id);
            // Execute query
            $stmt->execute();
            $row= $stmt->fetch(PDO::FETCH_ASSOC);
            // Set 
            $this->user_id=$row['user_id'];
            $this->user_password=$row['user_password'];
            $this->user_name=$row['user_name'];
            $this->user_sex=$row['user_sex'];
            $this->user_tel=$row['user_tel'];
            $this->user_mail=$row['user_mail'];
        }

        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table .' 
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
            $query='UPDATE ' . $this->table .'
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
            $query='DELETE FROM ' . $this->table . ' WHERE user_id = :user_id';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> user_id));
            // Bind data
            $stmt ->bindParam(':user_id', $this->user_id);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
