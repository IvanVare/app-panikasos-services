<?php
$serverName = "apppanicbuttom4-server.database.windows.net";
$database = "apppbuttom-database";
$username = "admin23646";
$password = "admin220701_";

$connectionInfo = array(
    "Database" => $database,
    "UID" => $username,
    "PWD" => $password
);

$connection = sqlsrv_connect($serverName, $connectionInfo);

if ($connection === false) {
    echo "No se puede conectar.";
    die(print_r(sqlsrv_errors(), true));
}
?>
