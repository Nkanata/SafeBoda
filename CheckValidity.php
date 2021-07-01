<?php
include_once 'db.php';

function distance($lat1, $lon1, $lat2, $lon2, $unit)
{
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    } else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        $k = $miles * 1.609344;
        //echo "miles $k";

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $promoDetails = json_decode($json);

    $promo_code = $promoDetails->promo_code;
    $origin = $promoDetails->origin;
    $destination = $promoDetails->destination;

    if (!isset($promo_code)) {
        echo "Please provide a promo code";
        return;
    }
    if (!isset($origin)) {
        echo "Please provide an Origin point";
        return;
    }
    if (!isset($destination)){
        echo "Please provide a destination";
    }

    if (
        !preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?);[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $origin) ||
        !preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?);[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $destination)
    ) {
        echo "Please provide a valid gps coordinate";
        return;
    }

    $get_radius = "SELECT * from promo_codes where promo_code = '$promo_code' and status = 'active' ";

    $result = $db->query($get_radius);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $radius = $row["radius"];
        $event = $row["event"];
        $expiry = $row["expiry"];
        $status = $row["status"];
        $amount = $row["amount"];
        

        $getEvent = "SELECT event_name, gps_coordinates from events where id = $event";
        $event_res = $db->query($getEvent);

        if ($event_res->num_rows > 0) {
            $res = $event_res->fetch_assoc();
            $event_name = $res["event_name"];

            $coordinates = $res["gps_coordinates"];

            $coordinates = strval($coordinates);

            $coordinates = explode(" ", $coordinates);
            $destination = strval($destination);
            $origin = strval($origin);
            $destination = explode(" ", $destination);
            $origin = explode(" ", $origin);
           // echo "radius $radius";

                if (distance(floatval($coordinates[0]), floatval($coordinates[1]), floatval($origin[0]), floatval($origin[1]), 'k') < $radius &&
                distance(floatval($coordinates[0]), floatval($coordinates[1]), floatval($destination[0]), floatval($destination[1]), 'k') < $radius) {
                    echo "Promo Code is Valid \n";
                    $data= new stdClass();

                    $data->PromoCode = $promo_code;
                    $data->event = $event_name;
                    $data->expiry = $expiry;
                    $data->amount = $amount;
                    $data->status = $status;
                    $data->radius = $radius;
                    $data->message = "Promo Code is Valid";

                    $data= json_encode($data);
                    echo $data;


                }else{
                    echo "for these points the promo code is invalid";
                }
        }
    }
}

$db->close();
