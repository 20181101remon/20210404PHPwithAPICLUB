<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/classrecord_pic.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$classrecord_pic = new classrecord_pic($db);


// Get ID
$classrecord_pic->id = isset($_GET['id']) ? $_GET['id'] : die();
$classrecord_pic->date = isset($_GET['date']) ? $_GET['date'] : die();
// Get classrecord_pic 

$result = $classrecord_pic->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        // $classrecord_pic_arr = array();
        // pagniation easily
        // $classrecord_pics_arr['data']=array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $classrecord_pic_item = array(
                        'flow_of_pic' => $flow_of_pic,
                        'pic' => $pic,
                        'flow_of_classrecord' => $flow_of_classrecord
                        
                );
                // Push to 'data'
                // array_push($classrecord_pics_arr['data'],$classrecord_pic_item);
                // Turn to Json
                echo json_encode($classrecord_pic_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No activity_pic')
        );
}

//Make Json
// print_r(json_encode($activity_pic_arr));
