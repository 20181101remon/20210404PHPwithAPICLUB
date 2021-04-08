<?php
    class club_classrecord{
        // DB stuff
        private $conn;
        private $table1='club_classrecord';
        private $table2='club_semester';
        private $table3='club_info';
        private $table4='classrecord_pic';

        public $flow_of_classrecord;
        public $date;
        public $class_name;
        public $class_teacher;
        public $class_place;
        public $class_contect;
        public $createAt;
        public $updateAt;
        public $PLC;
        public $club_semester;
        public $pic;
        
        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
        }
        // Get Posts
        public function read(){
        $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.','.$this->table4. 
        ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester` 
        AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
        AND '.$this->table4.'.`flow_of_classrecord`='.$this->table1.'.`flow_of_classrecord`
        AND '.$this->table3.'.club_name = ?
        GROUP BY '.$this->table1.'.`flow_of_classrecord`
        ORDER BY '.$this->table1.'.date
        ';
            // Prepare statement
            $stmt=$this->conn->prepare($query);
              // Bind ID
            $stmt->bindParam(1,$this->id);
            // Execute query
            $stmt->execute();
            return $stmt;
        }
        // get Single Post 
        public function read_single(){
            $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.','.$this->table4. 
            ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester` 
            AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
            AND '.$this->table4.'.`flow_of_classrecord`='.$this->table1.'.`flow_of_classrecord`
            AND '.$this->table1.'.date = ?';
            
            $stmt=$this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1,$this->id);
            $stmt->bindParam(1,$this->date);
            // Execute query
            $stmt->execute();

            $row= $stmt->fetch(PDO::FETCH_ASSOC);
            // Set 
            $this->date=$row['date'];
            $this->club_name=$row['club_name'];
            $this->club_teacher=$row['club_teacher'];
            $this->class_place=$row['class_place'];
            $this->	class_contect=$row['class_contect'];
            $this->	pic=$row['pic'];

        }
        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table1 .' 
            SET 
                flow_of_classrecord  = :flow_of_classrecord,
                date = :date,
                class_name = :class_name,
                class_teacher = :class_teacher,
                class_place = :class_place,
                class_contect = :class_contect,
                PLC = :PLC,
                club_semester  = :club_semester';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_classrecord = htmlspecialchars(strip_tags($this -> flow_of_classrecord));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->class_name = htmlspecialchars(strip_tags($this -> class_name));
            $this->class_teacher = htmlspecialchars(strip_tags($this -> class_teacher));
            $this->class_place = htmlspecialchars(strip_tags($this -> class_place));
            $this->class_contect = htmlspecialchars(strip_tags($this -> class_contect));
            $this->PLC = htmlspecialchars(strip_tags($this -> PLC));
            $this->club_semester = htmlspecialchars(strip_tags($this -> club_semester));


            // Bind data
            $stmt ->bindParam(':flow_of_classrecord', $this->flow_of_classrecord);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':class_name', $this->class_name);
            $stmt ->bindParam(':class_teacher', $this->class_teacher);
            $stmt ->bindParam(':class_place', $this->class_place);
            $stmt ->bindParam(':class_contect', $this->class_contect);

            $stmt ->bindParam(':PLC', $this->PLC);
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

                date = :date,
                class_name = :class_name,
                class_teacher = :class_teacher,
                class_place = :class_place,
                class_contect = :class_contect,
                PLC = :PLC,
                updateAt= :updateAt,
                club_semester  = :club_semester
                WHERE flow_of_classrecord  = :flow_of_classrecord ';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_classrecord = htmlspecialchars(strip_tags($this -> flow_of_classrecord));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->class_name = htmlspecialchars(strip_tags($this -> class_name));
            $this->class_teacher = htmlspecialchars(strip_tags($this -> class_teacher));
            $this->class_place = htmlspecialchars(strip_tags($this -> class_place));
            $this->class_contect = htmlspecialchars(strip_tags($this -> class_contect));
            $this->updateAt = htmlspecialchars(strip_tags($this -> updateAt));
            $this->PLC = htmlspecialchars(strip_tags($this -> PLC));
            $this->club_semester = htmlspecialchars(strip_tags($this -> club_semester));


            // Bind data
            $stmt ->bindParam(':flow_of_classrecord', $this->flow_of_classrecord);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':class_name', $this->class_name);
            $stmt ->bindParam(':class_teacher', $this->class_teacher);
            $stmt ->bindParam(':class_place', $this->class_place);
            $stmt ->bindParam(':class_contect', $this->class_contect);
            $stmt ->bindParam(':updateAt', $this->updateAt);
            $stmt ->bindParam(':PLC', $this->PLC);
            $stmt ->bindParam(':club_semester', $this->club_semester);
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
            $query='DELETE FROM ' . $this->table1 . ' WHERE  flow_of_classrecord = :flow_of_classrecord';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this ->flow_of_classrecord));
            // Bind data
            $stmt ->bindParam(':flow_of_classrecord', $this->flow_of_classrecord);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
