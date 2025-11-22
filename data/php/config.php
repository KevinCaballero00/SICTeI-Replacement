<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Railway proporciona las variables SIN guion bajo
$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$database = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT") ?: 3306;

// Debug - descomenta temporalmente para verificar
/*
echo "Host: " . $host . "<br>";
echo "User: " . $user . "<br>";
echo "Database: " . $database . "<br>";
echo "Port: " . $port . "<br>";
die();
*/

if (!$host || !$user || !$password || !$database) {
    die("Error: Variables de entorno de MySQL no están configuradas correctamente.");
}

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
