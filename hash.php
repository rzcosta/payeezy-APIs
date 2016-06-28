<?php 
$storename = "1909808769"; // Replace with your Storenumber here 
$sharedSecret = "31333934393832353531353131393736333331393030343133373930383535363733313239383338323133303238333132333738363233333232313535373035"; //Replace with your Shared Secret here 
/* If you have below PHP version 5.1 OR Don't want to set the Default TimeZone, then you have to do the following 
changes to set your server timeZone: 
Example: If your server is in "PST" timezone, here are the changes: 
//date_default_timezone_set("Asia/Calcutta"); // Comment this line 
$timezone = "PST" // change to your server timeZone 
*/ 
date_default_timezone_set("Asia/Calcutta"); 
$timezone = "IST"; 
/* ---- */ 
$dateTime = date("Y:m:d-H:i:s"); 
function getDateTime() { 
global $dateTime; 
return $dateTime; 
} 
function getTimezone() { 
global $timezone; 
return $timezone; 
} 
function getStorename() { 
global $storename; 
return $storename; 
} 
function createHash($chargetotal) { 
global $storename, $sharedSecret; 
$str = $storename . getDateTime() . $chargetotal . $sharedSecret; 
for ($i = 0; $i < strlen($str); $i++){ 
$hex_str.=dechex(ord($str[$i])); 
} 
return hash('sha256', $hex_str); 
} 
?> 