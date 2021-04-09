<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/club_feedback.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$feedback = new club_feedback($db);


// Get ID
$feedback->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get feedback 
$result = $feedback->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        $feedback_arr = array();

        // pagniation easily
        // $club_plans_arr['data']=array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $feedback_item = array(
                        'date' => $date,
                        'feedback_name' => $feedback_name,
                        'content' => $content,
                        
                        
                );
                // Push to 'data'
                // array_push($feedback_arr['data'],$feedbackitem);
                // Turn to Json
                echo json_encode($feedback_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No feedback')
        );
}

//Make Json
print_r(json_encode($feedback_arr));
