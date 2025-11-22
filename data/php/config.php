<?php
// Evitar múltiples inclusiones
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

// Valores por defecto si las variables no existen
if (!$host) $host = "mysql.railway.internal";
if (!$user) $user = "root";
if (!$database) $database = "railway";
if (!$port) $port = 3306;

// Intentar conexión con timeout
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_init();
    
    // Configurar timeout de conexión
    $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
    
    // Conectar
    $conn->real_connect($host, $user, $password, $database, $port);
    
    // Configurar charset
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>