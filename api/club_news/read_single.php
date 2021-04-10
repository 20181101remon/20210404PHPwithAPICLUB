<?php
header("Content-Type:text/html; charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/club_news.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object
$news = new club_news($db);

// Get ID
$news->id = isset($_GET['id']) ? $_GET['id'] : die();
$news->date = isset($_GET['date']) ? $_GET['date'] : die();
// Get club$club 
$news->read_single();

// create array

$news_arr = array(

  'club_name' => $news->club_name,
  'date' => $news->date,
  'news_title' => $news->news_title,
  'news_content' => $news->news_content

);

//Make Json
print_r(json_encode($news_arr));

?>