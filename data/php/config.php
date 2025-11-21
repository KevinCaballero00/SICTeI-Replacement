<?php

$host = "mysql.railway.internal";
$user = "root";
$password = "UZwrrEhfbXRZmtwbGyluwOhJGxXgFVvV";
$database = "railway";
$port = getenv("3306");

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>