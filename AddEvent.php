<?php
include_once 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $json = file_get_contents('php://input');

    $event_content = json_decode($json);

    //echo $event_content->eventName;
    //echo $event_content->coordinates;
    //echo $event_content->promoCodes;
    $coordinates = $event_content->coordinates;
    $eventName = $event_content->eventName;
    $promoCodes = $event_content->promoCodes;
    $eventDate = $event_content->eventDate;
    //$eventRaidus = $event_content->eventRadius;

    if (preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?);[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $event_content->coordinates)) {
        echo "valid Coordinates\n";
    } else {
        echo "Invalid coordinates\n";
        return;
    }
    if ($eventName == null) {
        echo "No Event Name. \n Please add one.\n";
        return;
    }
    if ($promoCodes == null) {
        echo "No promocodes please add the number of promocodes you wish to generate";
        return;
    }
    if ($coordinates == null) {
        echo "No coordinates. \n Please add coordinates to this event.\n";
        return;
    }
    if ($eventDate == null){
        echo "No Event Date. \n Please add a Date.\n";
        return;
    }
    //if ($eventRaidus == null && $promoCodes > 0){
      //  echo "No event promocode radius";
       // return;
    //}

    $check_duplicate = "SELECT * from `events` where `event_name` = $eventName and `date_time` = $eventDate";
    $result = $db->query($check_duplicate);

    if ($result->num_rows > 0){
        echo "Event already exists\n";
        return;
    }

    $insert_into_events = "INSERT INTO `events` ( `event_name`, `gps_coordinates`, `promo_codes`, `date_time`) 
            VALUES ('$eventName', '$coordinates', '$promoCodes', '$eventDate') ";

    if ($db->query($insert_into_events) === TRUE){
        echo "New event added successfully";
        
    }else{
        echo $db->error;
        echo "Not Inserted\n";
    }
    if ($db->error){
        echo "Error occurred" + $db->error;
    }


}

$db->close();
