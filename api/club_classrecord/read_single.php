<?php
header("Content-Type:text/html; charset=utf-8");
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
$classrecord->date = isset($_GET['date']) ? $_GET['date'] : die();
// Get club$club 
$classrecord->read_single();

// create array

$classrecord_arr = array(
  'date' => $classrecord->date,
  'club_name' => $classrecord->club_name,
  'club_teacher' => $classrecord->club_teacher,
  'class_place' => $classrecord->class_place,
  'class_contect' => $classrecord->class_contect,
  'pic' => $classrecord->pic
);

//Make Json
print_r(json_encode($classrecord_arr));

?>