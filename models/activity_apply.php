<?php
    class activity_apply{
        // DB stuff
        private $conn;
        private $table1='activity_apply';
        private $table2='club_semester';
        private $table3='club_info';
        
        public $club_name;
        public $flow_of_activity ;
        public $activity_name;
        public $date;
        public $activity_venue;
        public $activity_mainpoint;
        public $organizer;
        public $co_organizer;
        public $source_of_funding;
        public $contact_person;
        public $contact_tel;
        public $status_of_activity;
        public $review_note;
        public $club_semester;

        
        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
        }
        // Get Posts
        public function read(){
        $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.
        ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester`  
        AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`';
            // Prepare statement
            $stmt=$this->conn->prepare($query);
            // Execute query
            $stmt->execute();
            return $stmt;
        }


        public function read_single(){

            $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3. 
            ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester` 
            AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
            AND '.$this->table1.'.flow_of_activity = ?';
            
            $stmt=$this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt->execute();

            $row= $stmt->fetch(PDO::FETCH_ASSOC);
            // Set 
            $this->club_name=$row['club_name'];
            $this->activity_name=$row['activity_name'];
            $this->date=$row['date'];
            $this->activity_venue=$row['activity_venue'];
            $this->activity_mainpoint=$row['activity_mainpoint'];
            $this->organizer=$row['organizer'];
            $this->co_organizer=$row['co_organizer'];
            $this->source_of_funding=$row['source_of_funding'];
            $this->contact_person=$row['contact_person'];
            $this->contact_tel=$row['contact_tel'];
            $this->status_of_club=$row['status_of_club'];
            $this->status_of_activity=$row['status_of_activity'];
            $this->review_note=$row['review_note'];

        }

        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table1 .
            ' SET
                flow_of_activity = :flow_of_activity,
                activity_name = :activity_name,
                date = :date,
                activity_venue = :activity_venue,
                activity_mainpoint = :activity_mainpoint,
                organizer = :organizer,
                co_organizer = :co_organizer,
                source_of_funding = :source_of_funding,
                contact_person = :contact_person,
                contact_tel = :contact_tel,
                status_of_activity = :status_of_activity,
                review_note = :review_note,
                club_semester = :club_semester';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_activity = htmlspecialchars(strip_tags($this -> flow_of_activity));
            $this->activity_name = htmlspecialchars(strip_tags($this -> activity_name));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->activity_venue = htmlspecialchars(strip_tags($this -> activity_venue));
            $this->activity_mainpoint = htmlspecialchars(strip_tags($this -> activity_mainpoint));
            $this->organizer = htmlspecialchars(strip_tags($this -> organizer));
            $this->co_organizer = htmlspecialchars(strip_tags($this -> co_organizer));
            $this->source_of_funding = htmlspecialchars(strip_tags($this -> source_of_funding));
            $this->contact_person = htmlspecialchars(strip_tags($this -> contact_person));
            $this->contact_tel = htmlspecialchars(strip_tags($this -> contact_tel));
            $this->status_of_activity = htmlspecialchars(strip_tags($this -> status_of_activity));
            $this->review_note = htmlspecialchars(strip_tags($this -> review_note));
            $this->club_semester = htmlspecialchars(strip_tags($this -> club_semester));

            

            // Bind data
            $stmt ->bindParam(':flow_of_activity', $this->flow_of_activity);
            $stmt ->bindParam(':activity_name', $this->activity_name);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':activity_venue', $this->activity_venue);
            $stmt ->bindParam(':activity_mainpoint', $this->activity_mainpoint);
            $stmt ->bindParam(':organizer', $this->organizer);
            $stmt ->bindParam(':co_organizer', $this->co_organizer);
            $stmt ->bindParam(':source_of_funding', $this->source_of_funding);
            $stmt ->bindParam(':contact_person', $this->contact_person);
            $stmt ->bindParam(':contact_tel', $this->contact_tel);
            $stmt ->bindParam(':status_of_activity', $this->status_of_activity);
            $stmt ->bindParam(':review_note', $this->review_note);
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
            $query = 'UPDATE ' . $this->table1 .'
            SET
                activity_name = :activity_name,
                date = :date,
                activity_venue = :activity_venue,
                activity_mainpoint = :activity_mainpoint,
                organizer = :organizer,
                co_organizer = :co_organizer,
                source_of_funding = :source_of_funding,
                contact_person = :contact_person,
                contact_tel = :contact_tel,
                status_of_activity = :status_of_activity,
                review_note = :review_note,
                club_semester = :club_semester
                WHERE flow_of_activity = :flow_of_activity';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

             // Clean data
            $this->flow_of_activity = htmlspecialchars(strip_tags($this -> flow_of_activity));
            $this->activity_name = htmlspecialchars(strip_tags($this -> activity_name));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->activity_venue = htmlspecialchars(strip_tags($this -> activity_venue));
            $this->activity_mainpoint = htmlspecialchars(strip_tags($this -> activity_mainpoint));
            $this->organizer = htmlspecialchars(strip_tags($this -> organizer));
            $this->co_organizer = htmlspecialchars(strip_tags($this -> co_organizer));
            $this->source_of_funding = htmlspecialchars(strip_tags($this -> source_of_funding));
            $this->contact_person = htmlspecialchars(strip_tags($this -> contact_person));
            $this->contact_tel = htmlspecialchars(strip_tags($this -> contact_tel));
            $this->status_of_activity = htmlspecialchars(strip_tags($this -> status_of_activity));
            $this->review_note = htmlspecialchars(strip_tags($this -> review_note));
            $this->club_semester = htmlspecialchars(strip_tags($this -> club_semester));

            

            // Bind data
            $stmt ->bindParam(':flow_of_activity', $this->flow_of_activity);
            $stmt ->bindParam(':activity_name', $this->activity_name);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':activity_venue', $this->activity_venue);
            $stmt ->bindParam(':activity_mainpoint', $this->activity_mainpoint);
            $stmt ->bindParam(':organizer', $this->organizer);
            $stmt ->bindParam(':co_organizer', $this->co_organizer);
            $stmt ->bindParam(':source_of_funding', $this->source_of_funding);
            $stmt ->bindParam(':contact_person', $this->contact_person);
            $stmt ->bindParam(':contact_tel', $this->contact_tel);
            $stmt ->bindParam(':status_of_activity', $this->status_of_activity);
            $stmt ->bindParam(':review_note', $this->review_note);
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
            $query='DELETE FROM ' . $this->table1 . ' WHERE flow_of_activity = :flow_of_activity';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this -> flow_of_activity));
            // Bind data
            $stmt ->bindParam(':flow_of_activity', $this->flow_of_activity);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
