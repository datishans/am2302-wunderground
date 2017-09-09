<?php

date_default_timezone_set('Europe/Amsterdam');
error_reporting(E_ALL & ~E_NOTICE);

echo "--- ".date("Y-m-d H:i:s")."\n";

exec("python ".__DIR__."/dht22temp.py", $result);
$values = json_decode(implode(" ", $result));

if ($values->error) {
    print_r($values);

    echo "error while getting data!\n";
    exit;
}

$tempf = ($values->temperature_c * 9 / 5) + 32;

echo "tempc=$values->temperature_c, tempf=$tempf hum=$values->humidity\n";

$url = "https://weatherstation.wunderground.com/weatherstation/updateweatherstation.php";
$url .= "?dateutc=now";
$url .= "&ID=xxxxxxxxxxx";
$url .= "&PASSWORD=yyyyyyyy";
$url .= "&action=updateraw";
$url .= "&tempf=".number_format($tempf, 2);
$url .= "&humidity=".number_format($values->humidity, 2);

echo "Sending to Wunderground... ";
$response = file_get_contents($url);

print_r($response);
