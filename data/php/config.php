<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$host = getenv("MYSQLHOST") ?: getenv("MYSQL_HOST");
$user = getenv("MYSQLUSER") ?: getenv("MYSQL_USER");
$password = getenv("MYSQLPASSWORD") ?: getenv("MYSQL_ROOT_PASSWORD");
$database = getenv("MYSQLDATABASE") ?: getenv("MYSQL_DATABASE");
$port = getenv("MYSQLPORT") ?: getenv("MYSQL_PORT") ?: 3306;

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
```

### Solución 2: O agrega las variables manualmente

En tu servicio web (no en MySQL), ve a Variables y agrega manualmente:
```
MYSQLHOST=mysql.railway.internal
MYSQLUSER=root
MYSQLPASSWORD=UZwrrEhfbXRZmtwbGyIuwOhJGcXgFVvV
MYSQLDATABASE=railway
MYSQLPORT=3306
