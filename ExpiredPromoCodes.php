<?php 
include_once 'db.php';

$now = date("Y-m-d H:i:s");
$updatePromoCodes = "Update promo_codes set status = 'inactive' where expiry < $now ";

if ($db->query($updatePromoCodes) === TRUE){
    echo "Updated promo Codes and Deactivated expired ones";
}else{
    echo "Error occurred" + $db->error;
}


$db->close();