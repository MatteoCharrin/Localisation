<?php
$table = array();
for($i = 0; $i <=100; $i++)
{
    $ipgen = rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255) ;

    array_push($table, $ipgen );

}
$conn_string = "host=localhost port=5432 dbname=tpGeo user=php password=a";
$dsn = pg_pconnect($conn_string);
$timefinal = 0;
foreach ($table as $item){




$time_start = microtime(true);
$ip = $item;
$ips = explode(".",$ip);
$inIP = $ips[3] + ($ips[2] * 256) + ($ips[1] * 256 * 256) + ($ips[0] * 256 * 256 * 256);
$result = pg_query($dsn, "SELECT * FROM geoip WHERE c1 < '" . $inIP . "' AND c2 > '" . $inIP . "';");
$arr = pg_fetch_array($result, null, PGSQL_NUM);
  echo  "<p>ip  : ".$ip."</p>" ;



$time_end = microtime(true);
$time = $time_end - $time_start;
$time = $time * 1000;
$timefinal = $timefinal+$time;
}

$timefinal = $timefinal/count($table);

echo  "<p>time  : ".$timefinal."</p>" ;