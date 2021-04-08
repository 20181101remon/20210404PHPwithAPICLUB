<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/club_classrecord.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$classrecord = new club_classrecord($db);


// Get ID
$classrecord->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get classrecord 
$result = $classrecord->read();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        $classrecord_arr = array();
        // pagniation easily
        // $classrecords_arr['data']=array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $classrecord_item = array(
                        'date' => $date,
                        'club_name' => $club_name,
                        'club_teacher' => $club_teacher,
                        'class_place' => $class_place,
                        'class_contect' => $class_contect,
                        'pic' => $pic

                );
                // Push to 'data'
                // array_push($classrecords_arr['data'],$classrecord_item);
                // Turn to Json
                echo json_encode($classrecord_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No classrecord')
        );
}

//Make Json
print_r(json_encode($classrecord_arr));
