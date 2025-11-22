<?php
if (defined('DB_CONNECTED')) {
    return;
}
define('DB_CONNECTED', true);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$database = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

// Debug - descomentar temporalmente para verificar
/*
echo "Host: " . ($host ?: "NO DEFINIDO") . "<br>";
echo "User: " . ($user ?: "NO DEFINIDO") . "<br>";
echo "Database: " . ($database ?: "NO DEFINIDO") . "<br>";
echo "Port: " . ($port ?: "NO DEFINIDO") . "<br>";
die();
*/

if (!$host) $host = "mysql-u8_0.railway.internal";
if (!$user) $user = "root";
if (!$database) $database = "railway";
if (!$port) $port = 3306;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_init();
    
    // Timeout más largo
    $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 30);
    
    $conn->real_connect($host, $user, $password, $database, $port);
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage() . "<br>Host: $host<br>Database: $database");
}
?>