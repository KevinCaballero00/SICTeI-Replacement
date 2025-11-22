<?php
$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$database = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

echo "<h2>Variables de entorno:</h2>";
echo "Host: " . ($host ?: "NO DEFINIDO") . "<br>";
echo "User: " . ($user ?: "NO DEFINIDO") . "<br>";
echo "Password: " . (empty($password) ? "NO DEFINIDO" : "***definido***") . "<br>";
echo "Database: " . ($database ?: "NO DEFINIDO") . "<br>";
echo "Port: " . ($port ?: "NO DEFINIDO") . "<br>";

echo "<h2>Intento de conexión:</h2>";
$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
} else {
    echo "✅ Conexión exitosa a la base de datos!";
    $conn->close();
}
?>