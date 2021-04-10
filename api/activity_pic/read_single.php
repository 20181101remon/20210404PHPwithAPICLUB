<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/activity_pic.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$activity_pic = new activity_pic($db);


// Get ID
$activity_pic->id = isset($_GET['id']) ? $_GET['id'] : die();
$activity_pic->date = isset($_GET['date']) ? $_GET['date'] : die();
// Get activity_pic 

$result = $activity_pic->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        // $activity_pic_arr = array();
        // pagniation easily
        // $activity_pics_arr['data']=array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $activity_pic_item = array(
                        'date' => $date,
                        'activity_name' => $activity_name,
                        'result_pic' => $result_pic,
                        
                );
                // Push to 'data'
                // array_push($activity_pics_arr['data'],$activity_pic_item);
                // Turn to Json
                echo json_encode($activity_pic_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No activity_pic')
        );
}

//Make Json
// print_r(json_encode($activity_pic_arr));
