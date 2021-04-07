<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/club_planofsemester.php';
// Insrantiate DB & connect
$database = new Database();
$db = $database->connect();
//  Insrantiate blog post Object

$post = new club_planofsemester($db);


// Get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get Post 
$result = $post->read_single();

// Get row Count
$num = $result->rowCount();

// create array
if ($num > 0) {
        $post_arr = array();

        // pagniation easily
        // $posts_arr['data']=array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // let key be the variable,take the content from sql
                extract($row);
                $post_item = array(
                        'date' => $date,
                        'activity_name' => $activity_name
                        
                );
                // Push to 'data'
                // array_push($posts_arr['data'],$post_item);
                // Turn to Json
                echo json_encode($post_item);
        }
} else {
        echo json_encode(
                array('memessage' => 'No Post')
        );
}

//Make Json
print_r(json_encode($post_arr));
