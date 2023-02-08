<?php

function Main() {
    $aContent = json_decode( file_get_contents('config.json'), true );
$conn_string = "host={$aContent["host"]} port={$aContent["port"]} dbname={$aContent["dbname"]} user={$aContent["user"]} password={$aContent["password"]}"; // Connexion a la bdd avec
$dsn = pg_pconnect($conn_string);

// Get the visitor's IP address
$ipclient = $_SERVER['REMOTE_ADDR'];



$ip = $_POST['ip'] ?? '';
if ($ip = 'local') {
    $ip = $_SERVER["REMOTE_ADDR"];
}
if ($ip = ' ') {

    $ip = '8.8.8.8';

}

$ips = explode(".", $ip);
$inIP = $ips[3] + ($ips[2] * 256) + ($ips[1] * 256 * 256) + ($ips[0] * 256 * 256 * 256); // Décomposition pour avoir le code ip pour la chercherche en bdd

$sql = 'SELECT * FROM geoip WHERE c1 <  $1  AND c2 > $1';
$sqlName = 'selectIp';
if (!pg_prepare($sqlName, $sql)) { // Permet de preparer la requete et d'afficher une erreur si ce n'est pas possible
    die("Can't prepare '$sql': " . pg_last_error());
}
$result = pg_execute($sqlName, array($inIP)); // Execute la requete

$sql = sprintf(
    'DEALLOCATE "%s"', // Détruit la requete préparer
    pg_escape_string($sqlName)
);
if (!pg_query($sql)) {
    die("Can't query '$sql': " . pg_last_error());
}


$arr = pg_fetch_array($result, 0, PGSQL_NUM);

return($arr);

}
