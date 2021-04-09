<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    include_once '../../config/Database.php';
    include_once '../../models/activity_apply.php';
        // Insrantiate DB & connect
        $database =new Database();
        $db=$database->connect();
        //  Insrantiate blog post Object
        $activity_apply=new activity_apply($db);

        // Get raw activity_applyed data
        $data =json_decode(file_get_contents("php://input"));

        $activity_apply ->flow_of_activity =$data ->flow_of_activity;
        $activity_apply ->activity_name =$data ->activity_name;
        $activity_apply ->date =$data ->date;
        $activity_apply ->activity_venue =$data ->activity_venue;
        $activity_apply ->activity_mainpoint =$data ->activity_mainpoint;
        $activity_apply ->organizer =$data ->organizer;
        $activity_apply ->co_organizer =$data ->co_organizer;
        $activity_apply ->source_of_funding =$data ->source_of_funding;
        $activity_apply ->contact_person =$data ->contact_person;
        $activity_apply ->contact_tel =$data ->contact_tel;
        $activity_apply ->status_of_activity =$data ->status_of_activity;
        $activity_apply ->review_note =$data ->review_note;
        $activity_apply ->club_semester =$data ->club_semester;



        // create activity_apply
        if($activity_apply->create()){
            echo json_encode(
                array('message' => $activity_apply)
            );
        }
        else
        {
            echo json_encode(
                array('message' => 'activity_apply not Created')
            );
        }
