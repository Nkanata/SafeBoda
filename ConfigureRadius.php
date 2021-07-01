<?php 
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $promoDetails = json_decode($json);
    $promo_code = $promoDetails->PromoCode;
    $radius = $promoDetails->radius;

    if (isset($promo_code) && isset($radius)){
        $get = "UPDATE promo_codes set radius = '$radius' where promo_code = '$promo_code'";

        if ($db->query($get)===TRUE){
            echo "$promo_code radius has been updated.";
        }else{
            echo "Error occured "+$db->error ;
        }
    }else{
        echo "Please provide The promo code and the new radius";
    }




}


$db->close();

