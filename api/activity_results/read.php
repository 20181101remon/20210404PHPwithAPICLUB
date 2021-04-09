<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/activity_results.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$activity_results = new activity_results($db);


// Get ID
$activity_results->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get activity_results 
$result = $activity_results->read();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        $activity_results_arr = array();
        // pagniation easily
        // $activity_resultss_arr['data']=array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $activity_results_item = array(
                        'date' => $date,
                        'club_name' => $club_name,
                        'activity_name' => $activity_name,
                        'result_activity_population' => $result_activity_population,
                        'achievement' => $achievement,
                        'improvement' => $improvement,
                        'result_pic' => $result_pic

                );
                // Push to 'data'
                // array_push($activity_resultss_arr['data'],$activity_results_item);
                // Turn to Json
                echo json_encode($activity_results_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No activity_results')
        );
}

//Make Json
print_r(json_encode($activity_results_arr));
