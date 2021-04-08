<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/club_planofsemester.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$club_plan = new club_planofsemester($db);


// Get ID
$club_plan->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get club_plan 
$result = $club_plan->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        $club_plan_arr = array();

        // pagniation easily
        // $club_plans_arr['data']=array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $club_plan_item = array(
                        'date' => $date,
                        'activity_name' => $activity_name
                        
                );
                // Push to 'data'
                // array_push($club_plans_arr['data'],$club_plan_item);
                // Turn to Json
                echo json_encode($club_plan_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No club_plan')
        );
}

//Make Json
print_r(json_encode($club_plan_arr));
