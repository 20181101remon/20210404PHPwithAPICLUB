<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/news_attend_file.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$news_attend_file = new news_attend_file($db);


// Get ID
$news_attend_file->id = isset($_GET['id']) ? $_GET['id'] : die();
$news_attend_file->date = isset($_GET['date']) ? $_GET['date'] : die();
// Get news_attend_file 

$result = $news_attend_file->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        // $news_attend_file_arr = array();
        // pagniation easily
        // $news_attend_files_arr['data']=array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $news_attend_file_item = array(
                        'club_name' => $club_name,
                        'news_title' => $news_title,
                        'news_content' => $news_content,
                        'news_pic' => $news_pic,
                        'news_file' => $news_file
                        
                );
                // Push to 'data'
                // array_push($news_attend_files_arr['data'],$news_attend_file_item);
                // Turn to Json
                echo json_encode($news_attend_file_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No activity_pic')
        );
}

//Make Json
// print_r(json_encode($activity_pic_arr));
