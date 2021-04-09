
<?php
        header("Content-Type:text/html; charset=utf-8");
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        include_once '../../config/Database.php';
        include_once '../../models/activity_apply.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog activity_apply Object
        $activity_apply=new activity_apply($db);
        
        // Get ID
        $activity_apply->id = isset($_GET['id']) ? $_GET['id'] : die();
        // Get activity_apply 
        $activity_apply->read_single();
        // create array
        $activity_apply_arr =array(
        'club_name' => $activity_apply->club_name,
        'activity_name' => $activity_apply->activity_name,
        'date' => $activity_apply -> date,
        'activity_venue' => $activity_apply ->activity_venue,
        'activity_mainpoint' => $activity_apply -> activity_mainpoint,
        'organizer' => $activity_apply -> organizer,
        'co_organizer' => $activity_apply -> co_organizer,
        'source_of_funding' => $activity_apply -> source_of_funding,
        'contact_person' => $activity_apply -> contact_person,
        'contact_tel' => $activity_apply -> contact_tel,
        'status_of_activity' => $activity_apply -> status_of_activity,
        'review_note' => $activity_apply -> review_note
);

        //Make Json
        print_r(json_encode($activity_apply_arr));

?>