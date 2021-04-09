<?php
header("Content-Type:text/html; charset=utf-8");
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
$activity_results->date = isset($_GET['date']) ? $_GET['date'] : die();
// Get club$club 
$activity_results->read_single();

// create array

$activity_results_arr = array(
  'date' => $activity_results->date,
  'club_name' => $activity_results->club_name,
  'activity_name' => $activity_results->activity_name,
  'result_activity_population' => $activity_results->result_activity_population,
  'achievement' => $activity_results->achievement,
  'improvement' => $activity_results->improvement
);

//Make Json
print_r(json_encode($activity_results_arr));
