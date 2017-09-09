<?php

exec("python ".__DIR__."/dht22temp.py", $result);
$values = json_decode(implode(" ", $result));

date_default_timezone_set('Europe/Amsterdam');

$filename = "temps.csv";

if (file_exists(__DIR__."/".$filename) == false) {
	file_put_contents($filename, "datetime;temperature_celcius;humidity_percentage;\n");
}

$file=fopen(__DIR__."/".$filename, "a");
fwrite($file, date("Y-m-d H:i:s").";".$values->temperature_c.";".$values->humidity."\n");
fclose($file);
