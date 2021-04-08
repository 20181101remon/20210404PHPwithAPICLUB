<?php
    class financialtable{
        // DB stuff
        private $conn;
        private $table1='financialtable';
        private $table2='club_semester';
        private $table3='club_info';
        
        public $flow_of_financercord;
        public $date;
        public $club_semester;
        public $finance_summary;
        public $finance_note;
        public $finance_income;
        public $finance_expenditure;
        public $finance_balance;


        
        // Constructor with DB
        public function __construct($db)
        {
            $this->conn=$db;
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
        public function read_single(){
            $query = 'SELECT * FROM '.$this->table1.','.$this->table2.','.$this->table3.
            ' WHERE '.$this->table1.'.`club_semester`='.$this->table2.'.`club_semester` 
            AND '.$this->table2.'.`club_id`='.$this->table3.'.`club_id`
            AND '.$this->table3.'.club_name = ?';
            
            $stmt=$this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1,$this->id);
            // Execute query
            $stmt->execute();
            return $stmt;

        }
        // Create Post
        public function create(){
            // Create query
            $query='INSERT INTO ' . $this->table1 .' 
            SET 
                flow_of_financercord = :flow_of_financercord,
                date = :date,
                finance_summary = :finance_summary,
                finance_note = :finance_note,
                finance_income = :finance_income,
                finance_expenditure = :finance_expenditure,
                finance_balance = :finance_balance,
                club_semester = :club_semester';

            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_financercord = htmlspecialchars(strip_tags($this -> flow_of_financercord));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->finance_summary = htmlspecialchars(strip_tags($this -> finance_summary));
            $this->finance_note = htmlspecialchars(strip_tags($this -> finance_note));
            $this->finance_income = htmlspecialchars(strip_tags($this -> finance_income));
            $this->finance_expenditure = htmlspecialchars(strip_tags($this -> finance_expenditure));
            $this->finance_balance = htmlspecialchars(strip_tags($this -> finance_balance));
            $this->club_semester  = htmlspecialchars(strip_tags($this -> club_semester ));

            

            // Bind data
            $stmt ->bindParam(':flow_of_financercord', $this->flow_of_financercord);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':finance_summary', $this->finance_summary);
            $stmt ->bindParam(':finance_note', $this->finance_note);
            $stmt ->bindParam(':finance_income', $this->finance_income);
            $stmt ->bindParam(':finance_expenditure', $this->finance_expenditure);
            $stmt ->bindParam(':finance_balance', $this->finance_balance);
            $stmt ->bindParam(':club_semester', $this->club_semester );

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
            finance_summary = :finance_summary,
            finance_note = :finance_note,
            finance_income = :finance_income,
            finance_expenditure = :finance_expenditure,
            finance_balance = :finance_balance,
            club_semester = :club_semester
            WHERE flow_of_financercord = :flow_of_financercord';
            // Prepare statement
            $stmt = $this ->conn->prepare($query);

            // Clean data
            $this->flow_of_financercord = htmlspecialchars(strip_tags($this -> flow_of_financercord));
            $this->date = htmlspecialchars(strip_tags($this -> date));
            $this->finance_summary = htmlspecialchars(strip_tags($this -> finance_summary));
            $this->finance_note = htmlspecialchars(strip_tags($this -> finance_note));
            $this->finance_income = htmlspecialchars(strip_tags($this -> finance_income));
            $this->finance_expenditure = htmlspecialchars(strip_tags($this -> finance_expenditure));
            $this->finance_balance = htmlspecialchars(strip_tags($this -> finance_balance));
            $this->club_semester  = htmlspecialchars(strip_tags($this -> club_semester ));

            

            // Bind data
            $stmt ->bindParam(':flow_of_financercord', $this->flow_of_financercord);
            $stmt ->bindParam(':date', $this->date);
            $stmt ->bindParam(':finance_summary', $this->finance_summary);
            $stmt ->bindParam(':finance_note', $this->finance_note);
            $stmt ->bindParam(':finance_income', $this->finance_income);
            $stmt ->bindParam(':finance_expenditure', $this->finance_expenditure);
            $stmt ->bindParam(':finance_balance', $this->finance_balance);
            $stmt ->bindParam(':club_semester', $this->club_semester );

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
            $query='DELETE FROM ' . $this->table1 . ' WHERE  flow_of_financercord = :flow_of_financercord';
              // Prepare statement
            $stmt = $this ->conn->prepare($query);

              // Clean data
            $this->id = htmlspecialchars(strip_tags($this ->flow_of_financercord));
            // Bind data
            $stmt ->bindParam(':flow_of_financercord', $this->flow_of_financercord);
             // Execute query
            if($stmt->execute()){
                return true;
            }
            // Print error if something gose wrong
            printf("Error: %s.\n",$stmt->error);
                return false;
        } 
    }
