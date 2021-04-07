<?php
        header("Content-Type:text/html; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/club_info.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
          //  Insrantiate blog post Object
        $club=new club_info($db);

        // Get ID
        $club->id = isset($_GET['id']) ? $_GET['id'] : die();

        // Get club$club 
        $club->read_single();

        // create array

        $club_arr =array(
        'club_name' => $club->club_name,
        'club_type' => $club->club_type,
        'club_website' => $club -> club_website,
        'club_purpose' => $club ->club_purpose,
        'club_icon' => $club -> club_icon,
        'club_introduce' => $club -> club_introduce,
        'club_cover' => $club -> club_cover,
        'club_place' => $club -> club_place,
        'club_time' => $club -> club_time,
        'status_of_club' => $club -> status_of_club,
        'club_fee' => $club -> club_fee,
        'club_teacher' => $club -> club_teacher,
        'club_show_pic' => $club -> club_show_pic
        );

        //Make Json
        print_r(json_encode($club_arr));

?>