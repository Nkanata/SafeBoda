<?php
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $promoDetails = json_decode($json);

    $event = $promoDetails->event;
    $expiry = $promoDetails->expiry;
    $radius = $promoDetails->radius;
    $amount = $promoDetails->amount;
    $numberofpromocodes = $promoDetails->numberofpromocodes;


    if ($event == null){
        echo "Please Provide the name of the Event";
        return;
    }elseif($expiry == null){
        echo "Please Provide An Expiry Date of the promocodes";
        return;
    }elseif($amount == null || $amount == 0){
        echo "Provide an amount Greater than zero";
        return;
    }elseif($numberofpromocodes == null || $numberofpromocodes == 0){
        echo "Provide a number of promocode that you want to generate";
        return;
    }elseif($radius == null){
        echo "Provide the distance valid for the promocode";
        return;
    }

    $getEventId = "SELECT id from events WHERE event_name = '$event'";
    $idRes = $db->query($getEventId);
    if ($idRes->num_rows > 0){
        $row = $idRes->fetch_assoc();
        $eventId = $row["id"];
        echo $eventId;
    }else{
        echo "Event Not Found Please add it First";
        return;
    }

    function generatePromoCode(){
        $bytes = random_bytes(3);
        //var_dump(bin2hex($bytes));
        $promo = bin2hex($bytes);
        return $promo;
    }

    $count = 0;

    for ($x = 0; $x < $numberofpromocodes; $x++){
        $promoCode = generatePromoCode();
        $insert_into_promo = "INSERT INTO `promo_codes` (`promo_code`, `amount`, `expiry`, `radius`, `event`)
                             VALUES ('$promoCode', '$amount', '$expiry', '$radius', '$eventId')";
        if ($db->query($insert_into_promo)){
            echo "New promo code added successfully";
            
        }else{
            echo $db->error;
        }
        if ($db->error){
            echo "Error occurred" + $db->error;
            echo "added " + $x +" Promo codes.";
            break; 
        }

        $count++;
    }

    if ($count == $numberofpromocodes){
        echo "Succcessfully genereated required promo codes";
    }



}


$db->close();